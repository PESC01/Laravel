@extends('adminlte::page')

@section('title', 'Agregar contacto')

@section('content')
    <div class="flex justity-center flex-wrap p-4 mt-5">
        @include('personas.contactos.form')
    </div>
@endsection
