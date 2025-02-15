@extends('adminlte::page')

@section('title', 'Editar registro de pruebas médicas')

@section('content')
<div class="flex justity-center flex-wrap p-4 mt-5">
    @include('informes.pruebasmedicas.form')
</div>
@endsection