<?php

namespace App\Html;

use App\Models\Document;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\Product;
use App\Models\Stock;

class InvoiceHtml 
{
    public function table(){
        $data= Invoice::all();
        
        foreach ($data as $name) {
            $name->provider_id = (empty($name->providers->name)) ? "Consumidor Final" : $name->providers->name ;
            if (!empty($name->status)) {
                $name->status='<td><span class="badge badge-primary">Emitido</span></td>';
                $action='-';
            } else {
                $name->status='<td><span class="badge badge-danger">Rascunho</span></td>';
                $action='
                <div class="table-actions">
                    <form action="'.route("invoices.destroy",$name->id).'" method="POST">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" style="color:#e95959; border: hidden; background:none;" ><i style="font-size: 20px" class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
                    </form>
                </div>';
            }
           /*  <a href=" '.route("invoices.edit",$name->id).' " style=" color:#265ed7;"><i class="icon-copy fa fa-edit" aria-hidden="true"></i></a> */
            $name->action=$action; 
        }
        return $data;
    }
    
    public function searchProducts($search = null)
    {
        /* esta rota não e definitiva */
        if (empty($search)) {
            $data=Product::where("status","1")->where("stock_type","A")->get();
        } else {
            $data=Product::where("status","1")->where("stock_type","A")->where('title', 'like', $search.'%')->get();
        }
        $html=null;
        foreach ($data as $key) {
            
            $item='
            <div class="btn-list">
                <a href="#" data-setting="'.$key->id.'" class="btn btn-primary setting-itens">
                    <i class="icon-copy ion-ios-settings-strong"></i>
                </a>
            </div>';
            $html.='
            <div class="col-sm-12 col-md-12 mb-30">
                <div class="form-group">
                    <div class="card card-box text-right">
                        <div class="card-body">
                            <h5 class="card-title">
                                '.$key->title.'
                            </h5>
                            <p class="card-text">
                                '.number_format($key->supply_price,2).'
                            </p>
                            '.$item.'
                        </div>
                    </div>
                </div>
            </div>';
        }
        echo $html;
    }
    public function itensSetting($id)
    {
        $html='
        <input type="hidden" id="product_id_O" name="product_id_O" value="'.$id.'">
        <div class="col-md-12 col-sm-12">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>QTD</label>
                        <input type="number"  required min="1" name="qty_O" id="qty_O" value="1" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Desconto</label>
                        <input type="text" name="discount_for_itens_O" id="discount_for_itens_O" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Imposto de Iva</label>
                        <select class="form-control" name="tax" id="tax_O">
                            <option value="14">Padrão do Sistema</option>
                            <option value="5">5% IVA</option>
                            <option value="7">7% IVA</option>
                            <option value="14">14% IVA</option>
                            <option value="27">27% IVA</option>
                            <option value="0">ISENTO DE IVA</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Preço</label>
                        <input type="text" name="gross_total_O" id="gross_total_O" placeholder="Se deixar em branco sera preenchido automático" class="form-control">
                    </div>
                </div>
            </div>
        </div>';
        echo $html;
    }
}