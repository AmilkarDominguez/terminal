<?php

namespace App\Http\Controllers;

use App\Institutional;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $User = auth()->user();
        if ($User->state == "ACTIVO") {
            //return view('configuration.institutional');

            $institutional = Institutional::all()->where('estado', 'ACTIVO');

            return view('home', ['institutional' => $institutional]);
        } else {
            auth()->logout();
            return view('inactive');
        }
    }
}
