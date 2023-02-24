<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxProviders extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'date',
        'percent',
        'active',
        'total',
    ];
    public function invoices()
    {
        return $this->belongsTo(Invoice::class,"invoice_id");
    }
}
