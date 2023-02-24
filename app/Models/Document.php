<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'client_id',
        'user_id',
        'type',
        'number',
        'date',
        'status',
        'pay',
        'amount_net',
        'amount_gross',
        'date_due',
        'discount',
        'observations',
        'external_reference',
        
    ];
    public function items()
    {
      return $this->hasMany(Item::class);
    }
    public function payments()
    {
      return $this->hasOne(Payment::class);
    }
    public function taxes()
    {
      return $this->hasOne(Tax::class);
    }
    public function stocks()
    {
      return $this->hasOne(Stock::class);
    }
    public function products()
    {
      return $this->hasOne(Product::class);
    }
    public function clients()
    {
      return $this->belongsTo(Clients::class,"client_id");
    }
    public function users()
    {
      return $this->belongsTo(User::class,"user_id");
    }
}
