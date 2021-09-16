<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use App\User;
use App\Bus;

class API_BusController extends Controller
{
    public function listBus()
    {
        return Bus::where('estado','ACTIVO')->with('user')->get();
    }
    public function listBrands()
    {
        return Brand::where('estado','ACTIVO')->with('user')->get();
    }
}
