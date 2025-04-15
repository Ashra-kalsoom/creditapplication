{{-- File: resources/views/admin/dashboard.blade.php --}}

@extends('layouts.admin')

@section('admin-content')
<div class="container mt-4">
    <h2 class="mb-4">Admin Dashboard</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Credit Applications</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $statistics['total_applications'] }}</h5>
                    <p class="card-text">Total credit applications received.</p>
                    <a href="{{ route('admin.applications.index') }}" class="btn btn-light">View Applications</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Pending Applications</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $statistics['pending_applications'] }}</h5>
                    <p class="card-text">Total Pending credit applications received.</p>
                    <a href="{{ route('admin.applications.index') }}" class="btn btn-light">View Applications</a>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
