@extends('adminlte::page')

@section('title', 'Editar suministros')

@section('content')
    <div class="flex justity-center flex-wrap p-4 mt-5">
        @include('almacen.suministros.form')
    </div>
@endsection
