<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Packge;
use FilesystemIterator;
use Illuminate\Http\Request;

class PackgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $row= Packge::all();
        foreach ($row as $key) {
        $key->pic_path=url("storage/packges/".$key["pic_path"]);
        }
        return response()->json($row);
        
    }

    public function store(Request $request)
    {
        $return = Packge::create($request);
        return response()->json($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Packge  $packge
     * @return \Illuminate\Http\Response
     */
    public function show($packge,Request $request)
    {
        switch ($packge) {
            case 'download':
               $this->download($request->pluguins);
            break;
            case 'install':
               $this->install($this->nameGit($request->pluguins));
            break;
            case 'unstall':
                return response()->json($request);
            break;
        }
        
    }
    public function destroy(Packge $packge)
    {
        //
    }
    
    /* Func de backend */
    public function nameGit($url = null)
    {
        $name = explode(".git",explode("/",$url)[4])[0];
        return $name;
    }
    public function install($file = null)
    {
        $arquivo = "extensions/$file/setup.json";
        $arquivo = file_get_contents($arquivo);
        $json = json_decode($arquivo);
        foreach ($json->body->controller->file as $name) {
            /* Controlador instalador */ 
            $origem="extensions/$file/$name";
            $destino="../app/Http/Controllers/$name";
            if (copy($origem,$destino))
            {
                echo "Arquivo copiado com Sucesso.";
            }
            else
            {
                echo "Erro ao copiar arquivo.";
            }
        }
        foreach ($json->body->route->file as $name) {
            /* Controlador instalador */ 
            $origem="extensions/$file/$name";
            echo "<br> ===INSTALDA=== <br>";
            $code= file_get_contents("extensions/$file/$name");
            switch ($name) {
                case 'api.setmark':
                    $arquivo = fopen("../routes/api.php", "a+");
                    fwrite($arquivo, "\n$code");
                    fclose($arquivo);
                break;
                case 'web.setmark':
                    $arquivo = fopen("../routes/web.php", "a+");
                    fwrite($arquivo, "\n$code");
                    fclose($arquivo);
                break;
            }
        }
        
    }
    public function download($url = null)
    {
        $teste=shell_exec("cd extensions && git clone $url");
        $name = $this->nameGit($url);
        $arquivos = array();
        $FileController = 'Controller';
        $FileRoute = '.setmark';
        $iterator = new FilesystemIterator("extensions/$name");
        foreach ($iterator as $file) {
            $filename = $iterator->key();
            if (strpos($filename, $FileController) !== false) {
                echo $controller[] = $this->filename($filename);
                echo "<br>";
            }
            if (strpos($filename, $FileRoute) !== false) {
                echo $route[] = $this->filename($filename);
                echo "<br>";
            }
        }
        $data = array(
            "head" => array(
                "name"=>$name,
                "version"=>"1.0.1v"
            ),
            "body" => array(
                "controller"=>array(
                    "shell"=>"mover file",
                    "file"=>$controller
                ),
                "route"=>array(
                    "shell"=>"mover file",
                    "file"=>$route
                )
            )
        );
        
        $arquivo = "extensions/$name/setup.json";
        $json = json_encode($data);
        $file = fopen($arquivo,'w');
        fwrite($file, $json);
        fclose($file);
    }
    public function filename($name = null)
    {
        $name=explode("\\",$name)[1];
        return $name;
    }
}