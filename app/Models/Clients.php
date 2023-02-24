<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Clients extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];
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
    
    public function documents()
    {
        return $this->hasOne(Document::class);
    }
}
