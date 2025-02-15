@extends('adminlte::page')


@section('content')

    <div class="right_col" role="main">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Agregar nuevo usuario</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Atrás</a>
            </div>
        </div>



        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>¡Ups!</strong> Hubo algunos problemas con tu entrada.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class=" form-group">
                    <strong>Nombres completos:</strong>
                    {!! Form::text('name', null, ['placeholder' => 'Nombre', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Correo:</strong>
                    {!! Form::text('email', null, ['placeholder' => 'Correo', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Contraseña:</strong>
                    {!! Form::password('password', ['placeholder' => 'Contraseña', 'class' => 'form-control', 'minlength' => '8']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Confirmar contraseña:</strong>
                    {!! Form::password('confirm-password', [
                        'placeholder' => 'Confirme Contraseña',
                        'class' => 'form-control',
                        'minlength' => '8',
                    ]) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Roles:</strong>
                    {!! Form::select('roles[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Registrar!</button>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
@endsection
