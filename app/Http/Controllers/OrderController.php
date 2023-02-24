<?php

namespace App\Http\Controllers;

use App\Core\ConfigCore;
use Illuminate\Http\Request;
use App\Models\Setting;

class OrderController extends Controller
{
    public $count = 0;
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
 
    public function increment()
    {
        $this->count++;
    }
 
    public function show($page=null)
    {
        $_SESSION["role"]="admin";
        return view('index', ['page'=>$page,'role'=>$_SESSION["role"]]);
    }
    public function index(Request $request)
    {
        return response()->json($request->all());
    }
}
