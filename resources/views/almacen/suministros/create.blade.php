@extends('adminlte::page')

@section('title', 'Agregar suministros')

@section('content')
    <div class="flex justity-center flex-wrap p-4 mt-5">
        @include('almacen.suministros.form')
    </div>
@endsection
