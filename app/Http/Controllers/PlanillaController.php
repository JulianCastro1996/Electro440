<?php

namespace App\Http\Controllers;

use App\Models\Aceptacion;
use App\Models\Entrega;
use App\Models\Planilla;
use App\Models\Presupuesto;
use App\Models\Reparacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function editarPlanilla(Request $request){
        $request->validate([
            'cliente'=>'required',
            'articulo'=>'required'
        ]);
        $planilla=Planilla::find($request->id);
        $planilla->cliente=$request->cliente;
        $planilla->articulo=$request->articulo;
        $planilla->contacto=$request->contacto;
        $planilla->detalle=$request->detalle; 
        $planilla->save();
        
        return redirect()->route('planilla', ['planillaID' => $planilla->id]);
    }
    public function buscar(Request $request){
        $request->validate([
            'buscar'=>'required'
        ]);
        $planillas=Planilla::where('cliente','like','%'.$request->buscar.'%')->get();
        return view('planillas.planillaList',['planillas'=>$planillas]);
    }
    public function mostrarPlanilla($id){
        $planilla=Planilla::find($id);
        $presupuesto=Presupuesto::where('planilla_id',$id)->first();
        $aceptacion=Aceptacion::where('planilla_id',$id)->first();
        $reparacion=Reparacion::where('planilla_id',$id)->first();
        $entrega=Entrega::where('planilla_id',$id)->first();
        return view('planillas.planilla',
        [   'p'=>$planilla,
            'presup'=>$presupuesto,
            'acept'=>$aceptacion,
            'repar'=>$reparacion,
            'entrega'=>$entrega,
        ]);
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
