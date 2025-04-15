<?php
// app/Http/Controllers/CreditApplicationController.php
namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Pharmacy;
use App\Models\CreditApplication;
use App\Models\Document;
use App\Http\Requests\CreditApplicationRequest;
use App\Services\PDFGeneratorService;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CreditApplicationController extends Controller
{
    protected $pdfService;
    protected $emailService;

    public function __construct(PDFGeneratorService $pdfService, EmailService $emailService)
    {
        $this->pdfService = $pdfService;
        $this->emailService = $emailService;
    }

    /**
     * Display the supplier selection page
     */
    public function index()
    {
        $suppliers = Supplier::where('active', true)->get();
        return view('credit-application.supplier-select', compact('suppliers'));
    }

    /**
     * Show the form for creating a new credit application
     */
    public function create(Request $request)
    {
        // Validate selected suppliers
        $request->validate([
            'suppliers' => 'required|array',
            'suppliers.*' => 'exists:suppliers,id'
        ]);

        $selectedSuppliers = Supplier::whereIn('id', $request->suppliers)->get();

        // Store selected suppliers in session for later steps
        session(['selected_suppliers' => $request->suppliers]);

        return view('credit-application.form', compact('selectedSuppliers'));
    }

    /**
     * Store the pharmacy information and proceed to review
     */
    public function store(CreditApplicationRequest $request)
    {
        try {
            DB::beginTransaction();

            // Create or update pharmacy record
            $pharmacyData = $request->only([
                'legal_name', 'dba', 'bill_address', 'bill_city', 'bill_state', 'bill_zip',
                'ship_address', 'ship_city', 'ship_state', 'ship_zip', 'phone', 'fax',
                'email', 'dea_number', 'dea_expiry', 'state_license', 'license_expiry',
                'tax_id', 'npi_number', 'years_in_business', 'ap_manager_name', 'ap_manager_email',
                'buyer_name', 'buyer_email', 'ownership_type', 'financial_institution_name',
                'financial_institution_address', 'account_type', 'name_on_account',
                'depositor_account_number', 'routing_number', 'billing_option',
                'business_duration', 'location_duration', 'own_or_rent', 'landlord_details',
                'legal_proceeding', 'felony_conviction', 'ach_autopayment', 'credit_card_number',
                'credit_card_expiration', 'credit_card_security_code', 'billing_address',
                'billing_city', 'billing_state_zip', 'financial_signature', 'financial_signature_date'
            ]);

            // Handle JSON fields
            $pharmacyData['owners_info'] = $request->input('owners_info', []);
            $pharmacyData['trade_references'] = $request->input('trade_references', []);

            // Create or update the pharmacy record
            $pharmacy = Pharmacy::create($pharmacyData);

            // Store pharmacy ID in session
            session(['pharmacy_id' => $pharmacy->id]);

            // Create draft applications for each selected supplier
            $selectedSuppliers = session('selected_suppliers', []);
            foreach ($selectedSuppliers as $supplierId) {
                CreditApplication::create([
                    'pharmacy_id' => $pharmacy->id,
                    'supplier_id' => $supplierId,
                    'status' => 'draft',
                    'requested_credit_line' => $request->input('requested_credit_line')
                ]);
            }

            DB::commit();

            return redirect()->route('credit-application.review');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to save application. ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Show the review page before signing
     */
    public function review()
    {
        $pharmacyId = session('pharmacy_id');
        if (!$pharmacyId) {
            return redirect()->route('credit-application.index')
                ->withErrors(['error' => 'Application session expired. Please start again.']);
        }

        $pharmacy = Pharmacy::findOrFail($pharmacyId);
        $applications = CreditApplication::with('supplier')
            ->where('pharmacy_id', $pharmacyId)
            ->where('status', 'draft')
            ->get();

        if ($applications->isEmpty()) {
            return redirect()->route('credit-application.index')
                ->withErrors(['error' => 'No applications found. Please start again.']);
        }

        return view('credit-application.review', compact('pharmacy', 'applications'));
    }

    /**
     * Show the signature form
     */
    public function showSignature()
    {
        $pharmacyId = session('pharmacy_id');
        if (!$pharmacyId) {
            return redirect()->route('credit-application.index')
                ->withErrors(['error' => 'Application session expired. Please start again.']);
        }

        return view('credit-application.signature');
    }

    /**
     * Store signature and proceed to document upload
     */
    public function storeSignature(Request $request)
    {
        $request->validate([
            'signature' => 'required|file|mimes:png,jpg,jpeg|max:2048', // Validate as an image file
            'signer_name' => 'required|string|max:255',
            'signer_title' => 'required|string|max:255',
        ]);

        $pharmacyId = session('pharmacy_id');
        if (!$pharmacyId) {
            return redirect()->route('credit-application.index')
                ->withErrors(['error' => 'Application session expired. Please start again.']);
        }

        try {
            // Handle signature image upload
            if ($request->hasFile('signature')) {
                $file = $request->file('signature');
                $signaturePath = $file->store('signatures', 'public'); // Store the file in the 'signatures' directory
                Document::create([
                    'pharmacy_id' => $pharmacyId,
                    'type' => 'other',
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $signaturePath,
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize()
                ]);
                //dd($signaturePath);
            }

            // Update all draft applications for this pharmacy
            CreditApplication::where('pharmacy_id', $pharmacyId)
                ->where('status', 'draft')
                ->update([
                    'signature' => $signaturePath ?? null,
                    'signer_name' => $request->input('signer_name'),
                    'signer_title' => $request->input('signer_title'),
                    'signed_at' => now(),
                    'ip_address' => $request->ip(),
                    'status' => 'submitted'
                ]);

            return redirect()->route('credit-application.upload');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to save signature. ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Show document upload form
     */
    public function showUpload()
    {
        $pharmacyId = session('pharmacy_id');
        if (!$pharmacyId) {
            return redirect()->route('credit-application.index')
                ->withErrors(['error' => 'Application session expired. Please start again.']);
        }

        $pharmacy = Pharmacy::findOrFail($pharmacyId);
        $deaDocument = $pharmacy->documents()->where('type', 'dea_license')->first();
        $stateDocument = $pharmacy->documents()->where('type', 'state_license')->first();

        return view('credit-application.upload', compact('pharmacy', 'deaDocument', 'stateDocument'));
    }

    /**
     * Handle document uploads
     */
    public function storeDocuments(Request $request)
    {
        $request->validate([
            'dea_license' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'state_license' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $pharmacyId = session('pharmacy_id');
        if (!$pharmacyId) {
            return redirect()->route('credit-application.index')
                ->withErrors(['error' => 'Application session expired. Please start again.']);
        }

        try {
            // Handle DEA License upload
            if ($request->hasFile('dea_license')) {
                $file = $request->file('dea_license');
                $path = $file->store('documents/dea', 'public');

                Document::create([
                    'pharmacy_id' => $pharmacyId,
                    'type' => 'dea_license',
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize()
                ]);
            }

            // Handle State License upload
            if ($request->hasFile('state_license')) {
                $file = $request->file('state_license');
                $path = $file->store('documents/state', 'public');

                Document::create([
                    'pharmacy_id' => $pharmacyId,
                    'type' => 'state_license',
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize()
                ]);
            }

            // Generate PDFs for all applications
            $applications = CreditApplication::with(['pharmacy', 'supplier'])
                ->where('pharmacy_id', $pharmacyId)
                ->where('status', 'submitted')
                ->get();

            // foreach ($applications as $application) {
            //     $pdfPath = $this->pdfService->generatePDF($application);
            //     $application->update(['pdf_path' => $pdfPath]);
            // }

            // Clear session data
            session()->forget(['pharmacy_id', 'selected_suppliers']);

            return redirect()->route('credit-application.confirmation');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to upload documents. ' . $e->getMessage()])->withInput();
        }
    }

    /**requested_credit_line
     * Show confirmation page
     */
    public function confirmation()
    {
        return view('credit-application.confirmation');
    }
}
