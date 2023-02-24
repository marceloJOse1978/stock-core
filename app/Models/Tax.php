<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_id',
        'invoice_id',
        'date',
        'percent',
        'active',
        'total',
    ];

    public function documents()
    {
        return $this->belongsTo(Document::class,"document_id");
    }
    public function invoices()
    {
        return $this->belongsTo(Invoice::class,"invoice_id");
    }

}
