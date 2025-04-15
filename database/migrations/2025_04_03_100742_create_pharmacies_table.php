<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->id();
            $table->string('legal_name');
            $table->string('dba')->nullable();
            $table->string('bill_address');
            $table->string('bill_city');
            $table->string('bill_state');
            $table->string('bill_zip');
            $table->string('ship_address')->nullable();
            $table->string('ship_city')->nullable();
            $table->string('ship_state')->nullable();
            $table->string('ship_zip')->nullable();
            $table->string('phone');
            $table->string('fax')->nullable();
            $table->string('email');
            $table->string('dea_number');
            $table->date('dea_expiry');
            $table->string('state_license');
            $table->date('license_expiry');
            $table->string('tax_id');
            $table->string('npi_number')->nullable();
            $table->integer('years_in_business')->nullable();
            $table->string('ap_manager_name')->nullable();
            $table->string('ap_manager_email')->nullable();
            $table->string('buyer_name')->nullable();
            $table->string('buyer_email')->nullable();
            $table->enum('ownership_type', ['Sole Proprietor', 'Partnership', 'Corporation', 'LLC']);
            $table->json('owners_info')->nullable();
            $table->string('primary_wholesaler')->nullable();
            $table->string('primary_wholesaler_account')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_contact')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('duns_number')->nullable();
            $table->json('trade_references')->nullable();
            $table->string('financial_institution_name')->nullable();
            $table->string('financial_institution_address')->nullable();
            $table->enum('account_type', ['Checking', 'Savings', 'Lockbox'])->nullable();
            $table->string('name_on_account')->nullable();
            $table->string('depositor_account_number')->nullable();
            $table->string('routing_number')->nullable();
            $table->string('billing_option')->nullable();
            $table->string('business_duration')->nullable();
            $table->string('location_duration')->nullable();
            $table->enum('own_or_rent', ['Own', 'Rent'])->nullable();
            $table->text('landlord_details')->nullable();
            $table->enum('legal_proceeding', ['Yes', 'No'])->nullable();
            $table->enum('felony_conviction', ['Yes', 'No'])->nullable();
            $table->enum('ach_autopayment', ['Yes', 'No'])->nullable();
            $table->string('credit_card_number')->nullable();
            $table->string('credit_card_expiration')->nullable();
            $table->string('credit_card_security_code')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_state_zip')->nullable();
            $table->string('financial_signature')->nullable();
            $table->date('financial_signature_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacies');
    }
};
