<?php

namespace App\Http\Controllers;

use App\Core\ConfigCore;
use App\Html\ClientHtml;
use Illuminate\Http\Request;
use App\Models\Clients;
use App\Models\Setting;

class ClientController extends Controller
{
    public $title="Clientes";
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
    public function index(Request $request, ClientHtml $clientHtml)
    {
        if( $request->ajax()){
            return response()->json(array("data"=>$clientHtml->table()));
        }
        return view('index', 
            [
                'page'=>"clients",
                'sub_page'=>"index",
                'title'=>$this->title
            ]
        );
    }
    public function create()
    {
        return view('index', 
            [
                'page'=>"clients",
                'sub_page'=>"created",
                'title'=>$this->title
            ]
        );
    }
    public function store(Request $request)
    {   
        $create = $request->post();
        $data=Clients::create($create);
       
        if ($request->ajax()) 
        return response()->json([
            'message'=>'Dados Guardados',
            "clear"=>1
        ]);

        return redirect()->intended('clients/create')->with("success","Dados Guardados !");
    }
    public function edit($client)
    {
        $data= Clients::find($client);
        return view('index', 
            [
                'page'=>"clients",
                'sub_page'=>"edit",
                'row'=>$data,
                'title'=>$this->title
            ]
        );
    }
    public function show($client)
    {
        $data= Clients::find($client);
        return view('index', 
            [
                'page'=>"clients",
                'sub_page'=>"profile",
                'row'=>$data,
                'title'=>$this->title
            ]
        );
    }
    public function update(Request $request, Clients $clients)
    {
        $data=$clients->findOrFail($request->client);
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

        return redirect()->back()->with("success","Dados Editado !");
    }
    public function destroy($client, Request $request)
    {
        $up = Clients::findOrFail($client);
        $up->active=(empty($up->active)) ? true : false ;
        $up->save();
        if ($request->ajax()) 
        return response()->json(['message'=>'Dados Remividos']);

        return redirect()->back()->with("success","Dados Apagado !");
    }
}
