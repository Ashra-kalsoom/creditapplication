<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'pharmacy_id',
        'type',
        'file_name',
        'file_path',
        'mime_type',
        'file_size'
    ];

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }
}
