@extends('adminlte::page')

@section('title', 'Agregar medicamentos')

@section('content')
    <div class="flex justity-center flex-wrap p-4 mt-5">
        @include('almacen.medicamentos.form')
    </div>
@endsection
