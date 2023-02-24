<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\Notification as ModelsNotification;
use Illuminate\Http\Request;

class Notification extends Controller
{
    public function index()
    {
        $notification= Clients::all();
        return response()->json($notification);
    }
}
