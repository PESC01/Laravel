<div class="w-full max-w-lg">
    <div class="flex flex-wrap">
        <h1 class="mb-5">{{ $title }}</h1>
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

<form class="w-full max-w-lg" method="POST" action="{{ $route }}" enctype="multipart/form-data">
    @csrf
    @isset($update)
        @method('PUT')
    @endisset

    <!-- Campos del empleado -->
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{ asset('images/name.png') }}" width="15" alt="">
            </span>
        </div>
        <input name="nombres" id="nombres" value="{{ old('nombres') ?? $empleado->nombres }}" class="form-control"
            placeholder="Nombres completos" type="text" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+"
            title="Solo se permiten letras">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{ asset('images/lastname.png') }}" width="15" alt="">
            </span>
        </div>
        <input name="apellidos" id="apellidos" value="{{ old('apellidos') ?? $empleado->apellidos }}"
            class="form-control" placeholder="Apellidos completos" type="text" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+"
            title="Solo se permiten letras">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
        </div>
        <input name="celular" id="celular" value="{{ old('celular') ?? $empleado->celular }}" class="form-control"
            placeholder="Número de celular" type="tel" pattern="[0-9]+" title="Solo se permiten números">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-graduation-cap"></i> </span>
        </div>
        <input name="calificaciones" id="calificaciones"
            value="{{ old('calificaciones') ?? $empleado->calificaciones }}" class="form-control"
            placeholder="Especialidad" type="text">
    </div>



    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-file-alt"></i> </span>
        </div>
        <input name="antecedentes" id="antecedentes" value="{{ old('antecedentes') ?? $empleado->antecedentes }}"
            class="form-control" placeholder="Antecedentes" type="text">
    </div>

    <!-- Campos del usuario -->
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
        </div>
        <input name="email" id="email" value="{{ old('email') ?? ($empleado->user->email ?? '') }}"
            class="form-control" placeholder="Correo electrónico" type="email">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
        </div>
        <input name="password" id="password" class="form-control" placeholder="Contraseña" type="password">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
        </div>
        <input name="password_confirmation" id="password_confirmation" class="form-control"
            placeholder="Confirmar Contraseña" type="password">
    </div>

    <!-- Campo de selección de roles -->
    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-user-tag"></i> </span>
        </div>
        <select name="roles[]" id="roles" class="form-control" multiple>
            @foreach ($roles as $role)
                <option value="{{ $role }}" {{ in_array($role, $selectedRoles ?? []) ? 'selected' : '' }}>
                    {{ $role }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-block" type="submit">
            {{ $textButton }}
        </button>
    </div>

</form>

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
