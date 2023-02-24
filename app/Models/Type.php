<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Type extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];
    protected $fillable = [
        'title',
        'on',
        'order',
        'all_stores',
        'products_order',
        'kitchen_request',
    ];

    public function products()
    {
      return $this->hasOne(Product::class);
    }
}
