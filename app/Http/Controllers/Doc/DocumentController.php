<?php

namespace App\Http\Controllers\Doc;

use App\Core\ConfigCore;
use App\Html\DocumentHtml;
use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\Document;
use App\Models\Item;
use App\Models\Methods;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Tax;
use App\Rules\DocumentRule;
use App\Rules\StockRule;
use Illuminate\Http\Request;
class DocumentController extends Controller
{
    public $title="Documento";
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
       $client = Clients::where("active",true)->get();
       $product = Product::where("status",true)->get();
       $document_emssion=date("Y")."A".Document::where("status",true)->count()+1;
       $method=Methods::where("status",true)->get();
       $id=Document::count()+1;
        return view('index', 
            [
                'page'=>"documents",
                'sub_page'=>"index",
                'clients'=>$client,
                'products'=>$product,
                'methods'=>$method,
                "elements"=>array(
                    "document"=>$document_emssion,
                    "id"=>$id,
                ),
                'title'=>$this->title
            ]
        ); 
    }
    
    public function edit (Document $documents,$document)
    {
        session(["document_id"=>$document]);
        $data=$documents->find($document);
        $client = Clients::where("active",true)->get();
        $product = Product::where("status",true)->get();
        $document_emssion=date("Y")."A".Document::where("status",true)->count()+1;
        $method=Methods::where("status",true)->get(); 
        return view('index', 
             [
                 'page'=>"documents",
                 'sub_page'=>"edit",
                 'clients'=>$client,
                 'products'=>$product,
                 'data'=>$data,
                 'methods'=>$method,
                 "elements"=>array(
                     "document"=>$document_emssion,
                     "id"=>$document,
                 ),
                 'title'=>$this->title
             ]
         ); 
    }

    
    public function destroy(Document $document, Request $request)
    {
        $document->delete();
        if ($request->ajax()) 
        return response()->json(['message'=>'Dados Remividos']);
        
        return redirect()->back()->with("success","Dados Removidos");
    }


    public function destroy_itens(Item $item,$id)
    {
        $item->where("product_id",$id)->delete();
    }

    public function setting($id,DocumentHtml $documentHtml)
    {
        $documentHtml->itensSetting($id);
    }


    public function view($like=null,DocumentHtml $documentHtml)
    {
        $like = (empty($like))? 0 : $like ;
        $documentHtml->searchProducts($like);
    }


    public function register(Request $request, $id=null,DocumentRule $documentRule)
    {
        $documentRule->registerRules($request, $id);
    }


    /* EMISSÃO DE DOCUMENTO */
    public function finalize($id, Request $request, DocumentRule $documentRule,StockRule $stockRule )
    {
        $stockRule->valida($id);
        $documentRule->finalizeRules($id,$request);
        
    }
    public function documents($id,DocumentRule $documentRule,StockRule $stockRule)
    {
        session(["document_id"=>null]);
        $setting=Setting::find(1);
        $document=Document::find($id);
        $type=$document->type;
        $data=$documentRule->reportDocumentRules($id);
        $tax=Tax::where("document_id",$id)->get();
        return view("assets.documents.$type",[
            "document"=>$document,
            "itens"=>$data["data"],
            "total"=>$data["total"],
            "setting"=>$setting,
            "tax"=>$tax,
            "count"=>1
            ]
        );
    } 
    public function created( Request $request )
    {
        $data= Item::where("document_id",session("document_id"))
        ->groupBy('product_id')
        ->get();
        if ($request->ajax()) {

            $doc_iva=0;
            $doc_total=0;
            $doc_sub=0;
            $doc_discount=0;
            
            foreach ($data as $name) {


                $name->qtd=Item::where("document_id",session("document_id"))->where("product_id",$name->product_id)->sum('qty');
                $discount_for_itens=Item::where("document_id",session("document_id"))->where("product_id",$name->product_id)->sum('discount_for_itens');


                $impost=$name->impost*$name->qtd;
                $net_total=$name->net_total;
                $total=($impost+$name->qtd*$name->net_total)-$discount_for_itens;
                
                $doc_iva+=$impost;
                $doc_total+=$total;
                $doc_sub+=$name->qtd*$net_total;
                $doc_discount+=$discount_for_itens;

                $name->net_total=number_format($net_total,2);
                $name->impost=number_format($impost,2);
                $name->gross_total=number_format($total,2);
                $name->discount_for_itens=number_format($discount_for_itens,2);

                if (empty(Document::find(session("document_id"))->status)) {
                    $name->action='
                    <div class="table-actions">
                        <a href="javascript:void(0)" class="delete-itens" data-url="'.route("itens.destroy",$name->product_id).'" style="color:#e95959" ><i class="icon-copy fa fa-trash" aria-hidden="true"></i></a>
                    </div>'; 
                }else {
                    $name->action=null;
                }
            }
        }
        
        return response()->json(
            array(
                "data"=>$data,
                "total"=>array(
                    "total"=>number_format($doc_total,2),
                    "sub"=>number_format($doc_sub,2),
                    "iva"=>number_format($doc_iva,2),
                    "discount"=>number_format($doc_discount,2)
                ),
            )
        );
    }
}
