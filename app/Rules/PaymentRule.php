<?php

namespace App\Rules;

use App\Models\Document;
use App\Models\Payment;

class PaymentRule 
{
    public function createRule($id = null)
    {
        $data=Payment::create([
            'document_id'=>$id,
            'title'=>"Pago",
            'amount'=>Document::find($id)->amount_gross
        ]);
    }
}