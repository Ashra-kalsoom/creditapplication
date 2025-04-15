<!-- resources/views/credit-application/supplier-select.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2>Select Suppliers for Credit Application</h2>
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

                    <form method="POST" action="{{ route('credit-application.create') }}">
                        @csrf
                        <div class="mb-4">
                            <p>Please select the suppliers you would like to apply for credit with:</p>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="select-all">
                                    <label class="form-check-label" for="select-all">
                                        <strong>Select All</strong>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                @foreach($suppliers as $supplier)
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input supplier-checkbox" type="checkbox"
                                                   name="suppliers[]" value="{{ $supplier->id }}"
                                                   id="supplier-{{ $supplier->id }}">
                                            <label class="form-check-label" for="supplier-{{ $supplier->id }}">
                                                {{ $supplier->name }}
                                                @if($supplier->description)
                                                    <small class="text-muted d-block">{{ $supplier->description }}</small>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" id="continue-btn">
                                Continue to Application
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('select-all');
        const supplierCheckboxes = document.querySelectorAll('.supplier-checkbox');
        const continueBtn = document.getElementById('continue-btn');

        // Function to update the continue button state
        function updateContinueButton() {
            const anyChecked = Array.from(supplierCheckboxes).some(cb => cb.checked);
            continueBtn.disabled = !anyChecked;
        }

        // Select all functionality
        selectAllCheckbox.addEventListener('change', function() {
            supplierCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateContinueButton();
        });

        // Individual checkbox change handlers
        supplierCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateContinueButton();

                // Update "select all" checkbox state
                const allChecked = Array.from(supplierCheckboxes).every(cb => cb.checked);
                selectAllCheckbox.checked = allChecked;
            });
        });
    });
</script>
@endsection
