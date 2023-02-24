<?php

namespace App\Html;

use App\Models\Document;
use App\Models\Item;
use App\Models\Product;
use App\Models\Stock;

class DocumentHtml 
{
    public function table($type=null){
        if (empty($type)) {
            $data= Document::all();
        }else{
            $data= Document::where("type",$type)->get();
        }
        foreach ($data as $name) {
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
        return $data;
    }
    public function itensSetting($id)
    {
        $data=Stock::where("active",true)->where("product_id",$id)->sum("qty");
        $qtd=Item::where("document_id",session("document_id"))->where("product_id",$id)->sum("qty");
        $stock = (Product::find($id)->stock_type=="A") ? $data-$qtd : "Sem Sock" ;
        $html='
        <input type="hidden" id="product_id" name="product_id" value="'.$id.'">
        <input type="hidden" id="stock" name="stock" value="'.$stock.'">
        
        <div class="col-md-12 col-sm-12">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>QTD</label>
                        <input type="number"  required min="1" max="'.$stock.'" name="qty" id="qty" value="1" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Desconto</label>
                        <input type="text" name="discount_for_itens" id="discount_for_itens" class="form-control">
                    </div>
                </div>
            </div>
        </div>';
        echo $html;
    }
    public function searchProducts($search = null)
    {
        /* esta rota não e definitiva */
        if (empty($search)) {
            $data=Product::where("status","1")->get();
        } else {
            $data=Product::where("status","1")->where('title', 'like', $search.'%')->get();
        }
        $html=null;
        foreach ($data as $key) {
            $data=Stock::where("active",true)->where("product_id",$key->id)->sum("qty");
            $qtd=Item::where("document_id",session("document_id"))->where("product_id",$key->id)->sum("qty");
            $stock = ($key->stock_type=="A") ? $data-$qtd : "Sem Sock" ;
            $item=($stock>0 || $key->stock_type!="A")?'
            <div class="btn-list">
                <a href="#" data-id="'.$key->id.'" data-stock="'.$stock.'" class="btn btn-primary itens">
                    <i class="icon-copy ion-plus-round"></i>
                </a>
                <a href="#" data-setting="'.$key->id.'" data-stock="'.$stock.'" class="btn btn-primary setting-itens">
                    <i class="icon-copy ion-ios-settings-strong"></i>
                </a>
            </div>':"";
            $html.='
            <div class="col-sm-12 col-md-12 mb-30">
                <div class="form-group">
                    <div class="card card-box text-right">
                        <div class="card-body">
                            <h5 class="card-title">
                                '.$key->title.'
                            </h5>
                            <p class="card-text">
                                '.number_format($key->gross_price,2).'
                            </p>
                            <p class="card-text">
                                QTD:'.$stock.'
                            </p>
                            '.$item.'
                        </div>
                    </div>
                </div>
            </div>';
        }
        echo $html;
    }
}