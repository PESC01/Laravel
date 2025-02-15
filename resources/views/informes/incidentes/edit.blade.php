@extends('adminlte::page')

@section('title', 'Editar registro de incidente')

@section('content')
<div class="flex justity-center flex-wrap p-4 mt-5">
    @include('informes.incidentes.form')
</div>
@endsection