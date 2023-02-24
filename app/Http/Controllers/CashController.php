<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\TimeWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashController extends Controller
{
    public function index()
    {
        $works=TimeWork::orderBy("id","desc")->where("user_id",Auth::id())->first();
        $row=Setting::find(1);
        $name=$row->name_bs;
        if (empty($works->status) && !empty($works->id) )
        return view("cash.index",[
            "name"=>$name,
            "setting"=>$row
        ]);
        return redirect()->back()->with("success","Para Entrar no Caixa Liga o turno !");
    }
}
