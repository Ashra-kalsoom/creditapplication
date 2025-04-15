<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'pharmacy_id',
        'supplier_id',
        'status',
        'signature',
        'signer_name',
        'signer_title',
        'signed_at',
        'ip_address',
        'requested_credit_line',
        'admin_notes',
        'sent_to_supplier',
        'sent_at',
        'pdf_path'
    ];

    protected $casts = [
        'signed_at' => 'datetime',
        'sent_at' => 'datetime',
        'sent_to_supplier' => 'boolean'
    ];

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
