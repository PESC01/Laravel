@extends('adminlte::page')

@section('title', 'Lista de proveedores de medicamentos')

@section('content')
    <br>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>
                Listado de proveedores
                <a href="{{ route('proveedores.create') }}">
                    <button class="btn btn-primary">
                        Agregar nuevo proveedor
                    </button>
                </a>
                <a href="{{ route('proveedores.pdf') }}">
                    <button class="btn btn-success">
                        Generar Reporte de Proveedores
                    </button>
                </a>
            </h3>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead style="background-color: rgb(85, 144, 199)">
                        <th>Nombres completos</th>
                        <th>C.I.</th>
                        <th>Celular</th>
                        <th>Opciones</th>
                    </thead>
                    <!--Bucle que recorre todas los ingresos-->
                    @foreach ($proveedores as $proveedor)
                        <tr>
                            <td>
                                {{ $proveedor->nombres }} {{ $proveedor->apellidos }}
                            </td>
                            <td>
                                {{ $proveedor->ci }}
                            </td>
                            <td>{{ $proveedor->celular }}</td>

                            <td>

                                <a href="{{ route('proveedores.edit', ['proveedore' => $proveedor]) }}"
                                    class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                </a>
                                <a href="#"
                                    onclick="event.preventDefault();
                    document.getElementById('delete-proveedor-{{ $proveedor->id }}-form').submit();"
                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                </a>
                                <form id="delete-proveedor-{{ $proveedor->id }}-form"
                                    action="{{ route('proveedores.destroy', ['proveedore' => $proveedor]) }}" method="POST"
                                    class="hidden">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        <!--modal de eliminar-->
                    @endforeach
                </table>
            </div>

        </div>
    </div>
@endsection
