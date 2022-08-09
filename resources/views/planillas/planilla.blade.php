@extends('layouts.app')

@section('title',"Solicitud Nº: $p->id ")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center text-bg-dark ">
                    <h2>Planilla Nº: {{$p->id}}</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item ">
                            <span><strong>Cliente:</strong> {{$p->cliente}}</span>
                        </li>
                        <li class="list-group-item ">
                            <span><strong>Contacto:</strong> {{$p->contacto}}</span>
                        </li>
                        <li class="list-group-item ">
                            <span><strong>Articulo:</strong> {{$p->articulo}}</span>
                        </li>
                        <li class="list-group-item ">
                            <span><strong>Detalle:</strong>  {{$p->detalle}}</span>
                        </li>
                    @if ($p->presupuesto != null)
                        <li class="list-group-item ">
                            <span><strong>Presupuesto:</strong>  {{$p->presupuesto}}.</span>
                        </li>
                        <li class="list-group-item ">
                            <span><strong>Diagnostico:</strong> {{$p->diagnostico}}.</span>
                        </li>
                    </ul>                    
                    @else
                    </ul>
                        <form  action="{{route('presupPlanilla')}}" method="POST" class="row  justify-content-center ">
                        @csrf
                        <div class="row justify-content-center">
                            <input type="hidden" name="id" value="{{$p->id}}">
                            <div class="col-12 my-2">
                                <input type="number" class="form-control" name="presupuesto" placeholder="Presupuesto" aria-label="Presupuesto">
                                @error('presupuesto')
                                    <strong class="text-danger">Campo obligatorio</strong>
                                @enderror
                            </div>
                            <div class="col-12 my-2">
                                <textarea class="form-control" name="diagnostico" placeholder="Diagnostico" ></textarea>
                            </div>
                            <input type="submit" class="btn btn-primary my-3 col-3 " value="Presupuestar">
                        </div>
                        </form>
                    @endif                
                </div>
                <div class="card-footer  text-bg-dark">
                        Recibido: {{$p->created_at}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection