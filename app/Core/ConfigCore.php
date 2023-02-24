<?php

namespace App\Core;

use App\Models\Setting;

class ConfigCore 
{
    public $setting;
    public function __construct() {
        $this->setting = 'setting-core.json';
    }
    # --- ENVIA DADOS DO CLIENTE ---#
    public function createCompany($post=null,$token=null,$url="https://core.setmark.ao/api/companies") {

        $ch = curl_init($url); // Initialise cURL
        $post = json_encode($post); // Encode the data array into a JSON string
        
        if (!empty($token)) {
            
            header('Content-Type: application/json'); // Specify the type of data
            $authorization = "Authorization: Bearer ".$token; // Prepare the authorisation token
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
            
        }
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1); // Specify the request method as POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // Set the posted fields
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($ch); // Execute the cURL statement
         if(!curl_errno($ch)){
            $info = curl_getinfo($ch);
            if ($info['http_code'] == 200)
                $errmsg = "Pedido Feito Com Sucesso !";
                $data=$this->getSetting($this->setting);
                /* sms("Cliente fez uma um pedido ".$data->data->name); */
        }
        else{
            $errmsg = curl_error($ch);
        }
        curl_close($ch);
        return json_decode($result,true); // Return the received data

    }




    # --- ENVIA DADOS DO CLIENTE ---#
    public function checkedSerial($key="SNXTWY-TW4LYR-DTA9U3-1H",$url="http://core.setmark.ao/api/checked/") {

        $ch = curl_init($url.$key); // Initialise cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1); // Specify the request method as POST
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($ch); // Execute the cURL statement
        curl_close($ch); // Close the cURL connection
        
        $days = @json_decode($result,true)["days"];
        $days = (!empty($days)) ? $days : 0 ;
        $this->active($days,$key); // Return the received data
        return $days;

    }
    public function active($days = null, $key=null)
    {
        $data=$this->getSetting($this->setting,true);
        if (!empty($days)) {
            $data["license"]["date_end"]=date("Y-m-d", strtotime("+$days days", strtotime($data["license"]["date_end"])));
            $data["license"]["key"]=$key;
            $json = json_encode($data);
            file_put_contents($this->setting, $json);
        }
    }





    # --- PEGAR DADOS DE API VIA GET ---#
    public function checked($url = NULL,$booler=false)
    {
        $cURLConnection = curl_init();

        curl_setopt($cURLConnection, CURLOPT_URL, $url);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYPEER, 0);

        $phoneList = curl_exec($cURLConnection);
        curl_close($cURLConnection);

        return json_decode($phoneList,$booler);
    }





    # --- DEFINIÇÃO PADRÃO ---#
    public function setting($days=30)
    {
        $setting=Setting::find(1);
        
        $dados = [
            'core' => 'https://core.setmark.ao/api/',
            'data' => [
                'id'=>null,#SE ESTIVE NULL CONTA NÃO PODE FAZER PAGAMENTOS MOSTRAR NO SISTEMA
                'code'=>(empty($setting->nif)) ? "XXX XXX XXX" : $setting->nif,
                'name'=>(empty($setting->name_bs)) ? "XXX XXX XXX" : $setting->name_bs,
                'phone'=>(empty($setting->phone_bs)) ? "XXX XXX XXX" : $setting->phone_bs,
                'email'=>"geral@galj-export.ao"
            ],
            'license' => [
                'key'=>"TEST",
                'date_start'=>date("Y-m-d"),
                'date_end'=>date('Y-m-d', strtotime("+$days days", strtotime(date("Y-m-d")))),
                'date_now'=>date("Y-m-d")
            ]
        ];
        
        $arquivo ='setting-core.json';

        if (empty(file_exists($this->setting)))
            file_put_contents($this->setting, json_encode($dados));

    }








    # --- PEGAR DADOS DO CLIENTE ---#
    public function getSetting($location = "setting-core.json",$booler=false)
    {
        $data = json_decode(file_get_contents($location),$booler);
        return $data;
    }




    # --- DASHBOARD CRIAR DADOS --- #
    public function dashboard()
    {
        $data=$this->getSetting($this->setting);

        $dia = $this->diasDatas(date("Y-m-d"),$data->license->date_end);

        $dia = (empty($data->license->date_end)) ? "Inativo" : $dia ;
        
        return $dia;
    }





    /**
     * DIAS ENTRE 02 DATAS
     * @author Norberto ALcântara
     * @copyright (c) Célula Nerd, 2019
     * 
     * @param type $data_inicial 2013-08-01
     * @param type $data_final 2013-08-16
     * @return type
     */
    public function diasDatas($data_inicial='2013-08-01',$data_final='2013-08-16') 
    {
        $diferenca = strtotime($data_final) - strtotime($data_inicial);
        $dias = floor($diferenca / (60 * 60 * 24)); 
        return $dias;
    }







    # --- enviar comprovativo --- #
    public function payments($pake,$url = "http://core.setmark.ao/api/payments")
    {
        $filedata = $_FILES['file_path']['tmp_name'];
        $filesize = $_FILES['file_path']['size'];
        if ($filedata != ''){
            $headers = array("Content-Type:multipart/form-data"); // cURL headers for file uploading
            $postfields = array(
                "file_path" => "@$filedata",
                "product_id"=>1,
                "company_id"=>$data = json_decode(file_get_contents($this->setting))->data->id,
                "pack_id"=>$pake,
                "gross_total"=>30000,
            );
            $ch = curl_init();
            $options = array(
                CURLOPT_URL => $url,
                CURLOPT_HEADER => true,
                CURLOPT_POST => 1,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_POSTFIELDS => $postfields,
                CURLOPT_INFILESIZE => $filesize,
                CURLOPT_SSL_VERIFYHOST=> 0,
                CURLOPT_SSL_VERIFYPEER=>0,
                CURLOPT_RETURNTRANSFER => true
            ); // cURL options
            curl_setopt_array($ch, $options);
            $data = curl_exec($ch);
            if(!curl_errno($ch)){
                $info = curl_getinfo($ch);
                if ($info['http_code'] == 200)
                    $errmsg = "Pedido Feito Com Sucesso !";
                    $data=$this->getSetting($this->setting);
                    /* sms("Cliente fez uma um pedido ".$data->data->name); */
            }
            else{
                $errmsg = curl_error($ch);
            }
            curl_close($ch);
        }
        else{
            $errmsg = "Por favor Selecione o Comprovativo";
        }
        return array(
            "data"=>json_encode($data),
            "msg"=>$errmsg
        );
        
    }


    # --- ACTUALIZAR DADOS DO CLIENTE ---#
    public function updateAcount($request){
        
        $data = json_decode(file_get_contents($this->setting),true);
        $data["data"]["id"]=$request["id"];
        $data["data"]["code"]=$request["code"];
        $data["data"]["name"]=$request["name"];
        $data["data"]["phone"]=$request["phone"];
        $data["data"]["email"]=$request["email"];
        $json = json_encode($data);
        file_put_contents($this->setting, $json);
    }






    # --- VERIFICAR DATA LOCAL ---#
    public function checkdataOff(){
        
        $data=$this->getSetting($this->setting,true);
        $dia = $this->diasDatas(date("Y-m-d"),$data["license"]["date_now"]);
        if ($dia<=0) {
            #PODE USAR O SISTEMA
            $data["license"]["date_now"]=date("Y-m-d");
            $json = json_encode($data);
            file_put_contents($this->setting, $json);
            return true;
        }else {
            #NÃO PODE USAR O SISTEMA
            return false;
        }

    }






    # --- VERIFICAR DATA LOCAL ---#
    public function checkdataOn(){
        $data=$this->getSetting($this->setting,true);
        $api=$this->checked("http://core.setmark.ao/api/validate");
        if (!empty($api->date_now)) {
            $data["license"]["date_now"]=$api->date_now;
            $json = json_encode($data);
            file_put_contents($this->setting, $json);
        }
    }

    public function online()
    {
        $api=$this->checked("http://core.setmark.ao/api/validate");
        if (!empty($api->date_now)) {
            return true;
        }
        return false;
    }







    public function sms($msg=null,$phone = "936028718"){
    
        
        /* $instasentClient = new \Instasent\SmsClient("dc6a5adda424497491481a49d0ed092e95c310a8");
        $response = $instasentClient->sendSms("test", "+244$phone", "$msg");

        echo $response["response_code"];
        echo $response["response_body"]; */
    }







    # --- ATIVA SOFTWARE ---#
    public function init()
    {
        $data=$this->getSetting($this->setting);
        $token = "1|f5O383qOIMZf5Tp85jSlECMchDgD9sfyPeCeNlI8"; // Get your token from a cookie or database
        $post = array(
            'code'=>$data->data->code,
            'name'=>$data->data->name,
            'phone'=>$data->data->phone,
            'email'=>$data->data->email
        ); // Array of data with a trigger
        $request = $this->createCompany($post,$token); // Send or retrieve data
        
        $this->updateAcount($request);
        
        #PARA USAR ISSO O USUARIO DEVE ACERTAR SUA DATA LOCAL E DEVER SER ALGO MANUAL
        #echo checkdataOn();
    

    }
}