<?php

namespace App\Http\Controllers;

use App\Models\Aceptacion;
use App\Models\Entrega;
use App\Models\Presupuesto;
use App\Models\Reparacion;
use Illuminate\Http\Request;

class EstadosController extends Controller
{
    public function presupuestar(Request $request){

        //validacion de formulario
        $request->validate([
            'id'=>'required',
            'presupuesto'=>'required',
        ]);

        $presupuesto= new Presupuesto;
        $presupuesto->planilla_id=$request->id;
        $presupuesto->precio=$request->presupuesto;
        $presupuesto->diagnostico=$request->diagnostico;
        $presupuesto->save();
        
        return redirect()->route('planilla', ['planillaID' => $request->id]);
    }
    public function confirmar(Request $request){
        //validacion de formulario
        $request->validate([
            'reparar'=>'required',
        ]);
        $aceptacion= new Aceptacion;
        $aceptacion->planilla_id=$request->id;
        $aceptacion->seña=$request->seña;
        if($request->reparar=="si"){
            $aceptacion->aceptacion=1;
        }else{
            $aceptacion->aceptacion=0;
            $aceptacion->seña=null;
        }
        $aceptacion->save();
        
        return redirect()->route('planilla', ['planillaID' => $request->id]);
    }
    public function reparacion(Request $request){

        //validacion de formulario
        $request->validate([
            'reparado'=>'required',
        ]);
        $reparacion= new Reparacion;
        $reparacion->planilla_id=$request->id;
        if($request->reparado=="si"){
            $reparacion->reparado=1;
        }else{
            $reparacion->reparado=0;
        }
        $reparacion->observacion=$request->observacion;
        $reparacion->save();
        
        return redirect()->route('planilla', ['planillaID' => $request->id]);
    }
    public function entrega(Request $request){

        //validacion de formulario
        $request->validate([
            'entregado'=>'required',
        ]);

        $entrega= new Entrega;
        $entrega->planilla_id=$request->id;
        if($request->entregado=="si"){
            $entrega->entregado=1;
        }else{
            $entrega->entregado=0;
        }
        $entrega->obs_entrega=$request->obs_entrega;
        $entrega->save();
        
        return redirect()->route('planilla', ['planillaID' => $request->id]);
    }
    public function editarPresupuesto(Request $request){
        
        
        $presupuesto=Presupuesto::where('planilla_id',$request->id)->first();
        $presupuesto->planilla_id=$request->id;
        $presupuesto->precio=$request->presupuesto;
        $presupuesto->diagnostico=$request->diagnostico;
        $presupuesto->save();
        
        return redirect()->route('planilla', ['planillaID' => $request->id]);
    }
    public function editarConfirmacion(Request $request){
        $request->validate([
            'reparar'=>'required',
        ]);
        $aceptacion=Aceptacion::where('planilla_id',$request->id)->first();
        $aceptacion->seña=$request->seña;
        if($request->reparar=="si"){
            $aceptacion->aceptacion=1;
        }else{
            $aceptacion->aceptacion=0;
            $aceptacion->seña=null;
        }
        $aceptacion->save();
        
        return redirect()->route('planilla', ['planillaID' => $request->id]);
    }
    public function editarResultado(Request $request){
        $request->validate([
            'reparado'=>'required',
        ]);
        $reparacion=Reparacion::where('planilla_id',$request->id)->first();
        if($request->reparado=="si"){
            $reparacion->reparado=1;
        }else{
            $reparacion->reparado=0;
        }
        $reparacion->observacion=$request->observacion;
        $reparacion->save();
        
        return redirect()->route('planilla', ['planillaID' => $request->id]);
    }
    public function editarEntrega(Request $request){
        $request->validate([
            'entregado'=>'required',
        ]);

        $entrega=Entrega::where('planilla_id',$request->id)->first();
        if($request->entregado=="si"){
            $entrega->entregado=1;
        }else{
            $entrega->entregado=0;
        }
        $entrega->obs_entrega=$request->obs_entrega;
        $entrega->save();
        
        return redirect()->route('planilla', ['planillaID' => $request->id]);
    }




}
