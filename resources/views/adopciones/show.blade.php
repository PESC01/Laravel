@extends('adminlte::page')

@section('title', 'Detalle de Adopción')

@section('content')
    <div class="container mt-4">
        <h1>Detalle de Adopción</h1>
        <div class="card mt-3">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <strong>Fecha:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $adopcione->fecha ?? 'N/A' }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <strong>Adoptante:</strong>
                    </div>
                    <div class="col-md-8">
                        @if (isset($adoptantes))
                            @foreach ($adoptantes as $adoptante)
                                @if ($adoptante->id == $adopcione->adoptante)
                                    {{ $adoptante->nombres }} {{ $adoptante->apellidos }}
                                @endif
                            @endforeach
                        @else
                            {{ $adopcione->adoptante }}
                        @endif
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <strong>Paciente:</strong>
                    </div>
                    <div class="col-md-8">
                        @if (isset($personas))
                            @foreach ($personas as $persona)
                                @if ($persona->id == $adopcione->persona)
                                    {{ $persona->nombres }} {{ $persona->apellidos }}
                                @endif
                            @endforeach
                        @else
                            {{ $adopcione->persona }}
                        @endif
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <strong>Motivo:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $adopcione->motivo ?? 'N/A' }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <strong>Observaciones:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $adopcione->observaciones ?? 'N/A' }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <strong>Estado:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $adopcione->estado ?? 'N/A' }}
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('adopciones.index') }}" class="btn btn-secondary">Regresar</a>
        </div>
    </div>
@endsection
