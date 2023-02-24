<?php

namespace App\Html;

use App\Models\Document;
use App\Models\TimeWork;
use App\Models\User;

class TimeWorkHtml 
{
    public function table(){
        $data= TimeWork::all();
        foreach ($data as $name) {
            $name->user_id = $name->users->name;
            if (!empty($name->status)) {
                $name->status='<td><span class="badge badge-primary">Saída</span></td>';
            } else {
                $name->status='<td><span class="badge badge-danger">Entrada</span></td>';
            }
            
            $name->action='
            <div class="table-actions">
                <a href=" '.route("timeworks.show",$name->id).' " style=" color:#265ed7;"><i class="icon-copy fa fa-user" aria-hidden="true"></i></a>
            </div>'; 
        }
        return $data;
    }
    public function document($timework=null){
        $data = TimeWork::find($timework);
        $document=Document::whereBetween(
            'created_at', 
            [$data->created_at, $data->updated_at]
        )
        ->where("status",true)
        ->get();
        foreach ($document as $name) {
            $name->number = $name->type." ".$name->number;
            $name->client_id = (empty($name->clients->name)) ? "Consumidor Final" : $name->clients->name ;
            if (!empty($name->status)) {
                $name->status='<td><span class="badge badge-primary">Emitido</span></td>';
                $action='
                <div class="table-actions">
                    <a href=" '.route("document.emission",$name->id).' " style=" color:#265ed7;" target="_blank" rel="noopener noreferrer"><i class="icon-copy fa fa-print" aria-hidden="true"></i></a>
                </div>';
            } else {
                $name->status='<td><span class="badge badge-danger">Rascunho</span></td>';
                $action='
                <div class="table-actions">
                    <form action="'.route("documents.destroy",$name->id).'" method="POST">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">
                        <a href=" '.route("documents.edit",$name->id).' " style=" color:#265ed7;"><i class="icon-copy fa fa-edit" aria-hidden="true"></i></a>
                        <button type="submit" style="color:#e95959; border: hidden; background:none;" ><i style="font-size: 20px" class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
                    </form>
                </div>';
            }
            
            $name->action=$action; 
        }
        return $document;
    }
}