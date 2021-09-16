<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use App\User;
use App\Place;

class API_PlaceController extends Controller
{
    public function listPlaces()
    {
        return Place::where('estado','ACTIVO')->with('user')->get();
    }
    public function listDepartments()
    {
        return Department::where('estado','ACTIVO')->with('user')->get();
    }
}
