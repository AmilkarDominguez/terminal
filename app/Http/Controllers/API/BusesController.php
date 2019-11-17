<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bus;
use App\User;


class BusesController extends Controller
{
    public function list()
    {
        return Bus::where('estado','ACTIVO')->with('user','license')->get();
    }
    public function list_JSON()
    {
        return Bus::where('estado','ACTIVO')->with('user')->get()->toJson(); 
    }
}
