{{-- filepath: resources/views/credit-application/review.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Review Credit Application</h2>
                    <span class="badge bg-info">Step 3 of 4: Signature</span>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('credit-application.store-signature') }}" enctype="multipart/form-data">
                        {{-- Include the CSRF token for security --}}
                        @csrf
                        <div class="mb-3">
                            <label for="signer_name" class="form-label">Signer Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="signer_name" name="signer_name" value="{{ old('signer_name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="signer_title" class="form-label">Signer Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="signer_title" name="signer_title" value="{{ old('signer_title') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="signature" class="form-label">Upload Signature <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="signature" name="signature" accept="image/png, image/jpeg" required>
                            <small class="text-muted">Upload a scanned image of your signature (PNG or JPEG, max 2MB).</small>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('credit-application.show-signature') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Proceed to Signature</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
