<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Institutional;
use App\User;

class InstitucionalController extends Controller
{
    public function list()
    {
        return Institutional::where('estado','ACTIVO')->with('user')->get();
    }
    public function list_JSON()
    {
        return Institutional::where('estado','ACTIVO')->with('user')->get()->toJson(); 
    }
}
