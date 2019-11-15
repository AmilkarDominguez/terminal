<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\License;

class API_TarjetaOperacionController extends Controller
{
    public function list()
    {
        return License::where('estado','ACTIVO')->with('user')->get();
    }  
}
