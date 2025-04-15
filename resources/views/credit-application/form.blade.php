<!-- resources/views/credit-application/form.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2>Credit Application Form</h2>
                        <span class="badge bg-info">Step 1 of 4: Business Information</span>
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
                            You are completing a credit application for:
                            <ul class="mb-0">
                                @foreach ($selectedSuppliers as $supplier)
                                    <li>{{ $supplier->name }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <form method="POST" action="{{ route('credit-application.store') }}" id="credit-application-form">
                            @csrf
                            <!-- Step Navigation -->
                            <div class="mb-4">
                                <div class="progress" style="height: 30px;">
                                    <div class="progress-bar" role="progressbar" style="width: 16.66%;" aria-valuenow="16.66" aria-valuemin="0" aria-valuemax="100">Step 1/6</div>
                                </div>
                            </div>

                            <!-- Step 1: Pharmacy Information -->
                            <div class="step" id="step1">
                                <div class="card mb-4">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h4>Step 1: Pharmacy Information</h4>
                                        <span class="badge bg-primary">Step 1 of 6</span>
                                    </div>
                                    <!-- Pharmacy Information content -->

                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="legal_name" class="form-label">Legal Business Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="legal_name" name="legal_name"
                                                    value="{{ old('legal_name') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dba" class="form-label">DBA (Trade Name)</label>
                                                <input type="text" class="form-control" id="dba" name="dba"
                                                    value="{{ old('dba') }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="bill_address" class="form-label">Billing Address <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="bill_address" name="bill_address"
                                                    value="{{ old('bill_address') }}" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-5">
                                                <label for="bill_city" class="form-label">City <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="bill_city" name="bill_city"
                                                    value="{{ old('bill_city') }}" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="bill_state" class="form-label">State <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="bill_state" name="bill_state"
                                                    value="{{ old('bill_state') }}" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="bill_zip" class="form-label">Zip Code <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="bill_zip" name="bill_zip"
                                                    value="{{ old('bill_zip') }}" required>
                                            </div>
                                        </div>

                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="same_address">
                                            <label class="form-check-label" for="same_address">Shipping address is the same as
                                                billing address</label>
                                        </div>

                                        <div id="shipping_address_section">
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label for="ship_address" class="form-label">Shipping Address</label>
                                                    <input type="text" class="form-control" id="ship_address"
                                                        name="ship_address" value="{{ old('ship_address') }}">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-5">
                                                    <label for="ship_city" class="form-label">City</label>
                                                    <input type="text" class="form-control" id="ship_city" name="ship_city"
                                                        value="{{ old('ship_city') }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="ship_state" class="form-label">State</label>
                                                    <input type="text" class="form-control" id="ship_state"
                                                        name="ship_state" value="{{ old('ship_state') }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="ship_zip" class="form-label">Zip Code</label>
                                                    <input type="text" class="form-control" id="ship_zip"
                                                        name="ship_zip" value="{{ old('ship_zip') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="phone" class="form-label">Phone <span
                                                        class="text-danger">*</span></label>
                                                <input type="tel" class="form-control" id="phone" name="phone"
                                                    value="{{ old('phone') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="fax" class="form-label">Fax</label>
                                                <input type="tel" class="form-control" id="fax" name="fax"
                                                    value="{{ old('fax') }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="email" class="form-label">Email <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ old('email') }}" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label class="form-label">Requested Credit Line <span class="text-danger">*</span></label>
                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="requested_credit_line" id="credit_5000" value="5000" {{ old('requested_credit_line') == '5000' ? 'checked' : '' }} required>
                                                        <label class="form-check-label" for="credit_5000">$5,000</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="requested_credit_line" id="credit_25000" value="25000" {{ old('requested_credit_line') == '25000' ? 'checked' : '' }} required>
                                                        <label class="form-check-label" for="credit_25000">$25,000</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="requested_credit_line" id="credit_50000" value="50000" {{ old('requested_credit_line') == '50000' ? 'checked' : '' }} required>
                                                        <label class="form-check-label" for="credit_50000">$50,000</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="requested_credit_line" id="credit_100000plus" value="100000+" {{ old('requested_credit_line') == '100000+' ? 'checked' : '' }} required>
                                                        <label class="form-check-label" for="credit_100000plus">$100,000+</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Pharmacy Information content End-->
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary disabled">Previous</button>
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>

                            <!-- Step 2: License Information -->
                            <div class="step" id="step2" style="display: none;">
                                <div class="card mb-4">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h4>Step 2: License Information</h4>
                                        <span class="badge bg-primary">Step 2 of 6</span>
                                    </div>
                                    <!-- License Information content -->
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="dea_number" class="form-label">DEA Number <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="dea_number" name="dea_number"
                                                    value="{{ old('dea_number') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dea_expiry" class="form-label">DEA Expiration Date <span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="dea_expiry" name="dea_expiry"
                                                    value="{{ old('dea_expiry') }}" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="state_license" class="form-label">State License Number <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="state_license"
                                                    name="state_license" value="{{ old('state_license') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="license_expiry" class="form-label">License Expiration Date <span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="license_expiry"
                                                    name="license_expiry" value="{{ old('license_expiry') }}" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="tax_id" class="form-label">Tax ID Number <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="tax_id" name="tax_id"
                                                    value="{{ old('tax_id') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="npi_number" class="form-label">NPI Number</label>
                                                <input type="text" class="form-control" id="npi_number" name="npi_number"
                                                    value="{{ old('npi_number') }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="years_in_business" class="form-label">Years in Business</label>
                                                <input type="number" class="form-control" id="years_in_business"
                                                    name="years_in_business" value="{{ old('years_in_business') }}"
                                                    min="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>

                            <!-- Step 3: Contact Information -->
                            <div class="step" id="step3" style="display: none;">
                                <div class="card mb-4">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h4>Step 3: Contact Information</h4>
                                        <span class="badge bg-primary">Step 3 of 6</span>
                                    </div>
                                    <!-- Contact Information content -->
                                    <div class="card-body">
                                        <!-- Business Type -->
                                        <div class="mb-3">
                                            <label class="form-label">Business Type <span class="text-danger">*</span></label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="business_type[]" value="Retail Pharmacy" id="business_type_retail">
                                                    <label class="form-check-label" for="business_type_retail">Retail Pharmacy</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="business_type[]" value="Veterinarian" id="business_type_veterinarian">
                                                    <label class="form-check-label" for="business_type_veterinarian">Veterinarian</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="business_type[]" value="Hospital/Clinic" id="business_type_hospital">
                                                    <label class="form-check-label" for="business_type_hospital">Hospital/Clinic</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="business_type[]" value="Mail Order/PBM" id="business_type_mail_order">
                                                    <label class="form-check-label" for="business_type_mail_order">Mail Order/PBM</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="business_type[]" value="Institutional/Hospice" id="business_type_institutional">
                                                    <label class="form-check-label" for="business_type_institutional">Institutional/Hospice</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="business_type[]" value="Wholesaler" id="business_type_wholesaler">
                                                    <label class="form-check-label" for="business_type_wholesaler">Wholesaler</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="business_type[]" value="LTC" id="business_type_ltc">
                                                    <label class="form-check-label" for="business_type_ltc">LTC</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Officers or Owners -->
                                        <div class="mb-3">
                                            <label class="form-label">Officers or Owners <span class="text-danger">*</span></label>
                                            <div id="officers-container">
                                                <!-- Initial required officer fields -->
                                                <div class="officer-entry mb-4" data-index="0">
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Name/Title <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="owners[0][name]" required placeholder="Name/Title">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Phone <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="owners[0][phone]" required placeholder="Phone">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <label class="form-label">Home Address <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="owners[0][home_address]" required placeholder="Home Address">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <label class="form-label">Work Address</label>
                                                            <input type="text" class="form-control" name="owners[0][work_address]" placeholder="Work Address">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-secondary" id="add-officer">
                                                <i class="fas fa-plus"></i> Add Another Officer
                                            </button>
                                        </div>

                                        <!-- Trade References -->
                                        <div class="mb-3">
                                            <label class="form-label">Trade References <span class="text-danger">*</span></label>
                                            <div id="trade-references-container">
                                                <!-- Initial required trade reference -->
                                                <div class="trade-reference mb-4" data-index="0">
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="trade_references[0][name]" required placeholder="Name">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Account # <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="trade_references[0][account]" required placeholder="Account #">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Phone # <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="trade_references[0][phone]" required placeholder="Phone #">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Contact <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="trade_references[0][contact]" required placeholder="Contact">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-secondary" id="add-trade-reference">
                                                <i class="fas fa-plus"></i> Add Another Trade Reference
                                            </button>
                                        </div>

                                        <!-- Bank Reference -->
                                        <div class="mb-3">
                                            <label class="form-label">Bank Reference</label>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="bank_name" class="form-label">Bank Name</label>
                                                    <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Bank Name">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="bank_account" class="form-label">Account #</label>
                                                    <input type="text" class="form-control" id="bank_account" name="bank_account" placeholder="Account #">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="bank_account_type" class="form-label">Account Type</label>
                                                    <input type="text" class="form-control" id="bank_account_type" name="bank_account_type" placeholder="Account Type">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="bank_account_name" class="form-label">Name on Account</label>
                                                    <input type="text" class="form-control" id="bank_account_name" name="bank_account_name" placeholder="Name on Account">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="bank_contact_name" class="form-label">Contact Name</label>
                                                    <input type="text" class="form-control" id="bank_contact_name" name="bank_contact_name" placeholder="Contact Name">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="bank_phone" class="form-label">Phone #</label>
                                                    <input type="text" class="form-control" id="bank_phone" name="bank_phone" placeholder="Phone #">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="hin_number" class="form-label">HIN #</label>
                                                    <input type="text" class="form-control" id="hin_number" name="hin_number" placeholder="HIN #">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="duns_number" class="form-label">DUNS #</label>
                                                    <input type="text" class="form-control" id="duns_number" name="duns_number" placeholder="DUNS #">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Applicant Questionnaire -->
                                        <div class="mb-3">
                                            <label class="form-label">Applicant Questionnaire</label>

                                            <div class="mb-3">
                                                <label class="form-label">Do you engage in internet sales?</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="internet_sales" value="yes" id="internet_sales_yes">
                                                    <label class="form-check-label" for="internet_sales_yes">Yes</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="internet_sales" value="no" id="internet_sales_no">
                                                    <label class="form-check-label" for="internet_sales_no">No</label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Does your pharmacy have a wholesale license?</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="wholesale_license" value="yes" id="wholesale_license_yes">
                                                    <label class="form-check-label" for="wholesale_license_yes">Yes</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="wholesale_license" value="no" id="wholesale_license_no">
                                                    <label class="form-check-label" for="wholesale_license_no">No</label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Is your company affiliated with a wholesale company?</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="wholesale_affiliation" value="yes" id="wholesale_affiliation_yes">
                                                    <label class="form-check-label" for="wholesale_affiliation_yes">Yes</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="wholesale_affiliation" value="no" id="wholesale_affiliation_no">
                                                    <label class="form-check-label" for="wholesale_affiliation_no">No</label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="formerly_known_as" class="form-label">Please list all “formerly known as names”, including all affiliated businesses.</label>
                                                <textarea class="form-control" id="formerly_known_as" name="formerly_known_as" rows="3"></textarea>
                                            </div>
                                        </div>

                                        <!-- Owner/Officer Signature -->
                                        <div class="mb-3">
                                            <label class="form-label">Owner/Officer Signature</label>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="signature" class="form-label">Signature</label>
                                                    <input type="text" class="form-control" id="signature" name="signature" placeholder="Signature">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="printed_name" class="form-label">Printed Name</label>
                                                    <input type="text" class="form-control" id="printed_name" name="printed_name" placeholder="Printed Name">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="date" class="form-label">Date</label>
                                                    <input type="date" class="form-control" id="date" name="date">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>

                            <!-- Step 4: Financial Information -->
                            <div class="step" id="step4" style="display: none;">
                                <div class="card mb-4">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h4>Step 4: Financial Information</h4>
                                        <span class="badge bg-primary">Step 4 of 6</span>
                                    </div>
                                    <!-- Financial Information content -->
                                    <div class="card-body">
                                        <!-- Financial Institution Information -->
                                        <div class="mb-3">
                                            <label for="financial_institution_name" class="form-label">Name of Financial Institution</label>
                                            <input type="text" class="form-control" id="financial_institution_name" name="financial_institution_name" placeholder="Name of Financial Institution">
                                        </div>
                                        <div class="mb-3">
                                            <label for="financial_institution_address" class="form-label">Financial Institution Address</label>
                                            <input type="text" class="form-control" id="financial_institution_address" name="financial_institution_address" placeholder="Financial Institution Address">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Type of Account</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="account_type" value="Checking" id="account_type_checking">
                                                <label class="form-check-label" for="account_type_checking">Checking</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="account_type" value="Savings" id="account_type_savings">
                                                <label class="form-check-label" for="account_type_savings">Savings</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="account_type" value="Lockbox" id="account_type_lockbox">
                                                <label class="form-check-label" for="account_type_lockbox">Lockbox</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name_on_account" class="form-label">Name on Account</label>
                                            <input type="text" class="form-control" id="name_on_account" name="name_on_account" placeholder="Name on Account">
                                        </div>
                                        <div class="mb-3">
                                            <label for="depositor_account_number" class="form-label">Depositor Account Number</label>
                                            <input type="text" class="form-control" id="depositor_account_number" name="depositor_account_number" placeholder="Depositor Account Number">
                                        </div>
                                        <div class="mb-3">
                                            <label for="routing_number" class="form-label">Nine Digit Routing Transit Number</label>
                                            <input type="text" class="form-control" id="routing_number" name="routing_number" placeholder="Routing Number">
                                        </div>

                                        <!-- Billing Info -->
                                        <div class="mb-3">
                                            <label class="form-label">Billing Info</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="billing_option" value="Twice Monthly Payment" id="billing_option_twice_monthly">
                                                <label class="form-check-label" for="billing_option_twice_monthly">
                                                    Twice Monthly Payment - All invoices from the 1st to the 15th of the Month will be withdrawn on the 30th of the same month (or the last business day preceding the 30th)
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Business Details -->
                                        <div class="mb-3">
                                            <label for="business_duration" class="form-label">How long in business?</label>
                                            <input type="text" class="form-control" id="business_duration" name="business_duration" placeholder="How long in business?">
                                        </div>
                                        <div class="mb-3">
                                            <label for="location_duration" class="form-label">How long at this location?</label>
                                            <input type="text" class="form-control" id="location_duration" name="location_duration" placeholder="How long at this location?">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Own or Rent Business Location?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="own_or_rent" value="Own" id="own_location">
                                                <label class="form-check-label" for="own_location">Own</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="own_or_rent" value="Rent" id="rent_location">
                                                <label class="form-check-label" for="rent_location">Rent</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="landlord_details" class="form-label">If rent, name, address, and telephone no. of landlord</label>
                                            <textarea class="form-control" id="landlord_details" name="landlord_details" rows="3" placeholder="Landlord details"></textarea>
                                        </div>

                                        <!-- Legal Questions -->
                                        <div class="mb-3">
                                            <label class="form-label">Is Applicant (or Principal(s) thereof) currently a defendant in any legal proceeding?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="legal_proceeding" value="Yes" id="legal_proceeding_yes">
                                                <label class="form-check-label" for="legal_proceeding_yes">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="legal_proceeding" value="No" id="legal_proceeding_no">
                                                <label class="form-check-label" for="legal_proceeding_no">No</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Has Applicant or any principal(s) ever been charged/convicted with a felony or misdemeanor?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="felony_conviction" value="Yes" id="felony_conviction_yes">
                                                <label class="form-check-label" for="felony_conviction_yes">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="felony_conviction" value="No" id="felony_conviction_no">
                                                <label class="form-check-label" for="felony_conviction_no">No</label>
                                            </div>
                                        </div>

                                        <!-- ACH Autopayment -->
                                        <div class="mb-3">
                                            <label class="form-label">ACH Autopayment</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="ach_autopayment" value="Yes" id="ach_autopayment">
                                                <label class="form-check-label" for="ach_autopayment">Enable ACH Autopayment</label>
                                            </div>
                                        </div>

                                        <!-- Credit Card Information -->
                                        <div class="mb-3">
                                            <label class="form-label">Credit Card Information</label>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="credit_card_number" class="form-label">Card Number</label>
                                                    <input type="text" class="form-control" id="credit_card_number" name="credit_card_number" placeholder="Card Number">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="credit_card_expiration" class="form-label">Expiration Date</label>
                                                    <input type="text" class="form-control" id="credit_card_expiration" name="credit_card_expiration" placeholder="MM/YY">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="credit_card_security_code" class="form-label">Security Code</label>
                                                    <input type="text" class="form-control" id="credit_card_security_code" name="credit_card_security_code" placeholder="CVV">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <label for="billing_address" class="form-label">Billing Address</label>
                                                    <input type="text" class="form-control" id="billing_address" name="billing_address" placeholder="Billing Address">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="billing_city" class="form-label">City</label>
                                                    <input type="text" class="form-control" id="billing_city" name="billing_city" placeholder="City">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="billing_state_zip" class="form-label">State/Zip Code</label>
                                                    <input type="text" class="form-control" id="billing_state_zip" name="billing_state_zip" placeholder="State/Zip Code">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Signature -->
                                        <div class="mb-3">
                                            <label for="financial_signature" class="form-label">Signature</label>
                                            <input type="text" class="form-control" id="financial_signature" name="financial_signature" placeholder="Signature">
                                        </div>
                                        <div class="mb-3">
                                            <label for="financial_signature_date" class="form-label">Date</label>
                                            <input type="date" class="form-control" id="financial_signature_date" name="financial_signature_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>

                            <!-- Step 5: Ownership Information -->
                            <div class="step" id="step5" style="display: none;">
                                <div class="card mb-4">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h4>Step 5: Ownership Information</h4>
                                        <span class="badge bg-primary">Step 5 of 6</span>
                                    </div>
                                    <!-- Ownership Information content -->
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Ownership Type <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="ownership_type"
                                                            id="ownership_sole" value="Sole Proprietor"
                                                            {{ old('ownership_type') == 'Sole Proprietor' ? 'checked' : '' }}
                                                            required>
                                                        <label class="form-check-label" for="ownership_sole">Sole
                                                            Proprietor</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="ownership_type"
                                                            id="ownership_partnership" value="Partnership"
                                                            {{ old('ownership_type') == 'Partnership' ? 'checked' : '' }}
                                                            required>
                                                        <label class="form-check-label"
                                                            for="ownership_partnership">Partnership</label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="ownership_type"
                                                            id="ownership_corporation" value="Corporation"
                                                            {{ old('ownership_type') == 'Corporation' ? 'checked' : '' }}
                                                            required>
                                                        <label class="form-check-label"
                                                            for="ownership_corporation">Corporation</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="ownership_type"
                                                            id="ownership_llc" value="LLC"
                                                            {{ old('ownership_type') == 'LLC' ? 'checked' : '' }} required>
                                                        <label class="form-check-label" for="ownership_llc">LLC</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="owner_name" class="form-label">Owner/Officer Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="owner_name" name="owner_name"
                                                    value="{{ old('owner_name') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="owner_title" class="form-label">Title <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="owner_title"
                                                    name="owner_title" value="{{ old('owner_title') }}" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="owner_address" class="form-label">Home Address <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="owner_address"
                                                    name="owner_address" value="{{ old('owner_address') }}" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="owner_ssn" class="form-label">Social Security Number <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="owner_ssn" name="owner_ssn"
                                                    value="{{ old('owner_ssn') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="owner_dob" class="form-label">Date of Birth <span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="owner_dob" name="owner_dob"
                                                    value="{{ old('owner_dob') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>

                            <!-- Step 6: Terms Acknowledgment -->
                            <div class="step" id="step6" style="display: none;">
                                <div class="card mb-4">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h4>Step 6: Terms Acknowledgment</h4>
                                        <span class="badge bg-primary">Step 6 of 6</span>
                                    </div>
                                    <!-- Terms Acknowledgment content -->
                                    <div class="card-body">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="terms_agree"
                                                name="terms_agree" required>
                                            <label class="form-check-label" for="terms_agree">
                                                I acknowledge that I have read and agree to the terms and conditions, and all
                                                information provided is accurate.
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                    <button type="submit" class="btn btn-success">Submit Application</button>
                                </div>
                            </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 6;

    function updateProgressBar() {
        const progress = (currentStep / totalSteps) * 100;
        const progressBar = document.querySelector('.progress-bar');
        progressBar.style.width = `${progress}%`;
        progressBar.textContent = `Step ${currentStep}/${totalSteps}`;
    }

    function showStep(step) {
        document.querySelectorAll('.step').forEach(el => el.style.display = 'none');
        document.getElementById(`step${step}`).style.display = 'block';
        currentStep = step;
        updateProgressBar();
    }

    document.querySelectorAll('.next-step').forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep < totalSteps) {
                showStep(currentStep + 1);
            }
        });
    });

    document.querySelectorAll('.prev-step').forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        });
    });

    // Initialize first step
    showStep(1);
});
</script>

                            {{-- <div class="d-grid gap-2 d-md-flex justify-content-md-end d-none hide">
                                <button type="submit" class="btn btn-primary">Submit Application</button>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('same_address').addEventListener('change', function() {
            const shippingSection = document.getElementById('shipping_address_section');

            const billingAddress = document.getElementById('bill_address');
            const shippingAddress = document.getElementById('ship_address');
            const billingCity = document.getElementById('bill_city');
            const shippingCity = document.getElementById('ship_city');
            const billingState = document.getElementById('bill_state');
            const shippingState = document.getElementById('ship_state');
            const billingZip = document.getElementById('bill_zip');
            const shippingZip = document.getElementById('bill_zip');
            if (this.checked) {
                shippingAddress.value = billingAddress.value;
                shippingCity.value = billingCity.value;
                shippingState.value = billingState.value;
                shippingZip.value = billingZip.value;
            } else {
                shippingAddress.value = '';
                shippingCity.value = '';
                shippingState.value = '';
                shippingZip.value = '';
            }

        });

        let officerCount = 1;

        document.getElementById('add-officer').addEventListener('click', function() {
            const container = document.getElementById('officers-container');
            const newOfficer = document.createElement('div');
            newOfficer.className = 'officer-entry mb-4';
            newOfficer.setAttribute('data-index', officerCount);

            newOfficer.innerHTML = `
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5>Additional Officer</h5>
                    <button type="button" class="btn btn-danger btn-sm remove-officer">
                        <i class="fas fa-times"></i> Remove
                    </button>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Name/Title</label>
                        <input type="text" class="form-control" name="owners[${officerCount}][name]" placeholder="Name/Title">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="owners[${officerCount}][phone]" placeholder="Phone">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Home Address</label>
                        <input type="text" class="form-control" name="owners[${officerCount}][home_address]" placeholder="Home Address">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Work Address</label>
                        <input type="text" class="form-control" name="owners[${officerCount}][work_address]" placeholder="Work Address">
                    </div>
                </div>
            `;

            container.appendChild(newOfficer);
            officerCount++;

            // Add event listener to remove button
            newOfficer.querySelector('.remove-officer').addEventListener('click', function() {
                newOfficer.remove();
            });
        });

        let tradeReferenceCount = 1;

        document.getElementById('add-trade-reference').addEventListener('click', function() {
            const container = document.getElementById('trade-references-container');
            const newReference = document.createElement('div');
            newReference.className = 'trade-reference mb-4';
            newReference.setAttribute('data-index', tradeReferenceCount);

            newReference.innerHTML = `
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5>Additional Trade Reference</h5>
                    <button type="button" class="btn btn-danger btn-sm remove-trade-reference">
                        <i class="fas fa-times"></i> Remove
                    </button>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="trade_references[${tradeReferenceCount}][name]" placeholder="Name">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Account #</label>
                        <input type="text" class="form-control" name="trade_references[${tradeReferenceCount}][account]" placeholder="Account #">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Phone #</label>
                        <input type="text" class="form-control" name="trade_references[${tradeReferenceCount}][phone]" placeholder="Phone #">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contact</label>
                        <input type="text" class="form-control" name="trade_references[${tradeReferenceCount}][contact]" placeholder="Contact">
                    </div>
                </div>
            `;

            container.appendChild(newReference);
            tradeReferenceCount++;

            // Add event listener to remove button
            newReference.querySelector('.remove-trade-reference').addEventListener('click', function() {
                newReference.remove();
            });
        });

    });
</script>

