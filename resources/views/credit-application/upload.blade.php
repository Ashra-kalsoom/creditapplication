{{-- filepath: resources/views/credit-application/upload.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Upload Documents</h2>
                    <span class="badge bg-info">Step 4 of 4: Document Upload</span>
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

                    <form method="POST" action="{{ route('credit-application.store-documents') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="dea_license" class="form-label">DEA License (PDF, JPG, PNG) <span class="text-muted">(Optional)</span></label>
                            <input type="file" class="form-control" id="dea_license" name="dea_license" accept=".pdf,.jpg,.jpeg,.png">
                            @if ($deaDocument)
                                <small class="text-success">Existing File: <a href="{{ route('documents.download', ['type' => 'dea_license', 'id' => $deaDocument->id]) }}" target="_blank">{{ $deaDocument->file_name }}</a></small>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="state_license" class="form-label">State License (PDF, JPG, PNG) <span class="text-muted">(Optional)</span></label>
                            <input type="file" class="form-control" id="state_license" name="state_license" accept=".pdf,.jpg,.jpeg,.png">
                            @if ($stateDocument)
                                <small class="text-success">Existing File: <a href="{{ route('documents.download', ['type' => 'state_license', 'id' => $stateDocument->id]) }}" target="_blank">{{ $stateDocument->file_name }}</a></small>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('credit-application.show-signature') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Submit Documents</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
