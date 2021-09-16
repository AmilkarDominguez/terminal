<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Department;
use Yajra\DataTables\DataTables;
use App\Http\Requests\DepartmentRequest;
use Validator;

class DepartamentoController extends Controller
{
    public function index()
    {
        return view('configuration.departamento');
    }
    public function store(Request $request)
    {
        $rule = new DepartmentRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            Department::create($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function edit(Request $request)
    {
        $departamento = Department::find($request->id);
        return $departamento->toJson();
    }
    public function update(Request $request)
    {
        $rule = new DepartmentRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Department = Department::find($request->id);
            $Department->update($request->all());
            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }
    public function destroy(Request $request)
    {
        $Department = Department::find($request->id);
        $Department->estado = "ELIMINADO";
        $Department->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
     //FUNCTIONS
    public function data_table()
    {
        //$isUser = auth()->user()->can(['provider.edit', 'provider.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        //if (!$isUser) {$visibility="disabled";}
            return datatables()->of(Department::where('estado','!=','ELIMINADO')->with('user')->get())
            ->addColumn('Editar', function ($item) use ($visibility) {
                $item->v=$visibility;
            return '<a class="btn btn-xs btn-primary text-white '.$item->v.'" onclick="Edit('.$item->id.')" ><i class="icon-pencil"></i></a>';
            })
            ->addColumn('Eliminar', function ($item) {
                return '<a class="btn btn-xs btn-danger text-white '.$item->v.'" onclick="Delete(\''.$item->id.'\')"><i class="icon-trash"></i></a>';
                })
            ->rawColumns(['Editar','Eliminar'])    
            ->toJson();   
    }
}
