<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_bs',
        'nif',
        'address_bs',
        'phone_bs',
        'email_bs',
        'coin',
        'pic_path',
        'text'
    ];
}
