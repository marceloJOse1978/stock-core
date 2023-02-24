<?php

namespace App\Html;

use App\Models\Variant;

class VariantHtml 
{
    public function table(){
        $data= Variant::where("active",true)->get();
        foreach ($data as $name) {
            $name->action='
            <div class="table-actions">
                <form action="'.route("variants.destroy",$name->id).'" method="POST">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <a href=" '.route("variants.edit",$name->id).' " style=" color:#265ed7;"><i class="icon-copy fa fa-edit" aria-hidden="true"></i></a>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" style="color:#e95959; border: hidden; background:none;" ><i style="font-size: 20px" class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
                </form>
            </div>'; 
        }
        return $data; 
    }
}