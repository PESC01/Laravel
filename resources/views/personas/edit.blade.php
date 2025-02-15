@extends('adminlte::page')

@section('title', 'Editar datos del paciente')

@section('content')
    <div class="flex justity-center flex-wrap p-4 mt-5">
        @include('personas.form')
    </div>
@endsection
