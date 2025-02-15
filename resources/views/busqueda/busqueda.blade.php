@extends('adminlte::page')

@section('title', 'Busquedas')

@section('content')
    <div class="container">
    <h1>Búsqueda de Pacientes por Voz</h1>
    <div class="form-group">
        <label for="voice-input">Habla para buscar:</label>
        <input type="text" id="voice-input" class="form-control" placeholder="Habla para buscar...">
        <button id="voice-button" class="btn btn-primary">Comenzar</button>
    </div>
</div>
@stack('scripts')
<script src="{{asset('js/voz.js')}}"></script>
        @endsection
