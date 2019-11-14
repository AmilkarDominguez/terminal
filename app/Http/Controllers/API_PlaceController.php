<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Place;

class API_PlaceController extends Controller
{
    public function listPlaces()
    {
        return Place::where('estado','ACTIVO')->with('user')->get();
    }
}
