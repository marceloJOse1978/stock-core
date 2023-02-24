<?php

namespace App\Http\Controllers;

use App\Core\ConfigCore;
use App\Html\InvoiceHtml;
use App\Models\Invoice;
use App\Models\OtherItems;
use App\Models\Product;
use App\Models\Providers;
use App\Rules\InvoiceRule;
use App\Rules\StockRule;
use Illuminate\Http\Request;
use App\Models\Setting;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $title="Factura de Entrada";
    
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

    public function index(Request $request,InvoiceHtml $documentHtml)
    {
        if ($request->ajax())
        return response()->json(array("data"=>$documentHtml->table("FT")));

        return view('index', 
            [
                'page'=>"invoices",
                'sub_page'=>"index",
                'title'=>$this->title
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = Providers::where("active",true)->get();
        $product = Product::where("status",true)->get();
        $id="1";
        $document_emssion="FR NUMBER";
            return view('index', 
                [
                    'page'=>"invoices",
                    'sub_page'=>"created",
                    'clients'=>$client,
                    'products'=>$product,
                    "elements"=>array(
                        "document"=>$document_emssion,
                        "id"=>$id,
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
    public function store(Request $request,InvoiceRule $invoiceRule,StockRule $stockRule)
    {
        $stockRule->valida_invoices($_SESSION["invoice_id"]);
        $invoiceRule->finalizeRules($_SESSION["invoice_id"],$request);
        $_SESSION["invoice_id"]=null;
        return response()->json([
            "message"=>"Documento criado",
            "reload"=>true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($invoice)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit($invoice)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $invoice)
    {
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice, Request $request)
    {
        $invoice->delete();
        if ($request->ajax()) 
        return response()->json(['message'=>'Dados Remividos']);

        return redirect()->back()->with("success","Dados Apagar !");
    }
    
    public function items($search=null,InvoiceHtml $invoiceHtml)
    { 
        $invoiceHtml->searchProducts($search);
    }
    public function created(Request $request, InvoiceRule $invoiceRule,$id=null)
    {
       $data = $invoiceRule->registerRules($request,$id);
       return response()->json($data);
    }
    public function table(InvoiceRule $invoiceRule)
    {
       return response()->json($invoiceRule->reportInvoiceRules(null,true));
    }
    public function stocks( $id=null,InvoiceHtml $invoiceHtml )
    {
        $invoiceHtml->itensSetting($id);
    }
    public function destroy_itens($id = null)
    {
        OtherItems::where("id",$id)->delete();
    }
}
