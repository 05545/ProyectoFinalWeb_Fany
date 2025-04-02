<?php

namespace App\Http\Controllers\administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TablaPlanes as Planes;

class PlanesController extends Controller
{
    public function index()
    {
        return view('admin.planes');
    }

    
    public function store(Request $request){
     
        $request->validate([
            'nombre_plan' => 'required|string',
            'precio_plan' => 'required|string',
            'cantidad_limite_plan' => 'required|integer',
            'tipo_plan' => 'required|in:8,16,32',
            'estatus_plan' => 'required|in:1,0,-1',
        ]);
        $tipo_plan = new Planes();
        $tipo_plan->nombre_plan = $request->input('nombre_plan');
        $tipo_plan->precio_plan = $request->input('precio_plan');
        $tipo_plan->cantidad_limite_plan = $request->input('cantidad_limite_plan');
        $tipo_plan->tipo_plan = $request->input('tipo_plan');
        $tipo_plan->estatus_plan = $request->input('estatus_plan');
        $tipo_plan->save();

        
        return redirect()->route('admin.planes')->with('success', 'Plan creado correctamente');
    }

    public function update(Request $request, $id){
 
        $request->validate([
            'modal_nombre_plan' => 'required|string',
            'modal_precio_plan' => 'required|string',
            'modal_cantidad_limite_plan' => 'required|integer',
            'modal_tipo_plan' => 'required|in:8,16,32',
            'modal_estatus_plan' => 'required|in:1,0,-1',
        ]);
        $tipo_plan = Planes::findOrFail($id);
        $tipo_plan->nombre_plan = $request->input('modal_nombre_plan');
        $tipo_plan->precio_plan = $request->input('modal_precio_plan');
        $tipo_plan->cantidad_limite_plan = $request->input('modal_cantidad_limite_plan');
        $tipo_plan->tipo_plan = $request->input('modal_tipo_plan');
        $tipo_plan->estatus_plan = $request->input('modal_estatus_plan');
        $tipo_plan->save();

        
        return redirect()->route('admin.tablero')->with('success', 'Plan actualizado correctamente');
    }

    public function destroy($id){
        $tipo_plan = Planes::findOrFail($id);
        $tipo_plan->delete();
        return redirect()->route('admin.tablero')->with('success', 'Plan eliminado correctamente');
    }
   
}
