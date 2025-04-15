{{-- File: resources/views/admin/applications/show.blade.php --}}

@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Credit Application Details</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Pharmacy Name</th>
                            <td>{{ $application->pharmacy_name }}</td>
                        </tr>
                        <tr>
                            <th>Contact Email</th>
                            <td>{{ $application->contact_email }}</td>
                        </tr>
                        <tr>
                            <th>DEA License</th>
                            <td>{{ $application->dea_license }}</td>
                        </tr>
                        <tr>
                            <th>State License</th>
                            <td>{{ $application->state_license }}</td>
                        </tr>
                        <tr>
                            <th>Bank Information</th>
                            <td>{{ $application->bank_info }}</td>
                        </tr>
                        <tr>
                            <th>Credit References</th>
                            <td>{{ implode(', ', json_decode($application->credit_references)) }}</td>
                        </tr>
                    </table>

                    <h5 class="mt-4">Forward to Supplier</h5>
                    <form method="POST" action="{{ route('admin.credit.forward', $application->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="supplier_email">Supplier Email</label>
                            <input type="email" class="form-control" id="supplier_email" name="supplier_email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Send to Supplier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
