<?php
// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreditApplicationController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Credit Application Routes
Route::prefix('credit-application')->name('credit-application.')->group(function () {
    Route::get('/', [CreditApplicationController::class, 'index'])->name('index');
    Route::post('/select-suppliers', [CreditApplicationController::class, 'create'])->name('create');
    Route::post('/store', [CreditApplicationController::class, 'store'])->name('store');
    Route::get('/review', [CreditApplicationController::class, 'review'])->name('review');
    Route::get('/signature', [CreditApplicationController::class, 'showSignature'])->name('show-signature');
    Route::post('/signature', [CreditApplicationController::class, 'storeSignature'])->name('store-signature');
    Route::get('/upload', [CreditApplicationController::class, 'showUpload'])->name('upload');
    Route::post('/upload', [CreditApplicationController::class, 'storeDocuments'])->name('store-documents');
    Route::get('/confirmation', [CreditApplicationController::class, 'confirmation'])->name('confirmation');
});

// Document Download Route
Route::get('/documents/{type}/{id}', [DocumentController::class, 'download'])->name('documents.download');

// Admin Routes (should be protected with middleware in production)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Applications management
    Route::prefix('applications')->name('applications.')->group(function () {
        Route::get('/', [AdminController::class, 'listApplications'])->name('index');
        Route::get('/{id}', [AdminController::class, 'viewApplication'])->name('view');
        Route::post('/{id}/status', [AdminController::class, 'updateStatus'])->name('update-status');
        Route::post('/{id}/send', [AdminController::class, 'sendToSupplier'])->name('send');
        Route::get('/{id}/download', [AdminController::class, 'downloadPdf'])->name('download');
    });

    // Suppliers management
    Route::prefix('suppliers')->name('suppliers.')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('index');
        Route::get('/create', [SupplierController::class, 'create'])->name('create');
        Route::post('/', [SupplierController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SupplierController::class, 'update'])->name('update');
        Route::delete('/{id}', [SupplierController::class, 'destroy'])->name('destroy');
    });
});

// Authentication routes (use Laravel's built-in authentication)
Auth::routes(['register' => false]); // Disable public registration for admin panel

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
