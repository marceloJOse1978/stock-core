<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cash;
use App\Models\Document;
use App\Models\Item;
use App\Models\Product;
use App\Models\Stock;
use App\Rules\DocumentRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       return response()->json($request);
    }
    public function store(Request $request, DocumentRule $documentRule)
    {
        $sql["date_due"] =date('Y-m-d');
        $sql["date"] =date('Y-m-d');
        $sql["status"] =true;
        $sql["user_id"] =$request->post()["document"]["user_id"];
        $sql["number"] = date("Y")."-".Document::count()+1;
        $document = Document::create($sql);
        $documentRule->cashRule($request->post()["item"],$document);
        return response()->json($document);
    }
}
