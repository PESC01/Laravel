@extends('adminlte::page')

@section('title', 'Editar diario de atención')

@section('content')
<div class="flex justity-center flex-wrap p-4 mt-5">
    @include('informes.diario.form')
</div>
@endsection