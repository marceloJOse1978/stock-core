<?php

namespace App\Http\Controllers;

use App\Core\ConfigCore;
use App\Import\ClientImport;
use App\Import\ProductImport;
use App\Import\ProviderImport;
use Illuminate\Http\Request;
use App\Models\Setting;

class ImportController extends Controller
{
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
    public function clients()
    {
        return view('index', 
            [
                'page'=>"imposts",
                'sub_page'=>"client",
                'title'=>"Importar Cliente"
            ]
        );
    }
    public function client(Request $request, ClientImport $clientImport)
    {
        $data="client".time().".xlsx";
        if (!empty($request->hasFile("file_path"))) {
            $file =$request->file("file_path");
            $upload= $request->file_path->storeAs("excel/clients",$data);
        }
        if($request->ajax())
        return response()->json([
            'message'=>'Dados Salvar',
            'clear'=>1,
        ]);
        return redirect()->back()->with("success",$clientImport->save($data));
    }
    public function providers()
    {
        return view('index', 
            [
                'page'=>"imposts",
                'sub_page'=>"provider",
                'title'=>"Importar Fornecedores"
            ]
        );
    }
    public function provider(Request $request, ProviderImport $providerImport)
    {
        $data="provider".time().".xlsx";
        if (!empty($request->hasFile("file_path"))) {
            $file =$request->file("file_path");
            $upload= $request->file_path->storeAs("excel/providers",$data);
        }

        if($request->ajax())
        return response()->json([
            'message'=>'Dados Salvar',
            'clear'=>1,
        ]);

        return redirect()->back()->with("success",$providerImport->save($data));
    }
    public function products()
    {
        return view('index', 
            [
                'page'=>"imposts",
                'sub_page'=>"product",
                'title'=>"Importar Produtos"
            ]
        );
    }
    public function product(Request $request, ProductImport $productImport)
    {
        $data="product".time().".xlsx";
        if (!empty($request->hasFile("file_path"))) {
            $file =$request->file("file_path");
            $upload= $request->file_path->storeAs("excel/products",$data);
        }
        if($request->ajax())
        return response()->json([
            'message'=>'Dados Salvar',
            'clear'=>1,
        ]);
        return redirect()->back()->with("success",$productImport->save($data));
    }
}
