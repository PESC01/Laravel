@extends('adminlte::page')

@section('title', 'Crear Informe')

@section('content')
    <div class="container">
        <h1>Crear Nuevo Informe</h1>
        <form action="{{ route('informes.store') }}" method="POST">
            @csrf
            @include('informes.reportes.form')
        </form>
    </div>
@endsection
