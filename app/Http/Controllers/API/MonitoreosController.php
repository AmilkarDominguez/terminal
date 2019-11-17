<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Monitoring;
use App\User;

class MonitoreosController extends Controller
{
    public function list()
    {
        return Monitoring::where('estado','ACTIVO')->with('user')->get();
    }
    public function list_JSON()
    {
        return Monitoring::where('estado','ACTIVO')->with('user')->get()->toJson(); 
    }
}
