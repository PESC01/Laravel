<div class="form-group">
    <label for="nombre_documento">Nombre del Documento:</label>
    <input type="text" name="nombre_documento" class="form-control"
        value="{{ old('nombre_documento') ?? $documentoslegale->nombre_documento }}" required>
</div>
<div class="form-group">
    <label for="descripcion_documento">Descripción del Documento:</label>
    <textarea name="descripcion_documento" class="form-control" required>{{ old('descripcion_documento') ?? $documentoslegale->descripcion_documento }}</textarea>
</div>
<div class="form-group">
    <label for="imagen_documento">Imagen del Documento:</label>
    <input type="file" name="imagen_documento" class="form-control">
    @if ($documentoslegale->imagen_documento)
        <img src="{{ asset('images/' . $documentoslegale->imagen_documento) }}" width="100">
    @endif
</div>
<button type="submit" class="btn btn-primary">{{ $textButton }}</button>
