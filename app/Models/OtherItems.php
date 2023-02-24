<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'product_id',
        'reference',
        'title',
        'qty',
        'unit',
        'discount_for_itens',
        'impost',
        'total_tax',
        'tax',
        'net_total',
        'gross_total',
    ];
    public function invoices()
    {
      return $this->belongsTo(Invoice::class,"invoice_id");
    }
    public function other_items()
    {
      return $this->hasOne(OtherItems::class);
    }
}
