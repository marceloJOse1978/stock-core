<?php

namespace App\Rules;

use App\Models\Cash;
use App\Models\Document;
use App\Models\Item;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Tax;
use Illuminate\Support\Facades\Auth;

class DocumentRule 
{
    public function totalRules($request,$id=null)
    {
        $sql["net_total"]=(empty($request->gross_total)) ? Product::find( (empty($request->product_id)) ? $id : $request->product_id)->gross_price : $request->gross_total ;
        $sql["gross_total"] = (empty($request->gross_total)) ? Product::find((empty($request->product_id)) ? $id : $request->product_id)->gross_price * $request->qty : $request->gross_total * $request->qty;
        return $sql;
    }
    public function taxes($id = null)
    {
        $data= Product::find($id);
        $amount= $data->gross_price*$data->tax_id/100;
        return $amount;
    }
    public function registerRules($request, $id=null)
    {
        if (empty(session("document_id"))) {
            $document=Document::create([
                'client_id'=>$request->client_id,
                'user_id'=>Auth::id(),
                'type'=>$request->type,
                'number'=>$request->number,
                'date'=>$request->date,
                'status'=>0,
                'pay'=>(empty($request->pay)) ? false : $request->pay,
                'amount_gross'=>(empty($request->amount_gross)) ? 0 : $request->amount_gross,
                'amount_net'=>(empty($request->amount_net)) ? 0 : $request->amount_net,
                'date_due'=>( empty($request->date_due) ) ? date('Y-m-d', strtotime('+15 days')) : $request->date_due,
                'discount'=>($request->discount==null) ? 0 : $request->discount,
                'observations'=>$request->observations,
                'external_reference'=>$request->external_reference,
            ]);
            $qty=(empty($request->qty)) ? 1 : $request->qty;
            $product=Product::find($id);
            $document->items()->create(
                [
                    'product_id' => $id,
                    'qty' => $qty,
                    'unit'=>$product->units->title,
                    'tax'=>$product->tax_id,
                    'total_tax'=>$this->taxes($id)*$qty,
                    'title'=>$product->title,
                    'impost'=>$this->taxes($id),
                    'discount_for_itens'=>(empty($request->discount_for_itens)) ? 0 : $request->discount_for_itens,
                    'net_total'=> $this->totalRules($request,$id)["net_total"],
                    'gross_total'=> $this->totalRules($request,$id)["gross_total"], 
                ]
            );
            session(["document_id"=>$document->id]);
        } 
        else {
            $qty=(empty($request->qty)) ? 1 : $request->qty;
            if (empty(Document::find(session("document_id"))->status)) {
                $product=Product::find($id);
                $document=Item::create([
                    'document_id' => session("document_id"),
                    'product_id' => $id,
                    'qty' => $qty,
                    'unit'=>$product->units->title,
                    'tax'=>$product->tax_id,
                    'total_tax'=>$this->taxes($id)*$qty,
                    'title'=>$product->title,
                    'impost'=>$this->taxes($id),
                    'discount_for_itens'=>(empty($request->discount_for_itens)) ? 0 : $request->discount_for_itens,
                    'net_total'=> $this->totalRules($request,$id)["net_total"],
                    'gross_total'=> $this->totalRules($request,$id)["gross_total"],  
                ]);
            }
        }
        return response()->json(
            $document
        );
    }

    public function reportDocumentRules($id = null,)
    {
        $doc_iva=0;
        $doc_total=0;
        $doc_sub=0;
        $id=(empty(session("document_id"))) ? $id : session("document_id");
        $documents=Document::find($id);
        
        $doc_discount1=0;
        $doc_discount0=(empty($documents->discount)) ? 0 : $documents->discount;
        
        $item= Item::where("document_id", $id)
        ->groupBy('product_id')
        ->get();
        
        foreach ($item as $name) {


            $name->qtd=Item::where("document_id",$id)->where("product_id",$name->product_id)->sum('qty');
            $discount_for_itens=Item::where("document_id",$id)->where("product_id",$name->product_id)->sum('discount_for_itens');
            $impost=$name->impost*$name->qtd;
            $net_total=$name->net_total;
            $total=($impost+$net_total*$name->qtd)-($discount_for_itens);
            
            $doc_iva+=$impost;
            $doc_total+=$total;
            $doc_sub+=$name->qtd*$net_total;
            $doc_discount1+=$discount_for_itens;
            
            $name->net_total=number_format($net_total,2);
            $name->impost=number_format($impost,2);
            $name->gross_total=number_format($total,2);
            $name->discount_for_itens=number_format($discount_for_itens,2);
            
            
            if (empty($documents->status)) {
                $name->action='
                <div class="table-actions">
                <a href="javascript:void(0)" class="delete-itens" data-url="'.route("itens.destroy",$name->product_id).'" style="color:#e95959" ><i class="icon-copy fa fa-trash" aria-hidden="true"></i></a>
                </div>'; 
            }else {
                $name->action=null;
            }
        }
        return $data= array(
            "data"=>$item,
            "total"=>array(
                "total"=>$doc_total-($doc_discount1+$doc_discount0),
                "sub"=>$doc_sub,
                "iva"=>$doc_iva,
                "discount"=>$doc_discount1+$doc_discount0
            ),
        );
    }

    public function finalizeRules($id=null,$request){
        $id=(!empty($id)) ? $id : session("document_id"); 
        $data=Document::findOrFail($id);
        $total= $this->reportDocumentRules($id);
        if (empty($data->status)) {
            $data->client_id=$request->client_id;
            $data->user_id=Auth::id();
            $data->type=$request->type;
            $data->number=$request->number;
            $data->date=$request->date;
            $data->status=1;
            $data->amount_gross=$total["total"]["total"];
            $data->amount_net=Item::where("document_id",$id)->sum("net_total");
            $data->pay=(empty($request->pay)) ? false : $request->pay;
            $data->discount= ($request->discount==null) ? 0 : $request->discount;
            $data->observations=$request->observations;
            $data->external_reference=$request->external_reference;
            $data->save();
            if (!empty($data->pay)) {
                $this->createRule($id,$request->method_id);
                Cash::create([
                    "user_id"=>Auth::id(),
                    "title"=>"Documento NO.$request->type $data->number",
                    "date"=>date("Y-m-d"),
                    "amount"=>$total["total"]["total"],
                    "status"=>(!empty($data->pay))? true: false
                ]);
            }
            $data=Item::where("document_id",$id)
            ->selectRaw('SUM(total_tax) as total , tax, product_id')
            ->groupBy('tax')->get();
            foreach ($data as $row) {
                Tax::create([
                    'document_id'=>$id,
                    'percent'=>$row->tax,
                    'date'=>date("Y-m-d"),
                    'active'=>true,
                    'total'=>$row->total,
                ]);
            }
        }
        return response()->json($data);
    }
    public function cashRule($item,$document)
    {
        foreach ($item as $name) {
            /* 
             depois de criar um
             items vai remover do stock 
             se tive no estoque 
            */ 
            $product= Product::find($name["productId"]);
            Item::create([
                'document_id'=>$document->id,
                'product_id'=>$name["productId"],
                'qty'=>$name["qty"],
                'unit'=>$product->units->title,
                'tax'=>$product->tax_id,
                'total_tax'=>$this->taxes($name["productId"])*$name["qty"],
                'title'=>$product->title,
                'impost'=>$this->taxes($name["productId"]),
                'discount_for_itens'=>"0",
                'reference'=>"Point buy",
                'net_total'=>$product->gross_price,
                'gross_total'=>$product->gross_price*$name["qty"],
            ]);
        }
        $data=Document::findOrFail($document->id);
        $total= $this->reportDocumentRules($document->id);
        $data->amount_gross=$total["total"]["total"];
        $data->amount_net=Item::where("document_id",$document->id)->sum("net_total");
        $data->save();

        
        
        Cash::create([
            "user_id"=>$data->user_id,
            "title"=>"Documento NO. $data->number",
            "date"=>date("Y-m-d"),
            "amount"=>$total["total"]["total"],
            "status"=>true
        ]);
        $data=Item::where("document_id",$document->id)
        ->selectRaw('SUM(total_tax) as total , tax, product_id')
        ->groupBy('tax')->get();
        foreach ($data as $row) {
            Tax::create([
                'document_id'=>$document->id,
                'percent'=>$row->tax,
                'date'=>date("Y-m-d"),
                'active'=>true,
                'total'=>$row->total,
            ]);
        }
        
       $this->createRule($document->id);
    }
    public function createRule($id = null,$method_id=1)
    {
        $data=Payment::create([
            'document_id'=>$id,
            'method_id'=>$method_id,
            'title'=>"Pago",
            'amount'=>Document::find($id)->amount_gross
        ]);
    }
    public function discount($value = null,$total=null)
    {
        $discount  = $value;
        $data = explode("%", $discount);
        if (count($data)==2) {
            $amount= $total-($total*$data[0]/100);
            return $amount;
        }else{
            $data=$total-($discount);
            return $data;
        }
    }
}