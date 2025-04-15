<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    protected $fillable = [
        'legal_name',
        'dba',
        'bill_address',
        'bill_city',
        'bill_state',
        'bill_zip',
        'ship_address',
        'ship_city',
        'ship_state',
        'ship_zip',
        'phone',
        'fax',
        'email',
        'dea_number',
        'dea_expiry',
        'state_license',
        'license_expiry',
        'tax_id',
        'npi_number',
        'years_in_business',
        'ap_manager_name',
        'ap_manager_email',
        'buyer_name',
        'buyer_email',
        'ownership_type',
        'owners_info',
        'primary_wholesaler',
        'primary_wholesaler_account',
        'bank_name',
        'bank_contact',
        'bank_account',
        'duns_number',
        'trade_references'
    ];

    protected $casts = [
        'dea_expiry' => 'date',
        'license_expiry' => 'date',
        'owners_info' => 'array',
        'trade_references' => 'array'
    ];

    public function creditApplications()
    {
        return $this->hasMany(CreditApplication::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
