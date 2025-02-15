@extends('adminlte::page')
@section('content')
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Crear Nuevo Rol</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('roles.index') }}">Volver</a>
                </div>
            </div>
        </div>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>¡Ups!</strong> Hay problemas con el input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        <input type="text" name="name" placeholder="Nombre del rol" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Permisos:</strong>
                        <br />
                        @php
                            $permissionLabels = [
                                // Roles
                                'role-list' => 'Ver listado de roles',
                                'role-create' => 'Crear roles',
                                'role-edit' => 'Editar roles',
                                'role-delete' => 'Eliminar roles',
                                // Usuarios
                                'user-list' => 'Ver listado de usuarios',
                                'user-create' => 'Crear usuarios',
                                'user-edit' => 'Editar usuarios',
                                'user-delete' => 'Eliminar usuarios',
                                // Personal
                                'personal-list' => 'Ver listado de personal',
                                'personal-create' => 'Crear personal',
                                'personal-edit' => 'Editar personal',
                                'personal-delete' => 'Eliminar personal',
                                // Adopciones
                                'adopcion-list' => 'Ver listado de adopciones',
                                'adopcion-create' => 'Crear adopciones',
                                'adopcion-edit' => 'Editar adopciones',
                                'adopcion-delete' => 'Eliminar adopciones',
                                // Adoptantes
                                'adoptante-list' => 'Ver listado de adoptantes',
                                'adoptante-create' => 'Crear adoptantes',
                                'adoptante-edit' => 'Editar adoptantes',
                                'adoptante-delete' => 'Eliminar adoptantes',
                                // Medicamentos
                                'medicamento-list' => 'Ver listado de medicamentos',
                                'medicamento-create' => 'Crear medicamentos',
                                'medicamento-edit' => 'Editar medicamentos',
                                'medicamento-delete' => 'Eliminar medicamentos',
                                // Proveedores
                                'proveedor-list' => 'Ver listado de proveedores',
                                'proveedor-create' => 'Crear proveedores',
                                'proveedor-edit' => 'Editar proveedores',
                                'proveedor-delete' => 'Eliminar proveedores',
                                // Suministros
                                'suministro-list' => 'Ver listado de suministros',
                                'suministro-create' => 'Crear suministros',
                                'suministro-edit' => 'Editar suministros',
                                'suministro-delete' => 'Eliminar suministros',
                                // Tipos de Medicamentos
                                'tmedicamento-list' => 'Ver tipos de medicamentos',
                                'tmedicamento-create' => 'Crear tipos de medicamentos',
                                'tmedicamento-edit' => 'Editar tipos de medicamentos',
                                'tmedicamento-delete' => 'Eliminar tipos de medicamentos',
                                // Tipos de Suministros
                                'tsuministro-list' => 'Ver tipos de suministros',
                                'tsuministro-create' => 'Crear tipos de suministros',
                                'tsuministro-edit' => 'Editar tipos de suministros',
                                'tsuministro-delete' => 'Eliminar tipos de suministros',
                                // Personas
                                'persona-list' => 'Ver listado de personas',
                                'persona-create' => 'Crear personas',
                                'persona-edit' => 'Editar personas',
                                'persona-delete' => 'Eliminar personas',

                                'documentoslegales-list' => 'Ver documentos legales',
                                'documentoslegales-create' => 'Crear documentos legales',
                                'documentoslegales-edit' => 'Editar documentos legales',
                                'documentoslegales-delete' => 'Eliminar documentos legales',
                            ];
                        @endphp
                        @foreach ($permission as $value)
                            <div class="form-check">
                                <input type="checkbox" id="permission[]" name="permission[]" value="{{ $value->name }}"
                                    class="form-check-input">
                                <label class="form-check-label">
                                    {{ $permissionLabels[$value->name] ?? $value->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
