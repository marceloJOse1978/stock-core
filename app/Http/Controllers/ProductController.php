<?php

namespace App\Http\Controllers;

use App\Html\ProductHtml;
use App\Models\Brands;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Type;
use App\Models\Unit;
use App\Models\Variant;
use App\Rules\ProductRule;
use App\Rules\StockRule;
use Illuminate\Http\Request;
use App\Core\ConfigCore;
use App\Models\Setting;

class ProductController extends Controller
{
    public $title="Produtos";
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
    public function index( Request $request,ProductHtml $productHtml )
    {
        if( $request->ajax())
            return response()->json(array("data"=>$productHtml->table()));
        return view('index', 
            [
                'page'=>"products",
                'sub_page'=>"index",
                'title'=>$this->title
            ]
        );
        
    }
    public function create()
    {
        $category = Type::where("on",true)->get();
        $variant = Variant::where("active",true)->get();
        $brand = Brands::where("status",true)->get();
        $units = Unit::where("on",true)->get();
        $product_emission=date("Y")."-".Product::where("active",true)->count()+1;

        return view('index', 
            [
                'page'=>"products",
                'sub_page'=>"created",
                'category'=>$category,
                'variant'=>$variant,
                'units'=>$units,
                'reference'=>$product_emission,
                'brand'=>$brand,
                'title'=>$this->title
            ]
        );
    }
    public function show(Request $request){
        $product = Product::find($request->product);
        $product["category_id"] = Type::find($product["category_id"]);
        $product["brand_id"] = Brands::find($product["brand_id"]);
        $product["variant_id"] = Variant::find($product["variant_id"]);
        $saida=0;
        $entrada=0;
        
        $lucro=0;
        $custo=0;

        $row = Stock::where("active",true)
        ->where("product_id",$request->product)
        ->get();

        $total = Stock::where("active",true)
        ->where("product_id",$request->product)
        ->groupBy('move')
        ->selectRaw('SUM(qty) as qtd , document_id,move')
        ->get();


        foreach ($total as $name) {
        if (empty($name->move)) {
            $saida=$name->qtd;
        }else{
            $entrada=$name->qtd;
        }
        }
        

        $custo = (empty($product->supply_price))? 0 : $product->supply_price;
        $lucro = ($product->gross_price * ($saida*(-1)))-$custo*$res=(empty($saida))? 0 : 1;
        return view('index', 
        [
            'page'=>"products",
            'sub_page'=>"profile",
            'row'=>$product,
            'rows'=>$row,
            'index'=>1,
            'title'=>$this->title
        ]
    );
    }

    public function store(Request $request, StockRule $stockRule, ProductRule $productRule)
    {   
        $create = $request->post();
        $request->validate([
            "title"=>"required",
            "tax_id"=>"required",
            "gross_price"=>"required"
        ]);

        $data = Product::create($create);

        $productRule->classe($request,$data);

        $product=Product::findOrFail($data->id);
        if (!empty($request->hasFile("pic_path"))) {
            
            $product->pic_path="$data->id.png";
            $file =$request->file("pic_path");
            $upload= $request->pic_path->storeAs("products","$data->id.png");

        }
        $product->save();

        /* if ($request->stock_type=="A") {
            $stockRule->createRule(0,$data->id,$request->qty);
        } */

        if($request->ajax())
        return response()->json([
            'message'=>'Dados Salvar',
            "clear"=>true
        ]);
    }
    public function edit($product)
    {
        $data= Product::find($product);
        $category = Type::where("on",true)->get();
        $variant = Variant::where("active",true)->get();
        $brand = Brands::where("status",true)->get();
        $units = Unit::where("on",true)->get();
        /* Filtra os dados actual */
        $category_id = Type::find($data->category_id);
        $variant_id = Variant::find($data->variant_id);
        $brand_id = Brands::find($data->brand_id);
        $unit_id = Unit::find($data->unit_id);
        return view('index', 
            [
                'page'=>"products",
                'sub_page'=>"edit",
                'category'=>$category,
                'variant'=>$variant,
                'brand'=>$brand,
                'units'=>$units,
                'category_id'=>$category_id,
                'unit_id'=>$unit_id,
                'variant_id'=>$variant_id,
                'brand_id'=>$brand_id,
                'brand_id'=>$brand_id,
                'row'=>$data,
                'title'=>$this->title
            ]
        );
    }
    public function update(Request $request)
    {
        $data=Product::findOrFail($request->product);
        $data->reference=$request->reference;
        $data->barcode=$request->barcode;
        $data->title=$request->title;
        $data->description=$request->description;
        $data->include_description=$request->include_description;
        $data->supply_price=$request->supply_price;
        $data->gross_price=$request->gross_price;
        $data->class_name=$request->class_name;
        $data->type_id=$request->type_id;
        $data->stock_control=$request->stock_control;
        $data->stock_type=$request->stock_type;
        $data->tax_id=$request->tax_id;
        $data->unit_id=$request->unit_id;
        $data->tax_exemption=$request->tax_exemption;
        $data->tax_exemption_law=$request->tax_exemption_law;
        $data->stock=$request->stock;
        $data->stock_alert=$request->stock_alert;
        $data->variant_id=$request->variant_id;
        $data->category_id=$request->category_id;
        $data->brand_id=$request->brand_id;

        if (!empty($request->hasFile("pic_path"))) {
            $data->pic_path="$data->id.png";
            $file =$request->file("pic_path");
            $upload= $request->pic_path->storeAs("products","$data->id.png");
        }

        $data->save();
        if($request->ajax())
        return response()->json(['message'=>'Dados Editado']);

        return redirect()->back()->with("success","Dados Editar !");
    }
    public function destroy($product, Request $request)
    {
        $up= Product::findOrFail($product);
        $up->status=(empty($up->status)) ? true : false ;
        $up->save();
        if ($request->ajax()) 
        return response()->json(['message'=>'Dados Remividos']);
        return redirect()->back()->with("success","Dados Apagar !");
    }
}
