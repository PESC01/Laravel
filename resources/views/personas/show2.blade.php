<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="resident">
            <img src="{{ asset('image/' . $persona->image) }}" alt="{{ $persona->nombres }}" class="img-thumbnail">
            <h2>{{ $persona->nombres }} {{ $persona->apellidos }}</h2>
            <p><b>Cédula de identidad:</b> {{ $persona->ci }}</p>
            <p><b>Nacionalidad:</b> {{ $persona->nombre_nacionalidad }}</p>
            <p><b>Fecha de Nacimiento:</b> {{ $persona->fech_nac }}</p>
            <p><b>Estado civil:</b> {{ $persona->estado_civil }}</p>
            <p><b>Motivo de Ingreso:</b> {{ $persona->motivo_ingreso }}</p>
            <p><b>Fecha y hora de registro:</b>
                {{ \Carbon\Carbon::parse($persona->fech_registro)->format('d-m-Y') }}
                {{ $persona->hora_registro }}
            </p>
            <div class="firma-section">
                <h3>Documento</h3>
                @if ($persona->firma_consentimiento)
                    <a href="{{ asset('firma/' . $persona->firma_consentimiento) }}" target="_blank">
                        @if (strtolower(pathinfo($persona->firma_consentimiento, PATHINFO_EXTENSION)) === 'pdf')
                            <img src="{{ asset('images/pdf-icon.png') }}" alt="Documento PDF" style="max-width:100px;">
                        @else
                            <img src="{{ asset('firma/' . $persona->firma_consentimiento) }}"
                                alt="Documento del paciente" class="firma-img">
                        @endif
                    </a>
                @else
                    <p>No se ha cargado documento.</p>
                @endif
            </div>
        </div>
    </div>
</div>
