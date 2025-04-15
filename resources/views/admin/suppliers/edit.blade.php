@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Supplier</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.suppliers.update', $supplier->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $supplier->name) }}"
                                   required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="template_name">Template Name</label>
                            <input type="text"
                                   class="form-control @error('template_name') is-invalid @enderror"
                                   id="template_name"
                                   name="template_name"
                                   value="{{ old('template_name', $supplier->template_name) }}"
                                   required>
                            @error('template_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description"
                                      name="description"
                                      rows="3">{{ old('description', $supplier->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox"
                                       class="custom-control-input"
                                       id="active"
                                       name="active"
                                       value="1"
                                       {{ old('active', $supplier->active) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="active">Active</label>
                            </div>
                            @error('active')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="field_mappings">Field Mappings</label>
                            <textarea class="form-control @error('field_mappings') is-invalid @enderror"
                                      id="field_mappings"
                                      name="field_mappings"
                                      rows="5">{{ old('field_mappings', json_encode($supplier->field_mappings, JSON_PRETTY_PRINT)) }}</textarea>
                            @error('field_mappings')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Supplier</button>
                            <a href="{{ route('admin.suppliers.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Add any JavaScript for field mappings handling if needed
    document.addEventListener('DOMContentLoaded', function() {
        // Ensure field_mappings contains valid JSON
        const fieldMappingsTextarea = document.getElementById('field_mappings');
        fieldMappingsTextarea.addEventListener('blur', function() {
            try {
                const json = JSON.parse(this.value);
                this.value = JSON.stringify(json, null, 2);
            } catch (e) {
                // Invalid JSON - leave as is
            }
        });
    });
</script>
@endpush
