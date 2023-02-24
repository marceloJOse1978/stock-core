<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'date',
        'status',
        'amount',
    ];

    public function users()
    {
        return $this->belongsTo(User::class,"user_id");
    }

}
