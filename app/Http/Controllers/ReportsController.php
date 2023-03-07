<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\Clients;
use App\Models\Document;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\Tax;
use Illuminate\Http\Request;
use App\Core\ConfigCore;
use App\Models\Methods;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public $title="Relatório";
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
    public function client($type=null, Request $request)
    {
        $dividas=Document::where(["pay"=>"0"],["status"=>"1"])
        ->count();

        $liquidado=Document::where(["pay"=>"1"],["status"=>"1"])
        ->count();

        $dentro_prazo=Document::where('date_due', '>', date('Y-m-d'))
        ->where("pay",false)
        ->where("status",true)
        ->count();

        $fora_do_prazo=Document::where('date_due', '<', date('Y-m-d'))
        ->where("pay",false)
        ->where("status",true)
        ->count();
        
        $clients = Clients::where("active","1")->get();
        $methods=Methods::where("status",true)->get();


        switch ($type) {
            case '4':
                $row = Document::where(["pay"=>"1"],["status"=>"1"])->get();
            break;
            case '3':
                $row = Document::where('date_due', '>', date('Y-m-d'))
                ->where("pay",false)
                ->where("status",true)
                ->get();
            break;
            case '2':
                $row = Document::where('date_due', '<', date('Y-m-d'))
                ->where("pay",false)
                ->where("status",true)
                ->get();
            break;
            case '1':
                $row = Document::where(["pay"=>"0"],["status"=>"1"])
                ->get();
            break;
            case null:
                $row = Document::where(
                    ["status"=>"1"]
                )->get();
            break;
        }



        return view('index',[
            'page'=>"report",
            'sub_page'=>"client",
            'dividas'=>$dividas,
            'liquidado'=>$liquidado,
            'amount'=>0,
            'dentro_prazo'=>$dentro_prazo,
            'fora_do_prazo'=>$fora_do_prazo,
            'collection'=>$row,
            'methods'=>$methods,
            'clients'=>$clients,
            'title'=>$this->title.""
        ]);



    }
    public function clients(Request $request)
    {
        if ($request->ajax())
        return response()->json(
            [
                "message"=>"A Gerar Relatório !",
                "open"=>url("reports/clients/$request->type")
            ]
        );
    }
    public function cash($date_init=null,$date_end=null)
    {
        $date_init=(empty($date_init))? date("Y-m-d") : $date_init ;
        $date_end=(empty($date_end))? date("Y-m-d") : $date_end ;

        $row=Cash::whereBetween(
            'date', 
            [$date_init, $date_end]
        )
        ->get();

        $entrada=Cash::whereBetween(
            'date', 
            [$date_init, $date_end]
        )
        ->where("status",true)
        ->sum("amount");
        
        $saida=Cash::whereBetween(
            'date', 
            [$date_init, $date_end]
        )
        ->where("status",false)
        ->sum("amount");
        
        $saldo=$entrada-$saida;
        
        return view('index',[
            'page'=>"report",
            'sub_page'=>"cash",
            'collection'=>$row,
            'entrada'=>$entrada,
            'saida'=>$saida,
            'saldo'=>$saldo,
            'title'=>$this->title
        ]);

        
    }
    
    public function months($mes)
    {
         #'Jan','Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out','Dez'
        switch ($mes) {
            case '1':
                return "Jan";
            break;
            case '2':
                return "Fev";
            break;
            case '3':
                return "Mar";
            break;
            case '4':
                return "Abr";
            break;
            case '5':
                return "Mai";
            break;
            case '6':
                return "Jun";
            break;
            case '7':
                return "Jul";
            break;
            case '8':
                return "Ago";
            break;
            case '9':
                return "Set";
            break;
            case '10':
                return "Out";
            break;
            case '11':
                return "Nov";
            break;
            case '12':
                return "Dez";
            break;
        }
    }
    public function products(Request $request, $date_init=null,$date_end=null)
    {
        $row=Document::whereBetween('date', 
        ["$date_init", $date_end])->where(
            ["pay"=>"0"],
            ["status"=>"1"]
        ); 

        if($request->ajax())
        return response()->json([
            "data"=>$row
        ]);

        return view('index',[
            'page'=>"report",
            'sub_page'=>"products",
            'collection'=>$row,
            
            'title'=>$this->title.""
        ]);
    }
    public function category(Request $request, $date_init=null,$date_end=null)
    {
        $row=Document::whereBetween('date', 
        ["$date_init", $date_end])->where(
            ["pay"=>"0"],
            ["status"=>"1"]
        );

        if($request->ajax())
        return response()->json([
            "data"=>$row
        ]); 

        return view('index',[
            'page'=>"report",
            'sub_page'=>"category",
            'collection'=>$row,
            
            'title'=>$this->title.""
        ]);
    }
    public function brands(Request $request, $date_init=null,$date_end=null)
    {
        $row=Document::whereBetween('date', 
        ["$date_init", $date_end])->where(
            ["pay"=>"0"],
            ["status"=>"1"]
        ); 


        if($request->ajax())
        return response()->json([
            "data"=>$row
        ]);


        return view('index',[
            'page'=>"report",
            'sub_page'=>"brands",
            'collection'=>$row,
            
            'title'=>$this->title.""
        ]);
    }
    public function maps_tax( Request $request, $date_init=null,$date_end=null)
    {
        
        $row=Tax::whereBetween('date', 
        [
            date("Y-m-d",strtotime("$date_init-$date_end-1")),
            date("Y-m-t",strtotime("$date_init-$date_end-1"))
        ])->get();
        $total=Tax::whereBetween('date', 
        [
            date("Y-m-d",strtotime("$date_init-$date_end-1")),
            date("Y-m-t",strtotime("$date_init-$date_end-1"))
        ])->sum("total");

        if($request->ajax())
        return response()->json([
            "data"=>$row
        ]);

        return view('index',[
            'page'=>"report",
            'sub_page'=>"maps_tax",
            'collection'=>$row,
            'total'=>$total,
            
            'title'=>$this->title
        ]);
    }
    public function maps_tax_providers(Request $request, $date_init=null,$date_end=null)
    {
        $row=Tax::whereBetween('date', 
        [
            date("Y-m-d",strtotime("$date_init-$date_end-1")),
            date("Y-m-t",strtotime("$date_init-$date_end-1"))
        ])->get();

        $total=Tax::where("document_id","=",null)->whereBetween('date', 
        [
            date("Y-m-d",strtotime("$date_init-$date_end-1")),
            date("Y-m-t",strtotime("$date_init-$date_end-1"))
        ])->sum("total");

        if($request->ajax())
        return response()->json([
            "data"=>$row
        ]);

        return view('index',[
            'page'=>"report",
            'sub_page'=>"maps_tax_providers",
            'collection'=>$row,
            'total'=>$total,
            
            'title'=>$this->title.""
        ]);
    }
    public function variants(Request $request, $date_init=null,$date_end=null)
    {
        $row=Document::whereBetween('date', 
        ["$date_init", $date_end])->where(
            ["pay"=>"0"],
            ["status"=>"1"]
        );

        if($request->ajax())
        return response()->json([
            "data"=>$row
        ]);

        return view('index',[
            'page'=>"report",
            'sub_page'=>"variants",
            'collection'=>$row,
            
            'title'=>$this->title.""
        ]);
    }
    public function providers(Request $request, $date_init=null,$date_end=null)
    {
        $row=Document::whereBetween('date', 
        ["$date_init", $date_end])->where(
            ["pay"=>"0"],
            ["status"=>"1"]
        ); 

        if($request->ajax())
        return response()->json([
            "data"=>$row
        ]);

        return view('index',[
            'page'=>"report",
            'sub_page'=>"providers",
            'collection'=>$row,
            
            'title'=>$this->title.""
        ]);
    }
    public function users(Request $request, $date_init=null,$date_end=null)
    {
        $row=Document::whereBetween('date', 
        ["$date_init", $date_end])->where(
            ["pay"=>"0"],
            ["status"=>"1"]
        ); 

        if($request->ajax())
        return response()->json([
            "data"=>$row
        ]);

        return view('index',[
            'page'=>"report",
            'sub_page'=>"user",
            'collection'=>$row,
            
            'title'=>$this->title.""
        ]);
    }
    public function core(Request $request,$parament = null)
    {
        if ($request->ajax())
        return response()->json(
            [
                "message"=>"A Gerar Relatório !",
                "open"=>url("reports/$parament/$request->date_init/$request->date_end")
            ]
        );
        return redirect()->intended("reports/$parament/$request->date_init/$request->date_end");
    }
}
