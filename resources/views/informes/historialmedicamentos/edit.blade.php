@extends('adminlte::page')

@section('title', 'Editar - Historial de medicamentos')

@section('content')
<div class="flex justity-center flex-wrap p-4 mt-5">
    @include('informes.historialmedicamentos.form')
</div>
@endsection