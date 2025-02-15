@extends('adminlte::page')

@section('title', 'Registro de incidentes')

@section('content')
<div class="flex justity-center flex-wrap p-4 mt-5">
    @include('informes.incidentes.form')
</div>
@endsection