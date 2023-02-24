<?php

namespace App\Html;

use App\Models\Product;

class ProductHtml 
{
    public function table(){
        $data = Product::where("status",true)->get();
        foreach ($data as $name) {
            if (!empty($name->status)) {
                $name->status='<td><span class="badge badge-primary">Activo</span></td>';
            } else {
                $name->status='<td><span class="badge badge-danger">Desactivo</span></td>';
            }
            $name->supply_price=number_format($name->supply_price,2);
            $name->gross_price=number_format($name->gross_price,2);
            $name->action='
            <div class="table-actions">
                <form action="'.route("products.destroy",$name->id).'" method="POST">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <a href=" '.route("products.edit",$name->id).' " style=" color:#265ed7;"><i class="icon-copy fa fa-edit" aria-hidden="true"></i></a>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" style="color:#e95959; border: hidden; background:none;" ><i style="font-size: 20px" class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
                    <a href=" '.url("products/$name->id").' " style="color:green;" ><i class="icon-copy fa fa-user-circle" aria-hidden="true"></i></a>
                </form>
            </div>'; 
        }
        return $data;
    }
}