<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Variant extends Model
{
    use HasFactory,Notifiable;
    protected $fillable = [
        'title',
        'code',
        'active',
    ];
    public function products()
    {
      return $this->hasOne(Product::class);
    }
}
