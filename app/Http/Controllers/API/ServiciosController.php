<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use App\User;

class ServiciosController extends Controller
{
    public function list()
    {
        return Service::where('estado','ACTIVO')->with('user')->get();
    }
    public function list_JSON()
    {
        return Service::where('estado','ACTIVO')->with('user')->get()->toJson(); 
    }
}
