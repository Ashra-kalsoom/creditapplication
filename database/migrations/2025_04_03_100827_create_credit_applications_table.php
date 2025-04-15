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
        Schema::create('credit_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pharmacy_id')->constrained()->onDelete('cascade');
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
            $table->enum('status', [
                'draft',
                'submitted',
                'under_review',
                'approved',
                'rejected'
            ])->default('draft');
            $table->string('signature')->nullable();
            $table->string('signer_name')->nullable();
            $table->string('signer_title')->nullable();
            $table->dateTime('signed_at')->nullable();
            $table->string('ip_address')->nullable();
            $table->enum('requested_credit_line', ['5000', '25000', '50000', '100000+'])->nullable();
            $table->text('admin_notes')->nullable();
            $table->boolean('sent_to_supplier')->default(false);
            $table->dateTime('sent_at')->nullable();
            $table->string('pdf_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_applications');
    }
};
