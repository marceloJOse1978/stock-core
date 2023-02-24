<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\OtherItems;
use App\Models\Product;
use App\Models\Providers;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Core\ConfigCore;
use App\Models\Setting;

class StockController extends Controller
{
    public $title="Produtos";
    public function __construct(ConfigCore $configCore) {
        if (!empty(Setting::find(1)->id)) {
            # VERIFICAR APERTAR DA API ONLINE
            if($configCore->online()==true)
            $configCore->checkdataOn();
    
            # ESTA FUNÇÃO SERVE PARA VERFICAR TENTATIVA DE BURLA
            session(['data_system' => $configCore->checkdataOff()]);
            
            
            session(['days' => $configCore->dashboard()]);
        }
    }
    public function index()
    {
        $row = Stock::where("active",true)
        ->selectRaw('SUM(qty) as qtd , document_id , product_id, unit, net_total')
        ->groupBy('product_id')
        ->get();
        $product = Product::where("active",true)->get();
        return view('index',[
            'page'=>"stocks",
            'sub_page'=>"index",
            'collection'=>$row,
            'products'=>$product,
            'title'=>$this->title
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client =Providers::where("active","1")->get();
        $product = Product::where("active","1")->get();
        $document_emssion=date("Y")."-".Invoice::count()+1;
        return view('index', 
            [
                'page'=>"stocks",
                'sub_page'=>"created",
                'clients'=>$client,
                'products'=>$product,
                "elements"=>array(
                    "document"=>$document_emssion
                ),
                'title'=>$this->title
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $create = $request->post();
        $request->validate([
            "provider_id"=>"required",
            "product_id"=>"required",
            "qty"=>"required",
            "cost"=>"required",
            "pvp"=>"required"
        ]);
        $create['user_id']=Auth::id();
        $invoice=Invoice::create($create);
        $invoice->stocks()->create($create);
        $create["title"]=Product::find($request->product_id)->title;
        $invoice->other_items()->create($create);
        return redirect()->intended("stocks/$invoice->id/edit")->with("success","Dados Guardados !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show($stock)
    {
        $saida=0;
        $entrada=0;

        $row = Stock::where("active",true)
        ->where("product_id",$stock)
        ->get();

        $total = Stock::where("active",true)
        ->where("product_id",$stock)
        ->groupBy('move')
        ->selectRaw('SUM(qty) as qtd , document_id,move')
        ->get();


        $product=Product::find($stock);


        foreach ($total as $name) {
           if (empty($name->move)) {
            $saida=$name->qtd;
           }else{
            $entrada=$name->qtd;
           }
        }
        

        $in =$entrada+$saida;

        return view('index', 
            [
                'page'=>"stocks",
                'sub_page'=>"profile",
                'rows'=>$row,
                'index'=>1,
                'product'=>$product,
                'entrada'=>$entrada,
                'saida'=>$saida,
                'stock'=>$in,
                'title'=>$this->title
            ]
        );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit($stock)
    {
        $client =Providers::where("active","1")->get();
        $product = Product::where("active","1")->get();
        $stocks = OtherItems::where("invoice_id",$stock)->get();
        $document_emssion=date("Y")."-".Invoice::count()+1;
        $row = Invoice::find($stock);/* 
        return response()->json($row); */
        return view('index', 
            [
                'page'=>"stocks",
                'sub_page'=>"edit",
                'clients'=>$client,
                'invoice'=>$row,
                'stock'=>$stocks,
                'products'=>$product,
                "elements"=>array(
                    "document"=>$document_emssion
                ),
                'title'=>$this->title
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $stock)
    {
        if (isset($request->qty)) {
            $request->validate([
                "product_id"=>"required",
                "qty"=>"required",
                "cost"=>"required",
                "pvp"=>"required"
            ]);
        }
        $data=Invoice::findOrFail($request->stock);
        $data->provider_id=$request->provider_id;
        $data->number=$request->number;
        $data->discount=$request->discount;
        $data->observations=$request->observations;
        $data->external_reference=$request->external_reference;
        if (!empty($request->product_id)) {
            $stock=$data->stocks()->create([
                'product_id'=>$request->product_id,
                'user_id'=>$_SESSION["user_id"],
                'invoice_id'=>$request->stock,
                'qty'=>$request->qty,
                'cost'=>$request->cost,
                'pvp'=>$request->pvp,
                'stockAlert'=>$request->stockAlert,
                'obs'=>$request->obs,
            ]);
            $create["title"]=Product::find($request->product_id)->title;
            $itens=$data->other_items()->create([
                'title'=>Product::find($request->product_id)->title,
                'user_id'=>$_SESSION["user_id"],
                'invoice_id'=>$request->stock,
                'qty'=>$request->qty,
                'cost'=>$request->cost,
                'pvp'=>$request->pvp,
                'stockAlert'=>$request->stockAlert,
                'obs'=>$request->obs,
            ]);
            $data->stocks()->create([
                'product_id'=>$request->product_id,
                'user_id'=>$_SESSION["user_id"],
                'invoice_id'=>$request->stock,
                'other_item_id'=>$itens->id,
                'qty'=>$request->qty,
                'cost'=>$request->cost,
                'pvp'=>$request->pvp,
                'stockAlert'=>$request->stockAlert,
                'obs'=>$request->obs,
            ]);
        }
        $data->save();
        return redirect()->back()->with("success","Dados Editado !");
        //return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy( OtherItems $stock)
    {
        $stock->delete();
        return redirect()->back();
    }
}
