<?php

namespace App\Import;

use App\Models\Product;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ProductImport 
{
    protected $set;

    public function __construct(Product $data)
    {
        $this->set = $data;
    }
    public function save($file,$route="excel/products")
    {
        $read = IOFactory::load("storage/$route/$file");
        $data = $read->getActiveSheet()->toArray();
        $line=0;
        foreach($data as $item){
            //condition to verify if has 3 collumns in the worksheet
            if(count($item)==4){
                //your condition here to first line
                if($line==0){
                    //
                }
                if($line>0){
                    $reference = $item[0];
                    $db = $this->set->where('reference',$reference)->first();
                    //Se ouver Clientes com este NIF
                    if(!empty($db)){
                        $db->update([
                            'reference'=> $reference,
                            'title'=> $item[1],
                            'gross_price'=> $item[2],
                            'tax_id'=> $item[3],
                        ]);
                    //Se não ouver Clientes com este NIF
                    }else{
                        $this->set->create([
                            'reference'=> $reference,
                            'title'=> $item[1],
                            'gross_price'=> $item[2],
                            'tax_id'=> $item[3],
                        ]);
                    }
                }
                $line++;
            }else{
                $data ="Estrutura do Arquivo errada !";
            }
        }
        return $data = "Cliente registado com sucesso NO: $line";
    }
}
