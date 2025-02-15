@extends('adminlte::page')


@section('content')
    <div class="right_col" role="main">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Gestion de usuarios</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.create') }}"> Crear nuevo usuario</a>
            </div>
        </div>



        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif


        <table class="table table-bordered">
            <tr>
                <th style="background-color:rgb(0, 81, 128);color:white;">#</th>
                <th style="background-color:rgb(0, 81, 128);color:white;">Nombre</th>
                <th style="background-color:rgb(0, 81, 128);color:white;">Correo</th>
                <th style="background-color:rgb(0, 81, 128);color:white;">Roles</th>
                <th style="background-color:rgb(0, 81, 128);color:white;" width="280px">Acción</th>
            </tr>
            @foreach ($data as $key => $user)
                <tr>
                    <td>
                        <center> <img src="{{ asset('images/usser.png') }}" width="40px" alt=""> </center>
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if (!empty($user->getRoleNames()))
                            @foreach ($user->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Ver</a>
                        <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Editar</a>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </table>


        @if ($data->lastPage() > 1)
            <div class="pagination">
                <a href="{{ $data->url(1) }}"
                    class="pagination-link {{ $data->currentPage() == 1 ? 'disabled' : '' }}">Primera</a>
                <a href="{{ $data->previousPageUrl() }}"
                    class="pagination-link {{ $data->currentPage() == 1 ? 'disabled' : '' }}">Anterior</a>

                @for ($i = 1; $i <= $data->lastPage(); $i++)
                    <a href="{{ $data->url($i) }}"
                        class="pagination-link {{ $data->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
                @endfor

                <a href="{{ $data->nextPageUrl() }}"
                    class="pagination-link {{ $data->currentPage() == $data->lastPage() ? 'disabled' : '' }}">Siguiente</a>
                <a href="{{ $data->url($data->lastPage()) }}"
                    class="pagination-link {{ $data->currentPage() == $data->lastPage() ? 'disabled' : '' }}">Última</a>
            </div>
        @endif
        <style>
            .pagination {
                display: flex;
                justify-content: center;
                margin-top: 20px;
            }

            .pagination-link {
                margin: 0 5px;
                padding: 5px 10px;
                border: 1px solid #ddd;
                text-decoration: none;
                color: #007bff;
            }

            .pagination-link.active {
                background-color: #007bff;
                color: white;
                border-color: #007bff;
            }

            .pagination-link.disabled {
                color: #ccc;
                pointer-events: none;
                cursor: default;
            }
        </style>


    </div>
@endsection
