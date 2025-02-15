@extends('adminlte::page')

@section('title', 'Editar proveedor')

@section('content')
    <div class="flex justity-center flex-wrap p-4 mt-5">
        @include('almacen.proveedores.form')
    </div>
@endsection
