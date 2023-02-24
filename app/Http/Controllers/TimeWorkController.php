<?php

namespace App\Http\Controllers;

use App\Models\TimeWork;
use Illuminate\Http\Request;
use App\Core\ConfigCore;
use App\Html\TimeWorkHtml;
use App\Models\Document;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TimeWorkController extends Controller
{
    public $title="Tempo de Trabalho";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function index( Request $request, TimeWorkHtml $timeWorkHtml )
    {
        
        if ($request->ajax())
        return response()->json(array("data"=>$timeWorkHtml->table()));
        
        return view('index', 
            [
                'page'=>"timeworks",
                'sub_page'=>"index",
                'title'=>$this->title
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TimeWork $timeWork,Request $request)
    {
        $works=TimeWork::orderBy("id","desc")->where("user_id",Auth::id())->first();
        if (empty($works->status) && !empty($works->id) ) {
            $data=$timeWork->findOrFail($works->id);
            $data->user_id=Auth::id();
            $data->data_init=$works->data_init;
            $data->data_end=now();
            $data->status=true;
            $data->save();
        }else {
            $timeWork->updateOrCreate([
                'user_id'=>Auth::id(), # --- NIF OU BILHETE DE IDENTIDADE --- #
                'data_init'=>now() ,
                'data_end'=>null  ,
                'status'=>false ,
            ]);
        }

        return redirect()->back()->with("success","Sucesso");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TimeWork  $TimeWork
     * @return \Illuminate\Http\Response
     */
    public function show($timework, Request $request, TimeWorkHtml $timeWorkHtml)
    {
        $data = TimeWork::find($timework);
        $row = User::find($data->user_id);
        

        if ($request->ajax()) 
        return response()->json(array("data"=>$timeWorkHtml->document($timework)));
        
        return view('index', 
            [
                'page'=>"timeworks",
                'sub_page'=>"profile",
                'row'=>$row,
                'id'=>$timework,
                'title'=>$this->title
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TimeWork  $TimeWork
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeWork $TimeWork)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TimeWork  $TimeWork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TimeWork $TimeWork)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimeWork  $TimeWork
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeWork $TimeWork)
    {
        //
    }
}
