<?php

namespace App\Http\Controllers;

use App\Core\ConfigCore;
use App\Models\Packge;

class CoreController extends Controller
{
    public $title="Clientes";
    public function __construct(ConfigCore $configCore) {
        
        if (session("days")!="Inativo") {
            # VERIFICAR APERTIR DA API ONLINE
            $configCore->checkdataOn();
    
            # ESTA FUNÇÃO SERVE PARA VERFICAR TENTATIVA DE BURLA
            session(['data_system' => $configCore->checkdataOff()]);
            
            
            session(['days' => $configCore->dashboard()]);
        }

    }
    public function upgrades()
    {
        return view('index', 
            [
                'page'=>"core",
                'sub_page'=>"upgrades",
                'title'=>"Upgrade"
            ]
        );
    }
    public function installUpgrade($install=null)
    {
        # INSTALAR ACTUALIZAÇÃO VIA GET SERA UM ZIP COM TODOS OS DADOS
        dd("installUpgrade");
        return response()->json([
            "message"=>"installUpgrade"
        ]);
    }






    public function pack()
    {
        $row = Packge::all();
        return view('index', 
            [
                'page'=>"core",
                'sub_page'=>"extensions",
                'title'=>"Extensão",
                'collection'=>$row,
            ]
        );
        
    }
    public function installPack($install=null)
    {
        # INSTALAR ACTUALIZAÇÃO VIA GET SERA UM ZIP COM TODOS OS DADOS
        return redirect()->back()->with("success","Instalado Pacote");
    }
}
