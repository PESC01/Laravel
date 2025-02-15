@extends('adminlte::page')

@section('title', 'Editar preferencias')

@section('content')
<div class="flex justity-center flex-wrap p-4 mt-5">
    @include('informes.preferencias.form')
</div>
@endsection