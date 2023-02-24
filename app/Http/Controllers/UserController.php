<?php

namespace App\Http\Controllers;

use App\Html\UserHtml;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Core\ConfigCore;
use App\Models\Setting;

class UserController extends Controller
{
    public $title="Usuário";
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
    public function index( Request $request, UserHtml $userHtml )
    {
        if($request->ajax())
        return response()->json(array("data"=>$userHtml->table()));

        return view('index', 
            [
                'page'=>"users",
                'sub_page'=>"index",
                'title'=>$this->title
            ]
        );
        
    }
    public function profile()
    {
        $row = User::find(Auth::id());
        return view('index', 
            [
                'page'=>"users",
                'sub_page'=>"profile",
                'row'=>$row,
                'title'=>$this->title
            ]
        );
    }
    public function create()
    {
        return view('index', 
            [
                'page'=>"users",
                'sub_page'=>"created",
                'title'=>$this->title
            ]
        );
    }
    public function store(Request $request)
    {   
        $create = $request->post();
        $data=User::create($create);
        $user=User::findOrFail($data->id);
        if (!empty($request->hasFile("pic_path"))) {
            
            $user->pic_path="$data->id.png";
            $file =$request->file("pic_path");
            $upload= $request->pic_path->storeAs("user","$data->id.png");

        }
        $user->save();

        if($request->ajax())
        return response()->json([
            'message'=>'Dados Salvar',
            "clear"=>true
        ]);
        return redirect()->back()->with("success","Dados Guardados !");;
    }
    public function edit($user)
    {
        $data= User::find($user);
        
        return view('index', 
            [
                'page'=>"users",
                'sub_page'=>"edit",
                'row'=>$data,
                'title'=>$this->title
            ]
        );
    }
    public function show($client)
    {
        $data= User::find($client);
        return view('index', 
            [
                'page'=>"users",
                'sub_page'=>"profile",
                'row'=>$data,
                'title'=>$this->title
            ]
        );
    }
    public function editProfile(Request $request, $user )
    {
        $data = User::findOrFail(Auth::id());
        if ($user=="update") {
            $data->name=$request->name;
            $data->email=$request->email;
            $data->phone=$request->phone;
            $data->save();
            if($request->ajax())
            return response()->json([
                'message'=>'Dados Editado',
                'reload'=>true
            ]);
            return redirect()->back()->with("success","Dados Editado !");
        }else{
            if (!empty(User::where("password",bcrypt($request->actual))->where("id",Auth::id())->get())) {
                $data->password=$request->nova;
                $data->save();
                if($request->ajax())
                return response()->json([
                    'message'=>'Senha Editado',
                ]);
                return redirect()->back()->with("success","Senha Editado !");
            }else {
                if($request->ajax())
                return response()->json([
                    'message'=>'Senha actual Errada !',
                ]);
                return redirect()->back()->with("error","Senha actual Errada !");
            }
        }
        return redirect()->back();
    }
    public function update(Request $request, $user )
    {
        $data = User::findOrFail($user);
        $data->name=$request->name;
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->role=$request->role;
        if (!empty($request->hasFile("pic_path"))) {
            
            $data->pic_path="$data->id.png";
            $file =$request->file("pic_path");
            $upload= $request->pic_path->storeAs("user","$data->id.png");

        }
        $data->save();
        if($request->ajax())
        return response()->json([
            'message'=>'Dados Editado'
        ]);
        return redirect()->back();
    }
    public function destroy($user, Request $request)
    {
        $data=User::findOrFail($user);
        $data->active = (empty($data->active)) ? true : false ;
        $data->save();

        if ($request->ajax()) 
        return response()->json(['message'=>(!empty($data->active)) ? "Ativar Usuário" : "Desativar Usuário"]);

        return redirect()->intended('users')->with("success","Dados Apagado !");;
    }
}
