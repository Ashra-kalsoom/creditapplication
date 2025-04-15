{{-- filepath: resources/views/admin/applications/view.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2>Credit Application Details</h2>
                </div>
                <div class="card-body">
                    {{-- Credit Application Details --}}
                    <h4>Application Details</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>Status</th>
                            <td>{{ ucfirst($application->status) }}</td>
                        </tr>
                        <tr>
                            <th>Requested Credit Line</th>
                            <td>{{ $application->requested_credit_line ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Signer Name</th>
                            <td>{{ $application->signer_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Signer Title</th>
                            <td>{{ $application->signer_title ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Signed At</th>
                            <td>{{ $application->signed_at ? $application->signed_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>IP Address</th>
                            <td>{{ $application->ip_address ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Admin Notes</th>
                            <td>{{ $application->admin_notes ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>PDF Path</th>
                            <td>
                                @if ($application->pdf_path)
                                    <a href="{{ route('admin.applications.download-pdf', $application->id) }}" target="_blank">Download PDF</a>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    </table>

                    {{-- Pharmacy Details --}}
                    <h4>Pharmacy Details</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>Legal Name</th>
                            <td>{{ $application->pharmacy->legal_name }}</td>
                        </tr>
                        <tr>
                            <th>DBA</th>
                            <td>{{ $application->pharmacy->dba ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Billing Address</th>
                            <td>{{ $application->pharmacy->bill_address }}, {{ $application->pharmacy->bill_city }}, {{ $application->pharmacy->bill_state }} {{ $application->pharmacy->bill_zip }}</td>
                        </tr>
                        <tr>
                            <th>Shipping Address</th>
                            <td>{{ $application->pharmacy->ship_address ?? 'Same as Billing' }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $application->pharmacy->phone }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $application->pharmacy->email }}</td>
                        </tr>
                        <tr>
                            <th>DEA Number</th>
                            <td>{{ $application->pharmacy->dea_number }}</td>
                        </tr>
                        <tr>
                            <th>DEA Expiry</th>
                            <td>{{ $application->pharmacy->dea_expiry }}</td>
                        </tr>
                        <tr>
                            <th>State License</th>
                            <td>{{ $application->pharmacy->state_license }}</td>
                        </tr>
                        <tr>
                            <th>License Expiry</th>
                            <td>{{ $application->pharmacy->license_expiry }}</td>
                        </tr>
                        <tr>
                            <th>Tax ID</th>
                            <td>{{ $application->pharmacy->tax_id }}</td>
                        </tr>
                        <tr>
                            <th>Ownership Type</th>
                            <td>{{ $application->pharmacy->ownership_type }}</td>
                        </tr>
                    </table>

                    {{-- Supplier Details --}}
                    <h4>Supplier Details</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>Supplier Name</th>
                            <td>{{ $application->supplier->name }}</td>
                        </tr>
                        <tr>
                            <th>Contact Email</th>
                            <td>{{ $application->supplier->email ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $application->supplier->phone ?? 'N/A' }}</td>
                        </tr>
                    </table>

                    {{-- Documents --}}
                    <h4>Uploaded Documents</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>DEA License</th>
                            <td>
                                @if ($documents->where('type', 'dea_license')->first())
                                    <a href="{{ route('documents.download', ['type' => 'dea_license', 'id' => $documents->where('type', 'dea_license')->first()->id]) }}" target="_blank">Download DEA License</a>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>State License</th>
                            <td>
                                @if ($documents->where('type', 'state_license')->first())
                                    <a href="{{ route('documents.download', ['type' => 'state_license', 'id' => $documents->where('type', 'state_license')->first()->id]) }}" target="_blank">Download State License</a>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    </table>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.applications.index') }}" class="btn btn-secondary">Back to Applications</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
