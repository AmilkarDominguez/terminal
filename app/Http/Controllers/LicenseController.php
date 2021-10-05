<?php

namespace App\Http\Controllers;


use App\License;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\LicenseRequest;
use Validator;

class LicenseController extends Controller
{
    public function index()
    {
        return view('content.operation_card');
    }
    public function store(Request $request)
    {
        $rule = new LicenseRequest();
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors()->all()]);
        } else {
            License::create($request->all());
            return response()->json(['success' => true, 'msg' => 'Registro existoso.']);
        }
    }
    public function show($id)
    {
        //
    }
    public function edit(Request $request)
    {
        $License = License::find($request->id);
        return $License->toJson();
    }
    public function update(Request $request)
    {
        //$rule = new LicenseRequest();
        //return response()->json(['success' => false, 'msg' => $request->empresa]);
        $validator = Validator::make($request->all(), 
        [
            'user_id'           => 'required|integer',
            'nit'               => 'required|string|max:255',
            'empresa'           => 'required|string|max:255|unique:licenses,empresa,'.$request->id,
            'descripcion'       => 'required|string|max:255',
            'fecha_registro'    => 'required',
            'fecha_vigencia'    => 'required',
            'responsable'       => 'required|string|max:255',
            'telefono'          => 'required|string|max:255',
            'email'             => 'required|string|max:255',
            'estado'            => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors()->all()]);
        } else {
            $License = License::find($request->id);
            $License->update($request->all());
            return response()->json(['success' => true, 'msg' => 'Se actualizo existosamente.']);
        }
    }
    public function destroy(Request $request)
    {
        $License = License::find($request->id);
        $License->estado = "ELIMINADO";
        $License->update();
        return response()->json(['success' => true, 'msg' => 'Registro borrado.']);
    }
    //FUNCTIONS
    public function data_table()
    {
        //$isUser = auth()->user()->can(['provider.edit', 'provider.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        //if (!$isUser) {$visibility="disabled";}
        return datatables()->of(License::where('estado', '!=', 'ELIMINADO')->with('user')->get())
            ->addColumn('Editar', function ($item) use ($visibility) {
                $item->v = $visibility;
                return '<a class="btn btn-xs btn-primary text-white ' . $item->v . '" onclick="Edit(' . $item->id . ')" ><i class="icon-pencil"></i></a>';
            })
            ->addColumn('Eliminar', function ($item) {
                return '<a class="btn btn-xs btn-danger text-white ' . $item->v . '" onclick="Delete(\'' . $item->id . '\')"><i class="icon-trash"></i></a>';
            })
            ->rawColumns(['Editar', 'Eliminar'])
            ->toJson();
    }
}
