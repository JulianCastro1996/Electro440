@extends('layouts.app')

@section('title',"Listado de planillas")

@section('content')
<table class="table table-dark table-striped table-hover">
    <thead>
        <tr class="table-dark">
            <th scope="col">ID</th>
            <th scope="col">Cliente</th>
            <th scope="col">Articulo</th>
            <th scope="col">Accion</th>
        </tr>
    </thead>

    <tbody>
        @forelse($planillas as $p)
            <tr >
                <th scope="row" onclick="location.href='{{route('planilla', ['planillaID' => $p->id])}}';">{{$p->id}}</th>
                <td onclick="location.href='{{route('planilla', ['planillaID' => $p->id])}}';">{{$p->cliente}}</td>
                <td>{{$p->articulo}}</td>
                <td>
                    <a type="button"  class="btn btn-outline-danger " data-bs-toggle="modal" data-bs-target="#confirmarBorrado">
                        Borrar
                    </a>
                </td>
            </tr>
            <div class="modal fade" id="confirmarBorrado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-bg-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Confirme el borrado</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-around">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <a type="button" href="{{route('deletePlanilla', ['id' => $p->id])}}" class="btn btn-primary" >Borrar</a>
                            
                    </div>
                </div>
                </div>
            </div>   
        @empty
            <tr>
                <td>"Sin Planillas"</td>
            </tr>
        @endforelse
    </tbody>
</table>



@endsection