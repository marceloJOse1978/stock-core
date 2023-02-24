<?php

namespace App\Rules;

use App\Models\Cash;
use App\Models\Invoice;
use App\Models\OtherItems;
use App\Models\Product;
use App\Models\Tax;
use Illuminate\Support\Facades\Auth;

class InvoiceRule 
{
    public function totalRules($request,$id=null)
    {
        $sql["net_total"]=(empty($request->gross_total)) ? Product::find( (empty($request->product_id)) ? $id : $request->product_id)->supply_price : $request->gross_total ;
        $sql["gross_total"] = (empty($request->gross_total)) ? Product::find((empty($request->product_id)) ? $id : $request->product_id)->supply_price * $request->qty : $request->gross_total * $request->qty;
        return $sql;
    }
    public function taxes($id = null)
    {
        $data= Product::find($id);
        $amount= $data->supply_price*$data->tax_id/100;
        return $amount;
    }
    public function registerRules($request, $id=null)
    {
        if (empty($_SESSION["invoice_id"])) {
            $invoice=Invoice::create([
                'provider_id'=>$request->provider_id,
                'user_id'=>Auth::id(),
                'number'=>$request->number,
                'date'=>$request->date,
                'status'=>0,
                'pay'=>(empty($request->pay))? 0 : $request->pay,
                'amount_gross'=>(empty($request->amount_gross)) ? 0 : $request->amount_gross,
                'amount_net'=>(empty($request->amount_net)) ? 0 : $request->amount_net,
                'date_due'=>( empty($request->date_due) ) ? date('Y-m-d', strtotime('+15 days')) : $request->date_due,
                'discount'=>(empty($request->discount))? 0 : $request->discount,
                'observations'=>$request->observations,
                'external_reference'=>$request->external_reference,
            ]);
            $qty=(empty($request->qty)) ? 1 : $request->qty;
            $product=Product::find($id);
            $invoice->other_items()->create(
                [
                    'product_id' => (!empty($id)) ? $id : 0,
                    'title'=>(!empty($id)) ? $product->title : $request->title,
                    'qty' => $qty,
                    'unit'=>(!empty($id)) ? $product->units->title : $request->unit,
                    'tax'=>(!empty($id)) ? $product->tax_id : $request->tax,
                    'total_tax'=>(!empty($id) && empty($request->gross_total)) ? $this->taxes($id)*$qty : ($request->gross_total * $request->tax/100 ) * $qty,
                    'impost'=>(!empty($id) && empty($request->gross_total)) ? $this->taxes($id) : $request->gross_total * $request->tax/100 ,
                    'discount_for_itens'=>(empty($request->discount_for_itens)) ? 0 : $request->discount_for_itens,
                    'net_total'=>(!empty($id) && empty($request->gross_total)) ? $this->totalRules($request,$id)["net_total"]:$request->gross_total,
                    'gross_total'=>(!empty($id) && empty($request->gross_total)) ? $this->totalRules($request,$id)["gross_total"]:$request->gross_total, 
                ]
            );
            $_SESSION["invoice_id"]=$invoice->id;
        } 
        else {
            $qty=(empty($request->qty)) ? 1 : $request->qty;
            if (empty(Invoice::find($_SESSION["invoice_id"])->status)) {
                $product=Product::find($id);
                $invoice=OtherItems::create([
                    'invoice_id' => $_SESSION["invoice_id"],
                    'product_id' => (!empty($id)) ? $id : 0,
                    'title'=>(!empty($id)) ? $product->title : $request->title,
                    'qty' => $qty,
                    'unit'=>(!empty($id)) ? $product->units->title : $request->unit,
                    'tax'=>(!empty($id)) ? $product->tax_id : $request->tax,
                    'total_tax'=>(!empty($id)) ? $this->taxes($id)*$qty : ($request->gross_total * $request->tax/100 ) * $qty,
                    'impost'=>(!empty($id)) ? $this->taxes($id) : $request->gross_total * $request->tax/100 ,
                    'discount_for_itens'=>(empty($request->discount_for_itens)) ? 0 : $request->discount_for_itens,
                    'net_total'=>(!empty($id)) ? $this->totalRules($request,$id)["net_total"]:$request->gross_total,
                    'gross_total'=>(!empty($id)) ? $this->totalRules($request,$id)["gross_total"]:$request->gross_total,
                ]);
            }
        }
        return $invoice;
    }
    public function finalizeRules($id=null,$request){

        $data=Invoice::findOrFail($id);
        $total= $this->reportInvoiceRules($id);
        if (empty($data->status)) {
            $data->provider_id=$request->provider_id;
            $data->user_id=Auth::id();
            $data->number=$request->number;
            $data->date=$request->date;
            $data->status=1;
            $data->pay=(empty($request->pay))? 0 : $request->pay;
            $data->amount_gross=$total["total"]["total"];
            $data->amount_net=OtherItems::where("invoice_id",$id)->sum("net_total");
            $data->discount= (empty($request->discount))? 0 : $request->discount;
            $data->observations=$request->observations;
            $data->external_reference=$request->external_reference;
            $data->save();
        }
        Cash::create([
            "user_id"=>Auth::id(),
            "title"=>"Documento NO. $data->number",
            "date"=>date("Y-m-d"),
            "amount"=>$total["total"]["total"],
            "status"=>false
        ]);
        $data=OtherItems::where("invoice_id",$id)
        ->selectRaw('SUM(total_tax) as total , tax, product_id')
        ->groupBy('tax')->get();
        foreach ($data as $row) {
            Tax::create([
                'invoice_id'=>$id,
                'percent'=>$row->tax,
                'date'=>date("Y-m-d"),
                'active'=>true,
                'total'=>$row->total,
            ]);
        }
        return response()->json($data);
    }

    public function reportInvoiceRules($id = null,$decimal=false)
    {

        $invoice_id=(empty($_SESSION["invoice_id"])) ? $id : $_SESSION["invoice_id"];
        $invoice=Invoice::find($invoice_id);

        $doc_iva=0;
        $doc_total=0;
        $doc_sub=0;
        $doc_discount1=0;
        $doc_discount0=(empty($invoice->discount)) ? 0 : $invoice->discount;
        
        $item= OtherItems::where("invoice_id",$invoice_id)
        ->get();
        
        foreach ($item as $name) {


            $name->qtd=$name->qty;
            
            $impost=$name->impost*$name->qtd;
            $net_total=$name->net_total;
            $total=( $impost + $name->qtd*$net_total ) - ( $name->discount_for_itens  +  $doc_discount0) ;/*  */
            
            $doc_iva+=$impost;
            $doc_total+=$total;
            $doc_sub+=$net_total*$name->qtd;
            $doc_discount1+=$name->discount_for_itens;


            $name->net_total=number_format($net_total,2);
            $name->impost=number_format($impost,2);
            $name->gross_total=number_format($total,2);
            $name->discount_for_itens=number_format($name->discount_for_itens,2);

            if (empty($invoice->status)) {
                $name->action='
                <div class="table-actions">
                <a href="javascript:void(0)" class="delete-itens" data-url="'.route("invoice.destroy.itens",$name->id).'" style="color:#e95959" ><i class="icon-copy fa fa-trash" aria-hidden="true"></i></a>
                </div>'; 
            }else {
                $name->action=null;
            }
        }
        if (empty($decimal)) {
            $totalData=array(
                "total"=>$doc_total,
                "sub"=>$doc_sub,
                "iva"=>$doc_iva,
                "discount"=>$doc_discount1+$doc_discount0
            );
        }else {
            $totalData=array(
                "total"=>number_format($doc_total,2),
                "sub"=>number_format($doc_sub,2),
                "iva"=>number_format($doc_iva,2),
                "discount"=>number_format($doc_discount0,2)
            );
        }
        return array(
            "data"=>$item,
            "total"=>$totalData,
        );
    }

    
}