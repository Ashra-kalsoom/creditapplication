{{-- filepath: resources/views/credit-application/review.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Review Credit Application</h2>
                    <span class="badge bg-info">Step 2 of 4: Review</span>
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

                    <div class="alert alert-info">
                        <strong>Pharmacy Information:</strong>
                        <ul>
                            <li><strong>Legal Name:</strong> {{ $pharmacy->legal_name }}</li>
                            <li><strong>DBA:</strong> {{ $pharmacy->dba ?? 'N/A' }}</li>
                            <li><strong>Billing Address:</strong> {{ $pharmacy->bill_address }}, {{ $pharmacy->bill_city }}, {{ $pharmacy->bill_state }} {{ $pharmacy->bill_zip }}</li>
                            <li><strong>Shipping Address:</strong> {{ $pharmacy->ship_address ?? 'Same as Billing' }}</li>
                            <li><strong>Phone:</strong> {{ $pharmacy->phone }}</li>
                            <li><strong>Email:</strong> {{ $pharmacy->email }}</li>
                        </ul>
                    </div>

                    <div class="alert alert-secondary">
                        <strong>Applications for Selected Suppliers:</strong>
                        <ul>
                            @foreach ($applications as $application)
                                <li>
                                    <strong>Supplier:</strong> {{ $application->supplier->name }}<br>
                                    <strong>Requested Credit Line:</strong> {{ $application->requested_credit_line ?? 'N/A' }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between">
                        {{-- <a href="{{ route('credit-application.form') }}" class="btn btn-secondary">Back</a> --}}
                        <a href="{{ route('credit-application.show-signature') }}" class="btn btn-primary">Proceed to Signature</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
