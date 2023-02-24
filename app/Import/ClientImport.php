<?php

namespace App\Import;

use App\Models\Clients;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ClientImport 
{
    protected $set;

    public function __construct(Clients $clients)
    {
        $this->set = $clients;
    }
    public function save($file,$route="excel/clients")
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
                    $code= $item[0];
                    $db = $this->set->where('code',$code)->first();
                    //Se ouver Clientes com este NIF
                    if(!empty($db)){
                        $db->update([
                            'code'=> $code,
                            'name'=> $item[1],
                            'email'=> $item[2],
                            'mobile'=> $item[3],
                        ]);
                    //Se não ouver Clientes com este NIF
                    }else{
                        $this->set->create([
                            'code'=> $code,
                            'name'=> $item[1],
                            'email'=> $item[2],
                            'mobile'=> $item[3],
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
