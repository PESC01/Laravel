<form action="{{ route('informes.store') }}" method="POST" onsubmit="return beforeSubmit()">
    @csrf
    <div class="form-group">
        <label for="persona_id">Persona:</label>
        <select name="persona_id" id="persona_id" class="form-control" required>
            <option value="">Seleccione una persona</option>
            @foreach ($personas as $persona)
                <option value="{{ $persona->id }}">{{ $persona->nombres }} {{ $persona->apellidos }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="contenido">Contenido:</label>
        <textarea name="contenido" id="contenido" class="form-control" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Guardar Informe</button>
    <a href="{{ route('informes.index') }}" class="btn btn-secondary">Cancelar</a>
</form>

<script src="https://cdn.tiny.cloud/1/ufahzq5gvbhh7iqnbwqvlvp8ev1k10y4mx54v5dx6oxf5t96/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#contenido',
        plugins: 'autolink lists link image charmap print preview table',
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help | table',
        content_css: 'default',
        // Esta función se asegura de que el contenido se actualice antes de la validación
        setup: function(editor) {
            editor.on('change', function() {
                tinymce.triggerSave();
            });
        }
    });

    function beforeSubmit() {
        tinymce.triggerSave(); // Fuerza la actualización del textarea
        return true; // Permite que el formulario se envíe
    }
</script>
