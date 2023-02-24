<?php

namespace App\Http\Controllers;

use App\Html\UnitHtml;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Core\ConfigCore;
use App\Models\Setting;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $title="Unidade";
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
    public function index(Request $request,UnitHtml $unitHtml)
    {
        if($request->ajax())
        return response()->json(array("data"=>$unitHtml->table()));
        return view("index",[
            "page"=>"units",
            "sub_page"=>"index",
            "title"=>$this->title,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("index",[
            "page"=>"units",
            "title"=>$this->title,
            "sub_page"=>"created"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=Unit::create($request->post());
        return response()->json([
            'message'=>'Dados Guardados',
            "clear"=>1
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $units , $unit)
    {
        return view("index",[
            "page"=>"units",
            "title"=>$this->title,
            "row"=>$units->find($unit),
            "sub_page"=>"edit"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $units,$unit,Request $request)
    {
        $data=$units->findOrFail($unit);
        $data->on = (empty($data->on)) ? true : false ;
        $data->save();

        if ($request->ajax()) 
        return response()->json(['message'=>'Dados Remividos']);
        
        return redirect()->back();
    }
}
