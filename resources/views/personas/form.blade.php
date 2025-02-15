<div class="w-full max-w-lg">
    <div class="flex flex-wrap">
        <h1 class="mb-5">{{ $title }}</h1>
    </div>
</div>

<form class="w-full max-w-lg" method="POST" action="{{ $route }}" enctype="multipart/form-data">
    @csrf
    @isset($update)
        @method('PUT')
    @endisset
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-user"></i></span>
        </div>
        <input name="nombres" id="nombres" value="{{ old('nombres') ?? $persona->nombres }}" class="form-control"
            placeholder="Nombres completos del paciente" title="Solo letras" type="text"
            pattern="[A-Za-zÁÉÍÓÚáéíóú\s]+" required>
        @if ($errors->has('nombres'))
            <span class="text-danger">{{ $errors->first('nombres') }}</span>
        @endif
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{ asset('images/lastname.png') }}" width="15"
                    alt=""></span>
        </div>
        <input name="apellidos" id="apellidos" value="{{ old('apellidos') ?? $persona->apellidos }}"
            class="form-control" placeholder="Apellidos completos del paciente" type="text" title="Solo letras"
            pattern="[A-Za-zÁÉÍÓÚáéíóú\s]+" required>
        @if ($errors->has('apellidos'))
            <span class="text-danger">{{ $errors->first('apellidos') }}</span>
        @endif
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <label for="fech_registro" class="mr-2">Fecha de nacimiento:</label>
            <span class="input-group-text"> <img src="{{ asset('images/birthday.png') }}" width="15"></span>
        </div>
        <input name="fech_nac" id="fech_nac" value="{{ old('fech_nac') ?? ($persona->fech_nac ?? '1940-01-01') }}"
            class="form-control" type="date">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{ asset('images/name.png') }}" width="15" alt="">
            </span>
        </div>
        <input name="ci" id="ci" value="{{ old('ci') ?? $persona->ci }}" class="form-control"
            placeholder="Cédula de identidad del paciente" type="text" title="solo numeros " pattern="\d+" required>
        @if ($errors->has('ci'))
            <span class="text-danger">{{ $errors->first('ci') }}</span>
        @endif
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{ asset('images/gender.png') }}" width="15"
                    alt=""></span>
        </div>
        <select name="genero" id="genero" class="form-control">
            <option selected=""> Genero del paciente</option>
            @foreach ($generos as $genero)
                <option
                    value="{{ $genero->id }}"{{ old('genero', $persona->genero) == $genero->id ? 'selected' : '' }}>
                    {{ $genero->nombre_genero }} </option>
            @endforeach
        </select>
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{ asset('images/couple.png') }}" width="15"
                    alt=""></span>
        </div>
        <select name="estado_civil" id="estado_civil" class="form-control">
            <option selected="">Seleccion el estado civil del paciente</option>
            <option value="Soltero"{{ $persona->estado_civil == 'Soltero' ? 'selected' : '' }}>Soltero</option>
            <option value="Casado"{{ $persona->estado_civil == 'Casado' ? 'selected' : '' }}>Casado</option>
            <option value="Viudo"{{ $persona->estado_civil == 'Viudo' ? 'selected' : '' }}>Viudo</option>
            <option value="Divorciado"{{ $persona->estado_civil == 'Divorciado' ? 'selected' : '' }}>Divorciado
            </option>
        </select>
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{ asset('images/countries.png') }}" width="15"
                    alt=""></span>
        </div>
        <select name="nacionalidad" id="nacionalidad" class="form-control">
            <option selected=""> Nacionalidad del paciente</option>
            @foreach ($nacionalidades as $nacionalidad)
                <option
                    value="{{ $nacionalidad->id }}"{{ old('nacionalidad', $persona->nacionalidad) == $nacionalidad->id ? 'selected' : '' }}>
                    {{ $nacionalidad->nombre_nacionalidad }} </option>
            @endforeach
        </select>
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-book"></i></span>
        </div>
        <input name="motivo_ingreso" id="motivo_ingreso"
            value="{{ old('motivo_ingreso') ?? $persona->motivo_ingreso }}" class="form-control"
            placeholder="Motivo de ingreso del paciente" type="text">
    </div>





    <div class="form-group ">

        <div class="input-group-prepend">

            <span class="input-group-text"> <img src="{{ asset('images/photo.png') }}" width="15"
                    alt=""> <label for="image">Foto del paciente:</label></span>
        </div>
        <input type="file" name="image" id="image" value="{{ old('image') ?? $persona->image }}"
            class="form-control">
    </div>

    <div class="form-group ">

        <div class="input-group-prepend">

            <span class="input-group-text"> <img src="{{ asset('images/photo.png') }}" width="15"
                    alt=""> <label for="image">Documento:</label></span>
        </div>
        <input type="file" name="firma_consentimiento" id="firma_consentimiento"
            value="{{ old('firma_consentimiento') ?? $persona->firma_consentimiento }}" class="form-control">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <label for="fech_registro" class="mr-2">Fecha de registro:</label>
            <span class="input-group-text"> <img src="{{ asset('images/calendar.png') }}" width="15"
                    alt="Fecha de nacimiento"> </span>
        </div>

        <input title="Fecha de registro del paciente" name="fech_registro" id="fech_registro"
            value="{{ old('fech_registro') ?? $persona->fech_registro }}" class="form-control" type="date">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <label for="hora_registro" class="mr-2">Hora de registro:</label>
            <span class="input-group-text"> <img src="{{ asset('images/hora.png') }}" width="15"
                    alt="Fecha de nacimiento"> </span>
        </div>

        <input title="Hora de registro del paciente" name="hora_registro" id="hora_registro"
            value="{{ old('hora_registro') ?? $persona->hora_registro }}" class="form-control" type="time">
    </div>





    <div class="form-group">
        <!-- En el formulario -->
        <button class="btn btn-primary btn-block" type="submit" onclick="this.disabled=true; this.form.submit();">
            {{ $textButton }}
        </button>
    </div>
</form>
<script>
    window.addEventListener("load", function() {
        // Obtiene la fecha y hora actuales
        const currentDate = new Date();
        const year = currentDate.getFullYear();
        const month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
        const day = currentDate.getDate().toString().padStart(2, '0');
        const hours = currentDate.getHours().toString().padStart(2, '0');
        const minutes = currentDate.getMinutes().toString().padStart(2, '0');

        // Asigna la fecha en formato YYYY-MM-DD
        document.getElementById('fech_registro').value = `${year}-${month}-${day}`;
        // Asigna la hora en formato HH:MM
        document.getElementById('hora_registro').value = `${hours}:${minutes}`;
    });
</script>

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

@stop
