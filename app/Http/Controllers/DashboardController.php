<?php

namespace App\Http\Controllers;

use App\Core\ConfigCore;
use App\Models\Clients;
use App\Models\Document;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Stock;
use App\Models\TimeWork;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public $title="Painel Inicial";
   
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
    
    public function show($page="home")
    {
        $row=cache()->remember("homepage-books",10,function (){
            return Clients::where("active",true)->get();
        });
        $client=cache()->remember("homepage-client-count",10,function (){
            return Clients::where("active",true)->count();
        });
        $stock=cache()->remember("homepage-stock-count",10,function (){
            return Stock::where("active",true)->count();
        });
        $product=cache()->remember("homepage-product-count",10,function (){
            return Product::where("active",true)->count();
        });
        $document=cache()->remember("homepage-document-count",10,function (){
            return Document::where("status",true)->count();
        });
        $sale=cache()->remember("homepage-sale-sum",10,function (){
            return number_format(Invoice::where("status",true)->sum("amount_gross"),2,",",".");
        });
        $buy=cache()->remember("homepage-buy-sum",10,function (){
            return number_format(Document::where("status",true)->sum("amount_gross"),2,",",".");
        });

        $timework=TimeWork::where("status",true)
        ->limit(5)
        ->get();
        $works=TimeWork::orderBy("id","desc")
        ->where("user_id",Auth::id())
        ->first();
        if ($works->status==false) {
            $status="ABRIR TURNO";
        }else {
            $status="FECHAR TURNO";
        }

        return view('index', 
            [
                'page'=>null,
                'sub_page'=>$page,
                'client'=>$client,
                'stock'=>$stock,
                'product'=>$product,
                'collection'=>$row,
                'chart'=>$this->charts(),
                'document'=>$document,
                'timework'=>$timework,
                'status'=>$status,
                'sale'=>$sale,
                'buy'=>$buy,
                'title'=>$this->title
            ]
        );
        
    }
    public function charts()
    {
        $chart = Document::where("status",true)
        ->selectRaw('count(*) as total, date')
        ->groupBy('date')
        ->take(15)
        ->get();
        $info=[];
        foreach ($chart as $key) {
            $info["total"][]=$key->total;
            $data=explode("-",$key->date);
            $info["date"][]="'".$data[2]."-".$data[1]."'";
        }
        if (!empty($info)) {
            $charts["total"]= @implode(",",$info["total"]);
            $charts["date"]= @implode(",",$info["date"]);
        }else {
            $charts["total"][]=0;
            $charts["date"][]="'dia 0'";
            $charts["total"]= implode(",",$charts["total"]);
            $charts["date"]= implode(",",$charts["date"]);
            
        }
        return $charts;
    }
    public function pages($painel,$page)
    {
       /*  return view('index', 
            [
                'page'=>$painel,
                'sub_page'=>$page,
                'role'=>$_SESSION["role"],
                'users'=>$_SESSION["role"],
                'title'=>$this->title
            ]
        ); */
       
    }
}
