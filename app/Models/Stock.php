<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "document_id",
        "product_id",
        "move",
        "title",
        "qty",
        "unit",
        "discount_for_itens",
        "tax",
        "net_total",
        "gross_total"
    ];
    public function units()
    {
        return $this->belongsTo(Unit::class,"unit");
    }
    public function products()
    {
        return $this->belongsTo(Product::class,"product_id");
    }
    public function documents()
    {
        return $this->belongsTo(Document::class,"document_id");
    }
    public function users()
    {
        return $this->belongsTo(User::class,"user_id");
    }
}
