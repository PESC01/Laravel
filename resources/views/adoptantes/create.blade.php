@extends('adminlte::page')

@section('title', 'Agregar registro de persona')

@section('content')
    <div class="flex justity-center flex-wrap p-4 mt-5">
        @include('adoptantes.form')
    </div>
@endsection
