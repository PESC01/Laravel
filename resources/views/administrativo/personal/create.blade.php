@extends('adminlte::page')

@section('title', 'Agregar personal')

@section('content')
    <div class="flex justity-center flex-wrap p-4 mt-5">
        @include('administrativo.personal.form')
    </div>
@endsection
