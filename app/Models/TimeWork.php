<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeWork extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'data_init',
        'data_end',
        'status',
    ];
    public function users()
    {
      return $this->belongsTo(User::class,"user_id");
    }
}
