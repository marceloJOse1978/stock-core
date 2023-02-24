<?php

namespace App\Rules;

use App\Models\Document;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\OtherItems;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;

class StockRule 
{
    public function createRule($document_id= null,$product_id=null,$qty,$move=true)
    {
        $product=Product::find($product_id);
        $qtd=(!empty($move)) ? $qty : (-1)*$qty;
        Stock::create([
            "user_id"=>Auth::id(),
            "document_id"=>$document_id,
            "product_id"=>$product_id,
            "move"=>$move,
            "title"=>(!empty($move)) ? "Compra ou Entrada" : "Vendas ou Saida" ,
            "qty"=>$qtd,
            "unit"=>$product->unit_id,
            "discount_for_itens"=>0,
            "tax"=>$product->tax_id,
            "net_total"=>$product->supply_price,
            "gross_total"=>$product->gross_price
        ]);
    }
    public function createInvoiceRule($document_id= null,$product_id=null,$qty,$move=true)
    {
        $product=Product::find($product_id);
        $qtd=(!empty($move)) ? $qty : (-1)*$qty;
        Stock::create([
            "user_id"=>Auth::id(),
            "document_id"=>$document_id,
            "product_id"=>$product_id,
            "move"=>$move,
            "title"=>(!empty($move)) ? "Compra ou Entrada" : "Vendas ou Saida" ,
            "qty"=>$qtd,
            "unit"=>$product->unit_id,
            "discount_for_itens"=>0,
            "tax"=>$product->tax_id,
            "net_total"=>$product->supply_price,
            "gross_total"=>$product->gross_price
        ]);
    }

    public function valida_invoices($invoice_id=null){

        $item= OtherItems::where("invoice_id", $invoice_id)
        ->selectRaw('SUM(qty) as qtd , invoice_id , product_id')
        ->groupBy('product_id')
        ->get();
        if (empty(Invoice::find($invoice_id)->status) ) {
            foreach ($item as $name) {
                if (!empty(Product::find($name->product_id)->stock_type) && Product::find($name->product_id)->stock_type=="A") {
                    $this->createInvoiceRule(0,$name->product_id,$name->qtd);
                }
            }
        }
    }

    public function valida($document_id=null){

        $item= Item::where("document_id", $document_id)
        ->selectRaw('SUM(qty) as qtd , document_id , product_id')
        ->groupBy('product_id')
        ->get();
        if (empty(Document::find($document_id)->status) ) {
            foreach ($item as $name) {
                if (Product::find($name->product_id)->stock_type=="A") {
                    $this->createRule($document_id,$name->product_id,$name->qtd,false);
                }
            }
        }
    }
    
}