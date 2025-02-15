@extends('adminlte::page')

@section('title', 'Editar seguimientos vitales')

@section('content')
<div class="flex justity-center flex-wrap p-4 mt-5">
    @include('informes.seguimientos.form')
</div>
@endsection