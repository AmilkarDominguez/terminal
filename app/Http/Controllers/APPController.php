<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class APPController extends Controller
{
    public function programacion()
    {
        return view('app_.programacion');
    }  
    public function informacion()
    {
        return view('app_.informacion');
    }  
    public function avisos()
    {
        return view('app_.programacion');
    }  
}
