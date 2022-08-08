<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Planilla;
use Illuminate\Http\Request;

class PlanillaController extends Controller
{   

    public function create(){
        if(Auth::check()){
            return view('planillas.createPlanilla');
        }else{
            return view('auth.login');
        }
    }
    public function store(Request $request){
        //validacion de formulario
        $request->validate([
            'cliente'=>'required',
            'contacto'=>'min:10',
            'articulo'=>'required'
        ]);

        $planilla= new Planilla;
        $planilla->cliente=$request->cliente;
        $planilla->articulo=$request->articulo;
        $planilla->contacto=$request->contacto;
        $planilla->detalle=$request->detalle; 
        $planilla->save();
        
        return redirect()->route('planilla', ['planillaID' => $planilla->id]);
    }

    
    public function mostrarPlanilla($id){
        $planilla=Planilla::find($id);
        return view('planillas.planilla',['p'=>$planilla]);
    }

    public function presupuestar(Request $request){

        $request->validate([
            'presupuesto'=>'required',
        ]);
        $planilla=Planilla::find($request->id);
        $planilla->presupuesto=$request->presupuesto;
        $planilla->diagnostico=$request->diagnostico; 
        $planilla->save();
        
        return redirect()->route('planilla', ['planillaID' => $request->id]);
    }
    
    public function mostrarListaPlanilla($pag=1){
        $planillas=Planilla::orderBy('id', 'desc')->get();
        return view('planillas.planillaList',['planillas'=>$planillas]);
    }

    public function deletePlanilla($id){
        $planilla=Planilla::find($id);
        $planilla->delete();
        return redirect()->route('listado');
    }
}
