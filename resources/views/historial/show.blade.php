@extends('adminlte::page')

@section('title', 'Resultados de Búsqueda')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Resultados de Búsqueda</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="text-primary">Pacientes Encontrados:</h4>
                    @if(count($resultados) > 0)
                        <ul class="list-group">
                            @foreach($resultados as $persona)
                                <li class="list-group-item">
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="{{ asset('image/' . $persona->image) }}" style="max-width: 100px; max-height: 100px;" alt="{{ $persona->nombres }}">
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading"><a href="{{route('personas.show', $persona->id)}}">{{ $persona->nombres }} {{ $persona->apellidos }}</a></h4>
                                            <p class="text-muted"><strong>Fecha de Ingreso:</strong> {{ \Carbon\Carbon::parse($persona->fech_registro)->format('d/m/Y') }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-danger">No se encontraron pacientes con ese nombre.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
