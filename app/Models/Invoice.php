<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
  use HasFactory;
  protected $fillable = [
    'provider_id',
    'user_id',
    'number',
    'date',
    'status',
    'pay',
    'amount_gross',
    'amount_net',
    'date_due',
    'discount',
    'observations',
    'external_reference',
  ];

  public function providers(){

    return $this->belongsTo(Providers::class,"provider_id");
    
  }

  public function users(){

    return $this->belongsTo(User::class,"user_id");

  }

  public function invoices(){

    return $this->hasOne(Invoice::class);

  }

  public function stocks(){

    return $this->hasMany(Stock::class);

  }

  public function other_items(){

    return $this->hasMany(OtherItems::class);

  }
}
