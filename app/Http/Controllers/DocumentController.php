<?php
// app/Http/Controllers/DocumentController.php
namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Protect document routes
    }

    /**
     * Download a document
     */
    public function download($type, $id)
    {
        $document = Document::where('type', $type)
            ->where('id', $id)
            ->firstOrFail();

        if (!Storage::disk('public')->exists($document->file_path)) {
            return back()->withErrors(['error' => 'Document file not found']);
        }

        return Storage::disk('public')->download($document->file_path, $document->file_name);
    }
}
