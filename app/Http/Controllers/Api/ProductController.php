<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Product;
use App\Models\Type;
use App\Models\Variant;
use App\Rules\DocumentRule;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( DocumentRule $documentRule)
    {
        $row=cache()->remember("api.page-Product",50,function (){
            return Product::all();
        });
        foreach ($row as $name) {
            $arr["products"][]=array(
                "id"=>$name->id,
                "name"=>$name->title,
                "price"=>$name->gross_price,
                "image"=>url("public/img/47048.jpg"),
                "iva"=>$documentRule->taxes($name->id),
                "options"=>null
            );
        }
        
        return response()->json($arr);
    }
    public function show(Request $request){
        $product = Product::find($request->product);
        $product["category_id"] = Type::find($product["category_id"]);
        $product["brand_id"] = Brands::find($product["brand_id"]);
        $product["variant_id"] = Variant::find($product["variant_id"]);
        return response()->json($product);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
