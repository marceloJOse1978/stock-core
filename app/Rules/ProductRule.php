<?php

namespace App\Rules;

use App\Models\Product;

class ProductRule 
{
    public function classe($request,$data){
        
        if ($request->brand_id=="") {
            $request->validate([
                "title_brand"=>"required"
            ]);
            $product=Product::findOrFail($data->id);
            $d=$product->brands()->create(["title"=>$request->title_brand]);
            $product->brand_id=$d->id;
            $product->save();
        }
        if ($request->variant_id=="") {
            $request->validate([
                "title_variant"=>"required"
            ]);
            $product=Product::findOrFail($data->id);
            $d=$product->variants()->create([
                "title"=>$request->title_variant,
                "code"=>"AO12345"
            ]);
            $product->variant_id=$d->id;
            $product->save();
        }
        if ($request->category_id=="") {
            $request->validate([
                "title_category"=>"required"
            ]);
            $product=Product::findOrFail($data->id);
            $d=$product->category()->create([
                "title"=>$request->title_category,
                "on"=>1,
            ]);
            $product->category_id=$d->id;
            $product->save();
        }
    }
}