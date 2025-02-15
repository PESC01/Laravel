@extends('adminlte::page')

@section('content')
<div class="right_col" role="main">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Detalle de {{ $role->name }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn" style="background-color: rgb(0, 128, 64); color:white;" href="{{ route('roles.index') }}"> Volver atrás</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <strong>Nombre:</strong>
                <b>{{ $role->name }}</b>
                <img src="{{asset('images/rol.png')}}" width="100%" alt="">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <strong>Permisos:</strong>
                <div>
                    @if(!empty($rolePermissions))
                        @foreach($rolePermissions as $permission)
                            <span class="badge badge-success">{{ $permission->name }}</span>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
