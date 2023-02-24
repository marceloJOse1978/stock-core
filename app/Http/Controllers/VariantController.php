<?php

namespace App\Http\Controllers;

use App\Html\VariantHtml;
use App\Models\Variant;
use Illuminate\Http\Request;
use App\Core\ConfigCore;
use App\Models\Setting;

class VariantController extends Controller
{
    
    public $title="Variação";
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
    public function index(Request $request, VariantHtml $variantHtml)
    {
        
        if( $request->ajax()){
            return response()->json(array("data"=>$variantHtml->table()));
        }
        return view('index', 
            [
                'page'=>"variants",
                'sub_page'=>"index",
                'title'=>$this->title
            ]
        );
    }
    public function create()
    {
        return view("index",
            [
                'page'=>"variants",
                    'sub_page'=>"created",
                    'role'=>$_SESSION["role"],
                    'title'=>$this->title
            ]
        );
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);
        $create = $request->post();
        $create['code']=true;
        Variant::create($create);
        
        if ($request->ajax()) 
        return response()->json([
            'message'=>'Dados Guardados',
            "clear"=>1
        ]);

        return redirect()->intended('variants/create')->with("success","Dados Salvo!");
    }
    public function edit($variants)
    {
        $data= Variant::find($variants);
        return view('index', 
            [
                'page'=>"variants",
                'sub_page'=>"edit",
                'row'=>$data,
                'title'=>$this->title
            ]
        );
    }
    
    public function update(Request $request)
    {
        $data=Variant::findOrFail($request->variant);
        $data->title=$request->title;
        $data->save();
        if ($request->ajax()) 
        return response()->json(['message'=>'Dados Editado']);

        return redirect()->intended("variants");
    }
    public function destroy($variants, Request $request)
    {
        $up = Variant::findOrFail($variants);
        $up->active=(empty($up->active)) ? true : false ;
        $up->save();
        if ($request->ajax()) 
        return response()->json(['message'=>'Dados Remividos']);

        return redirect()->back()->with("success","Dados Apagado !");
    }

}
