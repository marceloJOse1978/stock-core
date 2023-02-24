<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
      'id',
      'document_id',
      'product_id',
      'qty',
      'unit',
      'title',
      'impost',
      'total_tax',
      'tax',
      'discount_for_itens',
      'reference',
      'net_total',
      'gross_total',
    ];
    public function products()
    {
      return $this->belongsTo(Product::class,"product_id");
    }
    public function documents()
    {
      return $this->belongsTo(Document::class,"document_id");
    }
    public function stocks()
    {
      return $this->hasOne(Stock::class);
    }
}
