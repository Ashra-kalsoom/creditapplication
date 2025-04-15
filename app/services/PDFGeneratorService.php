<?php
// app/Services/PDFGeneratorService.php
namespace App\Services;

use App\Models\CreditApplication;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PDFGeneratorService
{
    /**
     * Generate a PDF for a credit application
     *
     * @param CreditApplication $application
     * @return string The path to the generated PDF
     */
    public function generatePDF(CreditApplication $application)
    {
        $pharmacy = $application->pharmacy;
        $supplier = $application->supplier;

        // Choose the correct template for this supplier
        $templateName = $supplier->template_name ?? 'default';
        $viewName = 'templates.' . $templateName;

        // Check if the view exists, otherwise use default
        if (!view()->exists($viewName)) {
            $viewName = 'templates.default';
        }

        // Render the view
        $html = View::make($viewName, [
            'application' => $application,
            'pharmacy' => $pharmacy,
            'supplier' => $supplier,
            'signatureUrl' => $application->signature ? Storage::url($application->signature) : null,
        ])->render();

        // Generate PDF
        $pdf = PDF::loadHTML($html);

        // Create a unique filename
        $filename = 'applications/' . $supplier->name . '_' . $pharmacy->legal_name . '_' . time() . '.pdf';
        $path = 'public/' . $filename;

        // Save PDF
        Storage::put($path, $pdf->output());

        return $filename;
    }
}
