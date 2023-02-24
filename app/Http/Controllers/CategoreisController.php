<?php

namespace App\Http\Controllers;

use App\Core\ConfigCore;
use App\Html\CategoryHtml;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Models\Setting;

class CategoreisController extends Controller
{
    public $title="Categoria";
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
    public function index(Request $request, CategoryHtml $categoryHtml)
    {
        if($request->ajax())
        return response()->json(array("data"=>$categoryHtml->table()));
        return view('index', 
            [
                'page'=>"category",
                'sub_page'=>"index",
                'title'=>$this->title
            ]
        );
    }
    public function create(Type $category)
    {
        return view("index",
            [
                'page'=>"category",
                    'sub_page'=>"created",
                    'title'=>$this->title
            ]
        );
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);
        $create = $request->post();
        $create['on']=true;
        $create['order']=true;
        $create['all_stores']=true;
        $create['products_order']=true;
        $create['kitchen_request']=true;
        $data=Type::create($create);
        if($request->ajax())
        return response()->json([
            'message'=>'Dados Salvar',
            "clear"=>true
        ]);
    }
    public function edit($category)
    {
        $data= Type::find($category);
        return view('index', 
            [
                'page'=>"category",
                'sub_page'=>"edit",
                'row'=>$data,
                'title'=>$this->title
            ]
        );
    }
    
    public function update(Request $request)
    {
        $data=Type::findOrFail($request->category);
        $data->title=$request->title;
        $data->save();

        if($request->ajax())
        return response()->json(['message'=>'Dados Editado']);

        return redirect()->back()->with("success","Dados Editado !");;
    }
    public function destroy($category, Request $request)
    {
        $up= Type::findOrFail($category);
        $up->on=(empty($up->on)) ? true : false ;
        $up->save();
        
        if ($request->ajax()) 
        return response()->json(['message'=>'Dados Remividos']);
        
        return redirect()->back()->with("success","Dados Apagado !");;
    }
}
