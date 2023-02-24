<?php

namespace App\Html;

use App\Models\User;

class UserHtml 
{
    public function table(){
        $data= User::all();
        foreach ($data as $name) {
            if (!empty($name->active)) {
                $name->active='<td><span class="badge badge-primary">Activo</span></td>';
            } else {
                $name->active='<td><span class="badge badge-danger">Desactivo</span></td>';
            }
            $name->action='
            <div class="table-actions">
                <form action="'.route("users.destroy",$name->id).'" method="POST">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                    <a href=" '.route("users.edit",$name->id).' " style=" color:#265ed7;"><i class="icon-copy fa fa-edit" aria-hidden="true"></i></a>
                    <button type="submit" style="color:#e95959; border: hidden; background:none;" ><i style="font-size: 20px" class="icon-copy bi bi-power" aria-hidden="true"></i></button>
                </form>
            </div>'; 
        }
        return $data; 
    }
}