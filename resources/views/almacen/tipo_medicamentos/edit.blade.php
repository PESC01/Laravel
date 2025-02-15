@extends('adminlte::page')

@section('title', 'Editar tipo de medicamento')

@section('content')
    <div class="flex justity-center flex-wrap p-4 mt-5">
        @include('almacen.tipo_medicamentos.form')
    </div>
@endsection
