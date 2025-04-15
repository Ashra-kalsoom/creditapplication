<?php
// app/Services/EmailService.php
namespace App\Services;

use App\Models\CreditApplication;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class EmailService
{
    /**
     * Send an application to the supplier
     *
     * @param CreditApplication $application
     */
    public function sendApplicationToSupplier(CreditApplication $application)
    {
        $pharmacy = $application->pharmacy;
        $supplier = $application->supplier;

        // Here you would configure email settings
        // For example, using Laravel's Mail facade
        Mail::send('emails.application', [
            'application' => $application,
            'pharmacy' => $pharmacy,
            'supplier' => $supplier,
        ], function ($message) use ($application, $pharmacy, $supplier) {
            // Set recipient (would come from supplier configuration in a real app)
            $message->to('supplier@example.com', $supplier->name);

            // Set subject
            $message->subject('Credit Application from ' . $pharmacy->legal_name);

            // Attach PDF
            if ($application->pdf_path) {
                $message->attach(
                    Storage::disk('public')->path($application->pdf_path),
                    [
                        'as' => $supplier->name . '_' . $pharmacy->legal_name . '.pdf',
                        'mime' => 'application/pdf',
                    ]
                );
            }

            // Attach documents
            $documents = $pharmacy->documents;
            foreach ($documents as $document) {
                $message->attach(
                    Storage::disk('public')->path($document->file_path),
                    [
                        'as' => $document->type . '_' . $document->file_name,
                        'mime' => $document->mime_type,
                    ]
                );
            }
        });
    }
}
