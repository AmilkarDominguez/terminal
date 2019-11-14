<?php

namespace App\Http\Controllers;
use App\User;
use App\Travel;
use App\Place;
use App\Bus;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\TravelRequest;
use Validator;

class TravelController extends Controller
{

    public function index()
    {
        return view('content.travel');
    }
    public function store(Request $request)
    {
        $rule = new TravelRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            Travel::create($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function edit(Request $request)
    {
        $Travel = Travel::find($request->id);
        return $Travel->toJson();
    }
    public function update(Request $request)
    {
        $rule = new TravelRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Travel = Travel::find($request->id);
            $Travel->update($request->all());
            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }
    public function destroy(Request $request)
    {
        $Travel = Travel::find($request->id);
        $Travel->estado = "ELIMINADO";
        $Travel->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
        //FUNCTIONS
        public function data_table()
        {
            //$isUser = auth()->user()->can(['provider.edit', 'provider.destroy']);
            //Variable para la visiblidad
            $visibility = "";
            //if (!$isUser) {$visibility="disabled";}
                return datatables()->of(Travel::where('estado','!=','ELIMINADO')->with('user','origen','destino','bus')->get())
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
