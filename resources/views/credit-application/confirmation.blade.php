{{-- filepath: resources/views/credit-application/confirmation.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Application Submitted</h2>
                </div>
                <div class="card-body text-center">
                    <p class="lead">Thank you for submitting your credit application!</p>
                    <p>Your application has been successfully submitted and is now under review. We will contact you shortly if additional information is required.</p>
                    <p>If you have any questions, feel free to contact our support team.</p>
                    <a href="{{ route('credit-application.index') }}" class="btn btn-primary mt-3">Start a New Application</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
