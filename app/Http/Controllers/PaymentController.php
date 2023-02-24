<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\Document;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit($payment, Request $request)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $payment)
    {
        $document=Document::findOrFail($payment);
        $request->validate([
            "title"=>"required",
            "amount"=>"required"
        ]);
        
        if (empty($document->pay)) {
            $document->payments()->create([
                "method_id"=>$request->method_id,
                "title"=>$request->title,
                "amount"=>$request->amount
            ]);
            Cash::create([
                "user_id"=>Auth::id(),
                "title"=>"Documento NO.$document->type $document->number - $request->title",
                "date"=>date("Y-m-d"),
                "amount"=>$request->amount,
                "status"=> true
            ]);
        }

        $data=-1*$document->amount_gross+$document->payments()->sum("amount");
        if ($data >= 0)
            $document->pay=true;

        $document->save();
        
        if ($request->ajax())
        return response()->json([
            'message'=>'Dados Salvar',
            "reload"=>true
        ]);
        
        return redirect()->back()->with("success","Pagamento Realizado");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
