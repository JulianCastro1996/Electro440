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
    public function store(Request $request)
    {
        $datos=
        $request->validate([
            'cliente'=>'required',
            'articulo'=>'required'
        ]);

        $planilla= Planilla::create($datos);
        return redirect()->route('listado', ['pag' => 1]);
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
