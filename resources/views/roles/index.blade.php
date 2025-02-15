@extends('adminlte::page')

@section('content')
    <div class="right_col" role="main">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Gestionar roles</h2>
            </div>
            <div class="pull-right">
                @can('role-create')
                    <a class="btn btn-primary" href="{{ route('roles.create') }}"> Crear nuevo rol</a>
                @endcan
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th style="background-color:rgb(0, 81, 128); color:white; width: 50px;">#</th>
                <th style="background-color:rgb(0, 81, 128); color:white;">Nombre rol</th>
                <th style="background-color:rgb(0, 81, 128); color:white;" width="280px">Acciones</th>
            </tr>
            @foreach ($roles as $key => $role)
                <tr>
                    <td>
                        <center> <img src="{{ asset('images/shield.png') }}" width="40px" alt=""> </center>
                    </td>
                    <td><b style="font-size:15px;">{{ $role->name }}</b></td>
                    <td>
                        @can('role-edit')
                            <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">Editar</a>
                        @endcan
                        @can('role-delete')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                            {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
            @endforeach
        </table>

        @if ($roles->lastPage() > 1)
            <div class="pagination">
                <a href="{{ $roles->url(1) }}"
                    class="pagination-link {{ $roles->currentPage() == 1 ? 'disabled' : '' }}">Primera</a>
                <a href="{{ $roles->previousPageUrl() }}"
                    class="pagination-link {{ $roles->currentPage() == 1 ? 'disabled' : '' }}">Anterior</a>

                @for ($i = 1; $i <= $roles->lastPage(); $i++)
                    <a href="{{ $roles->url($i) }}"
                        class="pagination-link {{ $roles->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
                @endfor

                <a href="{{ $roles->nextPageUrl() }}"
                    class="pagination-link {{ $roles->currentPage() == $roles->lastPage() ? 'disabled' : '' }}">Siguiente</a>
                <a href="{{ $roles->url($roles->lastPage()) }}"
                    class="pagination-link {{ $roles->currentPage() == $roles->lastPage() ? 'disabled' : '' }}">Última</a>
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
