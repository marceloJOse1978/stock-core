<?php

namespace App\Http\Controllers;

use App\Core\ConfigCore;
use App\Html\BrandHtml;
use App\Models\Brands;
use Illuminate\Http\Request;
use App\Models\Setting;

class BrandController extends Controller
{
    public $title="Marca";

    
    public function index( Request $request, Brands $brands,BrandHtml $brandHtml)
    {
        if( $request->ajax()){
            return response()->json(array("data"=>$brandHtml->table()));
        }
        return view('index', 
            [
                'page'=>"brands",
                'sub_page'=>"index",
                'title'=>$this->title
            ]
        );
    }
    public function create(Brands $brands)
    {
        return view("index",
            [
                'page'=>"brands",
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
        $create['status']=true;
        $data=Brands::create($create);
        
        if($request->ajax())
        return response()->json([
            'message'=>'Dados Salvar',
            "clear"=>true
        ]);
    }
    public function edit($brands)
    {
        $data= Brands::find($brands);
        return view('index', 
            [
                'page'=>"brands",
                'sub_page'=>"edit",
                'row'=>$data,
                'title'=>$this->title
            ]
        );
    }
    
    public function update(Request $request)
    {
        $data=Brands::findOrFail($request->brand);
        $data->title=$request->title;
        $data->save();
        
        if($request->ajax())
        return response()->json(['message'=>'Dados Editado']);

        return redirect()->back()->with("success","Dados Editado !");
    }
    public function destroy( $brand , Request $request)
    {
        $up= Brands::findOrFail($brand);
        $up->status=(empty($up->status)) ? true : false ;
        $up->save();
        
        if ($request->ajax()) 
        return response()->json(['message'=>'Dados Remividos']);
        
        return redirect()->back()->with("success","Dados Apagado !");
    }
}
