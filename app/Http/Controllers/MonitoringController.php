<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Travel;
use App\Place;
use App\Http\Requests\MonitoringRequest;
use Validator;

class MonitoringController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rule = new MonitoringRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            Monitoring::create($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
