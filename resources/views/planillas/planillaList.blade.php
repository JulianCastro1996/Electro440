@extends('layouts.app')

@section('title',"Listado de planillas")

@section('content')
<table class="table">
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
            @if ($p->presupuesto!= null)
            <tr class="table-success" >
            @else
            <tr class="table-danger">
            @endif
                <th scope="row" onclick="location.href='{{route('planilla', ['planillaID' => $p->id])}}';">{{$p->id}}</th>
                <td onclick="location.href='{{route('planilla', ['planillaID' => $p->id])}}';">{{$p->cliente}}</td>
                <td>{{$p->articulo}}</td>
                <td><a type="button" href="{{route('deletePlanilla', ['id' => $p->id])}}" class="btn btn-danger">Borrar</a></td>
            </tr>
        @empty
            <tr>
                <td>"Sin Planillas"</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection