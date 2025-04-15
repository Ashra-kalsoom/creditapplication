{{-- File: resources/views/layouts/admin.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
            <a class="navbar-brand" href="{{ route('admin.applications.index') }}">Admin Panel</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.applications.index') }}">Credit Applications</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.application-logs.index') }}">Application Logs</a>
                    </li> --}}
                </ul>
            </div>
        </nav>
        <main>
            @yield('admin-content')
        </main>
    </div>

@endsection
