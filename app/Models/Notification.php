<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
      'event_id',
      'user_id',
      'role',
      'type',
      'status',
      'message',
    ];
    public function products()
    {
      return $this->hasOne(Product::class);
    }
}
