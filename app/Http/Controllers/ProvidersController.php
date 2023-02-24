<?php

namespace App\Http\Controllers;

use App\Html\ProviderHtml;
use App\Models\Providers;
use Illuminate\Http\Request;
use App\Core\ConfigCore;
use App\Models\Setting;

class ProvidersController extends Controller
{
    public $title="Fornecedor";
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
    public function index( Request $request, ProviderHtml $providerHtml )
    {
        if( $request->ajax()){
            return response()->json(array("data"=>$providerHtml->table()));
        }
        return view('index', 
            [
                'page'=>"providers",
                'sub_page'=>"index",
                'title'=>$this->title
            ]
        );
    }public function create()
    {
        return view('index', 
            [
                'page'=>"providers",
                'sub_page'=>"created",
                'title'=>$this->title
            ]
        );
    }
    public function store(Request $request)
    {   
        $create = $request->post();
        $data = Providers::create($create);
        if ($request->ajax()) 
        return response()->json([
            'message'=>'Dados Guardados',
            "clear"=>1
        ]);
        return response()->json($data);
    }
    public function edit($provider)
    {
        $data= Providers::find($provider);
        return view('index', 
            [
                'page'=>"providers",
                'sub_page'=>"edit",
                'row'=>$data,
                'title'=>$this->title
            ]
        );
    }
    public function show($provider)
    {
        $data= Providers::find($provider);
        /* return response()->json($data->invoices()->get()); */
        return view('index', 
            [
                'page'=>"providers",
                'sub_page'=>"profile",
                'row'=>$data,
                'title'=>$this->title
            ]
        );
    }
    public function update(Request $request, Providers $providers)
    {
        $data=$providers->findOrFail($request->provider);
        $data->code=$request->code;
        $data->reference=$request->reference;
        $data->name=$request->name;
        $data->address=$request->address;
        $data->code_postal=$request->code_postal;
        $data->phone=$request->phone;
        $data->mobile=$request->mobile;
        $data->email=$request->email;
        $data->country=$request->country;
        $data->website=$request->website;
        $data->send_mail=$request->send_mail;
        $data->save();
        if ($request->ajax()) 
        return response()->json(['message'=>'Dados Editado']);

        return redirect()->back()->with("success","Dados Editado !");;
    }
    public function destroy($provider,Request $request)
    {
        $up= Providers::findOrFail($provider);
        $up->active=(empty($up->active)) ? true : false ;
        $up->save();
        if ($request->ajax()) 
        return response()->json(['message'=>'Dados Remividos']);
        
        return redirect()->back()->with("success","Dados Apagado !");;
    }
}
