<div class="card mx-auto mt-4" style="width: 18rem;">
    <div class="card-header">
        Resultados de la búsqueda
    </div>
    <ul class="list-group list-group-flush">
        @foreach ($resultados as $persona)
            <li class="list-group-item">
                <div class="media">
                    <div class="media-left">
                        <img src="{{ asset('image/' . $persona->image) }}" style="max-width: 100px; max-height: 100px;"
                            alt="{{ $persona->nombres }}">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><a
                                href="{{ route('personas.show', $persona->id) }}">{{ $persona->nombres }}
                                {{ $persona->apellidos }}</a></h4>
                        <p class="text-muted"><strong>Fecha de Ingreso:</strong>
                            {{ \Carbon\Carbon::parse($persona->fech_registro)->format('d/m/Y') }}</p>
                        <p>
                            <a class="btn btn-danger btn-sm" href="{{route('generatePDF', $persona->id)}}">Descargar informe <i class="fas fa-file-pdf"></i></a>    
                        </p>    
                        </div>
                </div>
            </li>
        @endforeach
    </ul>

    
</div>
@stack('scripts')
<script>
    var ctx = document.getElementById('filtroChart').getContext('2d');

var filtroChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Masculino', 'Femenino'],
        datasets: [{
            data: [{{ $generoStats['Masculino'] }}, {{ $generoStats['Femenino'] }}],
            backgroundColor: ['#36A2EB', '#FF6384'],
        }],
    },
    options: {
        responsive: true,
    },
});
</script>





