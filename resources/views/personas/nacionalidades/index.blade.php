@extends('adminlte::page')

@section('content')

<br>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lista de nacionalidades</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('nacionalidades.create') }}"> Agregar nueva nacionalidad</a>
            </div>
        </div>
    </div>

    <br>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr style="background-color: rgb(66, 127, 241)">
            <th>#</th>
            <th>Pais</th>
            <th width="280px">Acciones</th>
        </tr>
        @foreach ($nacionalidades as $key => $nacionalidad)
            <tr>
                <td>{{ $nacionalidad->id }}</td>
                <td>{{ $nacionalidad->nombre_nacionalidad }}</td>

                <td>

                    <a href="{{ route('nacionalidades.edit', ['nacionalidade' => $nacionalidad]) }}" class="btn btn-info btn-sm"><i
                            class="fa fa-edit"></i> Editar
                    </a>
                    <a href="#"
                        onclick="event.preventDefault();
            document.getElementById('delete-nacionalidad-{{ $nacionalidad->id }}-form').submit();"
                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                        Borrar </a>
                    <form id="delete-nacionalidad-{{ $nacionalidad->id }}-form"
                        action="{{ route('nacionalidades.destroy', ['nacionalidade' => $nacionalidad]) }}" method="POST" class="hidden">
                        @method('DELETE')
                        @csrf
                    </form>

                </td>
            </tr>
        @endforeach
    </table>
@endsection
