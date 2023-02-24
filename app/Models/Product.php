<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Stock;

class Product extends Model
{
    use HasFactory,Notifiable;
    protected $fillable = [
        'id',
        'order',
        'reference',
        'barcode',
        'supplier_code',
        'title',
        'description',
        'include_description',
        'supply_price',
        'gross_price',
        'class_name',
        'tax_id',
        'type_id',
        'stock_control',
        'stock_type',
        'tax_exemption',
        'tax_exemption_law',
        'status',
        'stock',
        'stock_alert',
        'unit',
        'pic_path',
        'unit_id',
        'variant_id',
        'category_id',
        'brand_id',
    ];
    public function items()
    {
      return $this->hasOne(Item::class);
    }
    public function stocks()
    {
      return $this->hasOne(Stock::class);
    }
    public function packges()
    {
      return $this->hasOne(Packge::class);
    }
    public function variants()
    {
      return $this->belongsTo(Variant::class,"variant_id");
    }
    public function category()
    {
      return $this->belongsTo(Type::class,"category_id");
    }
    public function brands()
    {
      return $this->belongsTo(Brands::class,"brand_id");
    }
    public function units()
    {
      return $this->belongsTo(Unit::class,"unit_id");
    }
}
