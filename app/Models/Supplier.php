<?php
// app/Models/Supplier.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'template_name',
        'active',
        'description',
        'field_mappings'
    ];

    protected $casts = [
        'active' => 'boolean',
        'field_mappings' => 'array'
    ];

    public function creditApplications()
    {
        return $this->hasMany(CreditApplication::class);
    }
}
