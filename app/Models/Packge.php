<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packge extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'title',
        'obs',
        'url',
        'pic_path',
    ];
    public function products()
    {
      return $this->belongsTo(Product::class,"product_id");
    }
}
