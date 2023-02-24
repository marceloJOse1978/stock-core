<?php

namespace App\Html;

use App\Models\Type;

class CategoryHtml 
{
    public function table(){
        $data= Type::all();
        foreach ($data as $name) {
            if (!empty($name->on)) {
                $name->on='<td><span class="badge badge-primary">Activo</span></td>';
            } else {
                $name->on='<td><span class="badge badge-danger">Desactivo</span></td>';
            }
            
            $name->action='
            <div class="table-actions">
                <form action="'.route("category.destroy",$name->id).'" method="POST">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <a href=" '.route("category.edit",$name->id).' " style=" color:#265ed7;"><i class="icon-copy fa fa-edit" aria-hidden="true"></i></a>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" style="color:#e95959; border: hidden; background:none;" ><i style="font-size: 20px" class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
                </form>
            </div>'; 
        }
        return $data;
    }
}