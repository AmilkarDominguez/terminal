<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Travel;
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
    public function start_travel(Request $request)
    {
        $Travel = Travel::where('code',$request->code)->where('estado','ACTIVO')->first();
        $Travel->latitud = $request->latitud;
        $Travel->longitud = $request->longitud;
        $Travel->update();
        return $Travel; 
    }
    public function finish_travel(Request $request)
    {
        $Travel = Travel::where('code',$request->code)->where('estado','ACTIVO')->first();
        $Travel->estado = 'INACTIVO';
        $Travel->update();
        return $Travel; 
    }
    public function tracking_travel(Request $request)
    {
        $Travel = Travel::where('code',$request->code)->with('bus','origen','destino')->first();
        $Travel->latitud = floatval($Travel->latitud);
        $Travel->longitud = floatval($Travel->longitud);
        return $Travel; 
    }
    
    
}
