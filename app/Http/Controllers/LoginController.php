<?php

namespace App\Http\Controllers;

use App\Core\ConfigCore;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function enter(Request $request, ConfigCore $configCore)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (!empty(Setting::find(1)->id)) {
                if($configCore->online()==true)
                $configCore->init();
                $configCore->setting();
                session(['days' => $configCore->dashboard()]);
                $configCore->checkdataOff();
            
            }else {/* 
                $configCore->setting(); */
                session(['days' => "Inativo"]);
            }
            return response()->json([
                "message"=>"ENTRAR EM SESSÃO",
                "reload"=>true,
                "notify"=>true
            ]);
        }
        return response()->json([
            "message"=>"CREDENCIAS ERRADAS",
            "notify"=>false
        ]);
    }
    public function exit(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect()->intended();
    }
}
