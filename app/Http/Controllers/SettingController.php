<?php

namespace App\Http\Controllers;

use App\Core\ConfigCore;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public $title="Configuração";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 

    public function index()
    {
        $data= Setting::find(1);
        $user = User::all();

        /* return response()->json($data->invoices()->get()); */
        return view('index', 
            [
                'page'=>"settings",
                'sub_page'=>"index",
                'row'=>$data,
                'user'=>$user,
                'title'=>$this->title
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $setting= Setting::findOrFail(1);
        $setting->name_bs=($request->name_bs=="") ? $setting->name_bs : $request->name_bs ;
        $setting->phone_bs=($request->phone_bs=="") ? $setting->phone_bs : $request->phone_bs ;
        $setting->address_bs=($request->address_bs=="") ? $setting->address_bs : $request->address_bs ;
        $setting->address_bs=($request->email_bs=="") ? $setting->email_bs : $request->email_bs ;
        $setting->text=$request->text;
        $setting->pic_path="$setting->id.png";
        if (!empty($request->hasFile("pic_path"))) {
            $file =$request->file("pic_path");
            $upload= $request->pic_path->storeAs("logo-img","$setting->id.png");
        }
        $setting->save();
        if($request->ajax())
        return response()->json([
            'message'=>'Dados Salvar',
            "reload"=>true
        ]);
        return redirect()->back();
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
   
     public function register( Request $request, User $user )
     {
        $data = $user
        ->updateOrCreate($request->post());
        return redirect()->back();/* 
        return response()->json($data); */
     }

    public function core(Request $request,ConfigCore $configCore)
    { 
        $setting = Setting::create($request->post());
        
        $configCore->setting();
        
        if($configCore->online()==true)
        $configCore->init();
        
        session(['days' => $configCore->dashboard()]);
        
        return response()->json([
            'message'=>'Empresa Criada',
            'reload'=>true
        ]);
    }
    public function payments(){
        return view('index', 
            [
                'page'=>"settings",
                'sub_page'=>"payments",
                'title'=>"PACOTE SETMARK"
            ]
        );
    }

    public function buy($id=null){
        return view('index', 
            [
                'page'=>"settings",
                'sub_page'=>"buy",
                'id'=>$id,
                'title'=>"Pagamento"
            ]
        );
    }

    public function checked(){
        return view('index',[
            'page'=>"settings",
            'sub_page'=>"checked",
            'title'=>"Activa Serial"
        ]);
    }

    public function send( Request $request, $id=null,ConfigCore $configCore){
        $data=$configCore->payments($id);
        $configCore->init();
        if ($request->ajax())
        return response()->json([
            'message'=>$data["msg"],
            'clear'=>true
        ]);
    }
    public function serial( Request $request, $id=null,ConfigCore $configCore){
        $data=$configCore->checkedSerial($request->serial);
        $configCore->init();
        $sms = (empty($data)) ? "Licença Negada !" : "Licença de  $data Dias!"  ;
        $_SESSION["days"]=$configCore->dashboard();
        if ($request->ajax())
        return response()->json([
            'message'=>$sms,
            'clear'=>true
        ]);
    }
}
