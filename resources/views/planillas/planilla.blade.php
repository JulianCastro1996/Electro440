@extends('layouts.app')

@section('title',"Solicitud Nº: $p->id ")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header text-center text-bg-dark ">
                    <h2>Planilla Nº: {{$p->id}}</h2>

                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item ">
                            <span> Cliente:   {{$p->cliente}}</span>
                        </li>
                        <li class="list-group-item ">
                            <span> Contacto:   {{$p->contacto}}</span>
                        </li>
                        <li class="list-group-item ">
                            <span> Articulo:   {{$p->articulo}}</span>
                        </li>
                        <li class="list-group-item ">
                            <span> Detalle:{{$p->detalle}}</span>
                        </li>
                    </ul>          
                </div>
                <div class="card-footer text-bg-dark d-flex justify-content-between">
                    <span class="col">Recibido: {{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y')}}</span>    
                    <button type="button" class="btn btn-outline-light col-3" data-bs-toggle="modal" data-bs-target="#planillaEditar">
                        Editar
                    </button>
                    
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <section class="timeline">
                <ul class="line">
                    <li class="point">
                        <div class="card">
                            <div class="card-header text-bg-dark">
                              Presupuesto
                            </div>
                            @if ($presup)
                            <div class="card-body">      
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item ">
                                            <span> Presupuesto:    {{$presup->precio}}</span>
                                        </li>
                                        <li class="list-group-item ">
                                            <span> Diagnostico:   {{$presup->diagnostico}}</span>
                                        </li> 
                                    </ul>   
                            </div>  
                            <div class="card-footer text-bg-dark d-flex justify-content-between">
                                <span class="col">{{ \Carbon\Carbon::parse($presup->created_at)->format('d/m/Y')}} </span>
                                
                                <button type="button" class="btn btn-outline-light col-4" data-bs-toggle="modal" data-bs-target="#presupuestoEditar">
                                    Editar
                                </button>
                            </div>
                            @else
                            <div class="card-body"> 
                                <form  action="{{route('presupPlanilla')}}" method="POST" class="row  justify-content-center ">
                                @csrf
                                    <div class="row justify-content-center">
                                        <input type="hidden" name="id" value="{{$p->id}}">
                                        <div class="col-12 my-2">
                                            <input type="number" class="form-control" name="presupuesto" placeholder="Presupuesto" aria-label="Presupuesto">
                                            @error('presupuesto')
                                                <strong class="text-danger">Campo obligatorio  
                                            @enderror
                                        </div>
                                        <div class="col-12 my-2">
                                            <textarea class="form-control" name="diagnostico" placeholder="Diagnostico" cols="10" ></textarea>
                                        </div>
                                        <input type="submit" class="btn btn-primary my-3 col-3 " value="OK">
                                    </div>
                                </form> 
                            </div>
                            @endif
                        </div>
                    </li> 
                    <li class="point">
                        <div class="card">
                            <div class="card-header text-bg-dark">
                              Confirmacion reparacion
                            </div>
                            @if ($acept)
                            <div class="card-body">      
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item ">
                                            @if($acept->aceptacion==1)
                                            <span>Reparar</span>
                                            @else
                                            <span>No reparar</span>
                                            @endif
                                            
                                        </li>
                                        <li class="list-group-item ">
                                            <span> Seña:   {{$acept->seña}}</span>
                                        </li> 
                                    </ul>   
                            </div>  
                            <div class="card-footer text-bg-dark d-flex justify-content-between">
                                <span class="col">{{ \Carbon\Carbon::parse($acept->created_at)->format('d/m/Y')}} </span>
                                
                                <button type="button" class="btn btn-outline-light col-4" data-bs-toggle="modal" data-bs-target="#confirmacionEditar">
                                    Editar
                                </button>
                            </div>
                            @elseif ($presup)
                            <div class="card-body"> 
                                <form  action="{{route('confirmarPlanilla')}}" method="POST" class="row  justify-content-center ">
                                @csrf
                                    <input type="hidden" name="id" value="{{$p->id}}">
                                    <div class="row justify-content-center">
                                        <div class="col-12 my-2" >
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reparar" id="si1" value="si" checked>
                                                <label class="form-check-label" for="si1">
                                                  Hacer
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reparar" id="no1" value="no">
                                                <label class="form-check-label" for="no1">
                                                  No hacer
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2 seña">
                                            <input type="number" class="form-control " name="seña" placeholder="Seña" aria-label="Seña">
                                            
                                        </div>
                                        <input type="submit" class="btn btn-primary my-3 col-3 " value="OK">
                                    </div>
                                </form> 
                            </div>
                            @endif
                        </div>
                    </li> 
                    <li class="point">
                        <div class="card">
                            <div class="card-header text-bg-dark">
                              Resultado
                            </div>
                            @if ($repar)
                            <div class="card-body">      
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item ">
                                            @if($repar->reparado==1)
                                                <span>Reparado</span>
                                            @else
                                                <span>No reparado</span>
                                            @endif
                                        </li>
                                        <li class="list-group-item ">
                                            <span> Observacion:   {{$repar->observacion}}</span>
                                        </li> 
                                    </ul>   
                            </div>  
                              
                            <div class="card-footer text-bg-dark d-flex justify-content-between">
                                <span class="col">{{ \Carbon\Carbon::parse($repar->created_at)->format('d/m/Y')}} </span>
                                
                                <button type="button" class="btn btn-outline-light col-4" data-bs-toggle="modal" data-bs-target="#resultadoEditar">
                                    Editar
                                </button>
                            </div>
                            @elseif ($acept && $acept->aceptacion==1)
                            <div class="card-body"> 
                                <form  action="{{route('reparacionPlanilla')}}" method="POST" class="row  justify-content-center ">
                                @csrf
                                    <input type="hidden" name="id" value="{{$p->id}}">
                                    <div class="row justify-content-center">
                                        <div class="col-12 my-2" >
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reparado" id="si2" value="si" checked>
                                                <label class="form-check-label" for="si2">
                                                  Reparado
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reparado" id="no2" value="no">
                                                <label class="form-check-label" for="no2">
                                                  No reparado
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <textarea class="form-control" name="observacion" placeholder="Observacion" cols="10" ></textarea>
                                        </div>
                                        <input type="submit" class="btn btn-primary my-3 col-3 " value="OK">
                                    </div>
                                </form> 
                            </div>
                            @endif
                        </div>
                    </li> 
                    <li class="point">
                        <div class="card">
                            <div class="card-header text-bg-dark ">
                              Retirado
                            </div>
                            @if ($entrega)
                            <div class="card-body ">      
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item ">
                                            @if($entrega->entregado==1)
                                                <span>Entregado</span>
                                            @else
                                                <span>NO Entregado</span>
                                            @endif
                                            
                                        </li>
                                        <li class="list-group-item ">
                                            <span>Observacion: {{$entrega->obs_entrega}}</span>
                                        </li> 
                                    </ul>   
                            </div>  
                              
                            <div class="card-footer text-bg-dark d-flex justify-content-between">
                                <span class="col">{{ \Carbon\Carbon::parse($entrega->created_at)->format('d/m/Y')}} </span>
                                
                                <button type="button" class="btn btn-outline-light col-4" data-bs-toggle="modal" data-bs-target="#entregaEditar">
                                    Editar
                                </button>
                            </div>
                            @elseif ($repar)
                            <div class="card-body"> 
                                <form  action="{{route('entregaPlanilla')}}" method="POST" class="row  justify-content-center ">
                                @csrf
                                    <input type="hidden" name="id" value="{{$p->id}}">
                                    <div class="row justify-content-center">
                                        <div class="col-12 my-2" >
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entregado" id="si3" value="si" checked>
                                                <label class="form-check-label" for="si3">
                                                  Entregado
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio" name="entregado" id="no3" value="no">
                                                <label class="form-check-label" for="no3">
                                                  No entregado
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <textarea class="form-control" name="obs_entrega" placeholder="obs_entrega" cols="10" ></textarea>
                                        </div>
                                        <input type="submit" class="btn btn-primary my-3 col-3 " value="OK">
                                    </div>
                                </form> 
                            </div>
                            @endif
                        </div>
                    </li> 
                </ul>
            </section>
        </div>
       
    </div>
</div>

<div class="modal fade" id="planillaEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header text-bg-dark">
          <h5 class="modal-title" id="exampleModalLabel">Editar planilla Nº: {{$p->id}}</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('editarPlanilla', ['planillaID' => $p->id])}}" method="POST" class="row justify-content-center">
                @csrf
                
                <input type="hidden" name="id" value="{{$p->id}}">
                <div class="row">
                    <div class="col-12 col-md-6 my-2">
                      <input type="text" class="form-control" name="cliente" placeholder="Cliente" aria-label="Cliente" value="{{$p->cliente}}">
                        @error('cliente')
                            <strong class="text-danger">Campo obligatorio</strong>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 my-2">
                      <input type="number" class="form-control" name="contacto" placeholder="Contacto" aria-label="Contacto" value="{{$p->contacto}}">
                        @error('contacto')
                            <strong class="text-danger">Mas de 10 caracteres</strong>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 my-2">
                        <input type="text" class="form-control" name="articulo" placeholder="Articulo" aria-label="Articulo" value="{{$p->articulo}}">
                        @error('cliente')
                            <strong class="text-danger">Campo obligatorio</strong>
                        @enderror
                    </div>
                    <div class="col-12 my-2">
                        <textarea class="form-control" name="detalle" placeholder="Detalle"  >{{$p->detalle}}</textarea>
                    </div>
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Editar
                        </button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
@if ($presup)
<div class="modal fade" id="presupuestoEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header text-bg-dark">
          <h5 class="modal-title" id="exampleModalLabel">Editar presupuesto</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form  action="{{route('editarPresupuesto')}}" method="POST" class="row  justify-content-center ">
                @csrf
                    <div class="row justify-content-center">
                        <input type="hidden" name="id" value="{{$p->id}}">
                        <div class="col-12 my-2">
                            <input type="number" class="form-control" name="presupuesto" placeholder="Presupuesto" aria-label="Presupuesto" value="{{$presup->precio}}">
                            @error('presupuesto')
                                <strong class="text-danger">Campo obligatorio  
                            @enderror
                        </div>
                        <div class="col-12 my-2">
                            <textarea class="form-control" name="diagnostico" placeholder="Diagnostico" cols="10" >{{$presup->diagnostico}}</textarea>
                        </div>
                        <input type="submit" class="btn btn-primary my-3 col-3 " value="OK">
                    </div>
                </form> 
        </div>
      </div>
    </div>
</div>  
@endif
@if ($acept)
<div class="modal fade" id="confirmacionEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header text-bg-dark">
          <h5 class="modal-title" id="exampleModalLabel">Editar aceptacion</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form  action="{{route('editarConfirmacion')}}" method="POST" class="row  justify-content-center ">
                @csrf
                    <input type="hidden" name="id" value="{{$p->id}}">
                    <div class="row justify-content-center">
                        <div class="col-12 my-2" >
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reparar" id="hacer1" value="si" checked>
                                <label class="form-check-label" for="hacer1">
                                  Hacer
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="reparar" id="nohacer1" value="no">
                                <label class="form-check-label" for="nohacer1">
                                  No hacer
                                </label>
                            </div>
                        </div>
                        <div class="col-12 my-2 seña">
                            <input type="number" class="form-control " name="seña" placeholder="Seña" aria-label="Seña" value="{{$acept->seña}}"> 
                        </div>
                        <input type="submit" class="btn btn-primary my-3 col-3 " value="OK">
                    </div>
                </form> 
        </div>
      </div>
    </div>
</div>   
@endif
@if ($repar)
<div class="modal fade" id="resultadoEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header text-bg-dark">
          <h5 class="modal-title" id="exampleModalLabel">Editar resultado</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form  action="{{route('editarResultado')}}" method="POST" class="row  justify-content-center ">
                @csrf
                <input type="hidden" name="id" value="{{$p->id}}">
                <div class="row justify-content-center">
                    <div class="col-12 my-2" >
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="reparado" id="hacer2" value="si" checked>
                            <label class="form-check-label" for="hacer2">
                              Reparado
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="reparado" id="nohacer2" value="no">
                            <label class="form-check-label" for="nohacer2">
                              No se pudo reparar
                            </label>
                        </div>
                    </div>
                    <div class="col-12 my-2">
                        <textarea class="form-control" name="observacion" placeholder="Observacion" cols="10" >{{$repar->observacion}}</textarea>
                    </div>
                    <input type="submit" class="btn btn-primary my-3 col-3 " value="OK">
                </div>
            </form> 
        </div>
      </div>
    </div>
</div>  
@endif
@if ($entrega)
<div class="modal fade" id="entregaEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header text-bg-dark">
          <h5 class="modal-title" id="exampleModalLabel">Editar entrega</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form  action="{{route('editarEntrega')}}" method="POST" class="row  justify-content-center ">
                @csrf
                <input type="hidden" name="id" value="{{$p->id}}">
                <div class="row justify-content-center">
                    <div class="col-12 my-2" >
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="entregado" id="hacer3" value="si" >
                            <label class="form-check-label" for="hacer3">
                              Entregado
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="entregado" id="nohacer3" value="no" checked>
                            <label class="form-check-label" for="nohacer3">
                              No se pudo entregar
                            </label>
                        </div>
                    </div>
                    <div class="col-12 my-2">
                        <textarea class="form-control" name="obs_entrega" placeholder="Observacion entrega" cols="10" >{{$entrega->obs_entrega}}</textarea>
                    </div>
                    <input type="submit" class="btn btn-primary my-3 col-3 " value="OK">
                </div>
            </form> 
        </div>
      </div>
    </div>
</div> 
@endif
@endsection