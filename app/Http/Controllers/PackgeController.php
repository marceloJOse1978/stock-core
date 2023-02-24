<?php

namespace App\Http\Controllers;

use App\Models\Packge;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Core\ConfigCore;
use App\Models\Setting;

class PackgeController extends Controller
{
    public $title="Pacote";
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
        $row = Packge::all();
        return view('index', 
            [
                'page'=>"packges",
                'sub_page'=>"index",
                'collection'=>$row,
                
                'title'=>$this->title
            ]
        );
        
    }
    public function create()
    {
        $product=Product::where("stock_type","AP")->get();
        return view('index', 
            [
                'page'=>"packges",
                'sub_page'=>"created",
                'products'=>$product,
                
                'title'=>$this->title
            ]
        );
    }
    public function show(Request $request){
        return view('index', 
        [
            'page'=>"products",
            'sub_page'=>"profile",
            'role'=>$_SESSION["role"],
            'users'=>$_SESSION["role"],
            'title'=>$this->title
        ]
    );
    }
    public function store(Request $request)
    {   
        Packge::create($request->post());
        return redirect()->back()->with("success","Dados Salvo !");
    }
    public function edit($packge)
    {
        return view('index', 
            [
                'page'=>"products",
                'sub_page'=>"edit",
                
                'title'=>$this->title
            ]
        );
    }
   
    public function update(Request $request)
    {
        $data=Packge::findOrFail($request->product);
        $data->reference=$request->reference;
        $data->barcode=$request->barcode;
        $data->title=$request->title;
        $data->save();
        return redirect()->back()->with("success","Dados Editar !");
    }
    public function destroy($packge)
    {
        $up= Packge::findOrFail($packge);
        $up->status=(empty($up->status)) ? true : false ;
        $up->save();
        return redirect()->back()->with("success","Dados Apagar !");
    }
}
