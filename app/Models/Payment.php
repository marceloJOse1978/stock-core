<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_id',
        'method_id',
        'title',
        'amount'
        
    ];
    public function documents()
    {
        return $this->belongsTo(Document::class,"document_id");
    }
    public function methods()
    {
        return $this->belongsTo(Methods::class,"method_id");
    }
}
