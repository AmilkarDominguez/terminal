<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\License;
use App\User;

class LicenciasController extends Controller
{
    //
    public function list()
    {
        return License::where('estado','ACTIVO')->with('user')->get();
    }
    public function list_JSON()
    {
        return License::where('estado','ACTIVO')->with('user')->get()->toJson(); 
    }
}
