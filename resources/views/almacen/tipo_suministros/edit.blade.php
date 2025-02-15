@extends('adminlte::page')

@section('title', 'Agregar tipo de suministros')

@section('content')
    <div class="flex justity-center flex-wrap p-4 mt-5">
        @include('almacen.tipo_suministros.form')
    </div>
@endsection
