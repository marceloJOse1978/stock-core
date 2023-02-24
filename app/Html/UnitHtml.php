<?php

namespace App\Html;

use App\Models\Unit;

class UnitHtml 
{
    public function table(){
        $data= Unit::all();
        foreach ($data as $name) {
            if (!empty($name->on)) {
                $name->on='<td><span class="badge badge-primary">Activo</span></td>';
            } else {
                $name->on='<td><span class="badge badge-danger">Desactivo</span></td>';
            }
            $name->action='
            <div class="table-actions">
                <form action="'.route("units.destroy",$name->id).'" method="POST">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" style="color:#e95959; border: hidden; background:none;" ><i style="font-size: 20px" class="icon-copy bi bi-power" aria-hidden="true"></i></button>
                </form>
            </div>'; 
        }
        return $data; 
    }
}