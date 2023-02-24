<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Providers extends Model
{
    use HasFactory,Notifiable;
    protected $fillable = [
        'code',
        'name',
        'reference',
        'address',
        'city',
        'code_postal',
        'phone',
        'mobile',
        'email',
        'country',
        'website',
        'send_mail',
        'active',
    ];
    public function invoices()
    {
        return $this->hasMany(Invoice::class,"provider_id");
    }
}
