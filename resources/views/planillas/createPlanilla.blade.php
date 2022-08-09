@extends('layouts.app')

@section('title',"Nueva Planilla")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center text-bg-dark ">
                    <h2>Agregar Planilla</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('createPlanilla')}}" method="POST" class="row justify-content-center">
        
                        @csrf
                
                        <div class="row">
                            <div class="col-12 col-md-6 my-2">
                              <input type="text" class="form-control" name="cliente" placeholder="Cliente" aria-label="Cliente">
                                @error('cliente')
                                    <strong class="text-danger">Campo obligatorio</strong>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 my-2">
                              <input type="number" class="form-control" name="contacto" placeholder="Contacto" aria-label="Contacto">
                                @error('contacto')
                                    <strong class="text-danger">Mas de 10 caracteres</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 my-2">
                                <input type="text" class="form-control" name="articulo" placeholder="Articulo" aria-label="Articulo">
                                @error('cliente')
                                    <strong class="text-danger">Campo obligatorio</strong>
                                @enderror
                            </div>
                            <div class="col-12 my-2">
                                <textarea class="form-control" name="detalle" placeholder="Detalle" ></textarea>
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection