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
        'iban_1',
        'account_1',
        'iban_2',
        'account_2',
        'coin',
        'pic_path',
        'text'
    ];
}
