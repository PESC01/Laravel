@extends('adminlte::page')

@section('title', 'Editar registro de adopción')

@section('content')
    <div class="flex justity-center flex-wrap p-4 mt-5">
        @include('adopciones.form')
    </div>
@endsection
