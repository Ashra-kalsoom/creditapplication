{{-- File: resources/views/admin/applications/index.blade.php --}}

@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Manage Credit Applications</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pharmacy Name</th>
                                <th>Contact Phone</th>
                                <th>Contact Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applications as $application)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $application->pharmacy->legal_name }}</td>
                                    <td>{{ $application->pharmacy->phone }}</td>
                                    <td>{{ $application->pharmacy->email }}</td>
                                    <td>
                                        <span class="badge {{ $application->status == 'Approved' ? 'bg-success' : 'bg-warning' }}">
                                            {{ $application->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.applications.view', $application->id) }}" class="btn btn-info btn-sm">View</a>
                                        <form method="POST" action="{{ route('admin.applications.update-status', $application->id) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="Approved">
                                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
