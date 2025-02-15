@extends('adminlte::page')

@section('title', 'Registro de antecedentes médicos')

@section('content')
<div class="flex justity-center flex-wrap p-4 mt-5">
    @include('informes.antecedentesmedicos.form')
</div>
@endsection