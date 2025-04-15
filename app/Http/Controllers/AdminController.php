<?php
// app/Http/Controllers/AdminController.php
namespace App\Http\Controllers;

use App\Models\CreditApplication;
use App\Models\Supplier;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->middleware('auth'); // Protect all admin routes
        $this->emailService = $emailService;
    }

    /**
     * Admin dashboard
     */
    public function dashboard()
    {
        $statistics = [
            'total_applications' => CreditApplication::count(),
            'pending_applications' => CreditApplication::whereIn('status', ['submitted', 'under_review'])->count(),
            'approved_applications' => CreditApplication::where('status', 'approved')->count(),
            'rejected_applications' => CreditApplication::where('status', 'rejected')->count(),
            'suppliers_count' => Supplier::count(),
        ];

        $recent_applications = CreditApplication::with(['pharmacy', 'supplier'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('statistics', 'recent_applications'));
    }

    /**
     * List all credit applications
     */
    public function listApplications(Request $request)
    {
        $query = CreditApplication::with(['pharmacy', 'supplier']);

        // Filter by status if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by supplier if provided
        if ($request->has('supplier_id')) {
            $query->where('supplier_id', $request->supplier_id);
        }

        // Search by pharmacy name
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('pharmacy', function ($q) use ($search) {
                $q->where('legal_name', 'like', "%{$search}%")
                  ->orWhere('dba', 'like', "%{$search}%");
            });
        }

        $applications = $query->orderBy('created_at', 'desc')
            ->paginate(15);

        $suppliers = Supplier::orderBy('name')->get();

        return view('admin.applications.index', compact('applications', 'suppliers'));
    }

    /**
     * View a specific application
     */
    public function viewApplication($id)
    {
        $application = CreditApplication::with(['pharmacy', 'supplier'])
            ->findOrFail($id);

        $documents = $application->pharmacy->documents;

        return view('admin.applications.view', compact('application', 'documents'));
    }

    /**
     * Update application status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:submitted,under_review,approved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $application = CreditApplication::findOrFail($id);
        $application->status = $request->status;

        if ($request->has('admin_notes')) {
            $application->admin_notes = $request->admin_notes;
        }

        $application->save();

        return back()->with('success', 'Application status updated successfully');
    }

    /**
     * Send application to supplier
     */
    public function sendToSupplier($id)
    {
        $application = CreditApplication::with(['pharmacy', 'supplier'])
            ->findOrFail($id);

        if (!$application->pdf_path) {
            return back()->withErrors(['error' => 'PDF not generated for this application.']);
        }

        try {
            // Here you would implement logic to send the application to the supplier
            // For example, via email with the PDF attached
            $this->emailService->sendApplicationToSupplier($application);

            // Update application status
            $application->sent_to_supplier = true;
            $application->sent_at = now();
            $application->save();

            return back()->with('success', 'Application sent to supplier successfully');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to send application. ' . $e->getMessage()]);
        }
    }

    /**
     * Download application PDF
     */
    public function downloadPdf($id)
    {
        $application = CreditApplication::findOrFail($id);

        if (!$application->pdf_path) {
            return back()->withErrors(['error' => 'PDF not generated for this application.']);
        }

        $path = 'public/' . $application->pdf_path;

        if (!Storage::exists($path)) {
            return back()->withErrors(['error' => 'PDF file not found.']);
        }

        $filename = $application->supplier->name . '_' . $application->pharmacy->legal_name . '.pdf';

        return Storage::download($path, $filename);
    }
}
