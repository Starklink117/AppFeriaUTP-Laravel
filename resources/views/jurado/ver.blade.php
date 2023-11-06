@extends('adminlte::page')

@section('title', 'JURADOS')

@section('content_header')
    <h1>JURADOS</h1>
@stop

@section('content')

<a class="btn btn-primary" href="{{route('jurados.create') }}">Crear Nuevo</a>
<div class="table-responsive mt-4">
<table id="carrerat" class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre del Usuario</th>
            <th>Proyectos</th>
            <th>Boton</th>
            <th>Qr</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jurados as $jurado)
        <tr>
            <td>{{$jurado->id}}</td>
            <td>{{$jurado->usuario->name ?? 'No asignado o Eliminado'}}</td>
            <td>
                @foreach ($jurado->proyectos as $proyecto)
                    {{$proyecto->nombre}} <br>
                @endforeach
            </td>
            <td>
                @foreach ($jurado->proyectos as $proyecto)
                {{-- {{$proyecto->id}} <br> --}}
                <a href="{{ route('calificar_proyecto', ['id_proyecto' => $proyecto->id]) }}" class="btn btn-primary" name="calificar_button">Calificar Proyecto</a> <br> <hr>

                @endforeach
            </td>
            <td>
                {{-- @foreach ($jurado->proyectos as $proyecto)
                {{$proyecto->id}} <br> 
                {!! QrCode::size(100)->generate(route('calificar_proyecto', ['id_proyecto' => $proyecto->id])) !!} <br>
                {!! QrCode::size(100)->generate('http://localhost:8000/api/calificarapi/7') !!} <br> <hr>

                @endforeach --}}

                {{-- {{$juradosjson}} --}}

                {{-- @foreach ($jurado->proyectos as $proyecto)
                {!! QrCode::size(100)->generate('{{$proyecto->nombre}}') !!}  <br> <hr>
                @endforeach --}}

                @foreach ($jurado->proyectos as $proyecto)
                    {!! QrCode::size(100)->generate($proyecto->nombre) !!} <br> 
                    {{-- <p>{{ $proyecto->nombre }}</p>  --}}
                    <hr>
                @endforeach


            </td>
            <td>
                <a  class="btn btn-warning "  href="{{route('jurados.edit', $jurado->id)}}">Editar</a>

                <form method="POST" action="{{ route('jurados.destroy', $jurado->id) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </form>                
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">

@stop

@section('js')
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
    $('#carrerat').DataTable( {
        language: {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sSearch": "Buscar:",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast":"Último",
                        "sNext":"Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "sProcessing":"Procesando...",
                },
                
            //para usar los botones
            responsive: "true",
        dom: 'Bfrtip',
        buttons: [
                            {
                                extend:    'excel',
                                text:      '<i class="fas fa-file-excel"></i> ',
                                titleAttr: 'Exportar a Excel',
                                className: 'bg-green'
                            },
                            {
                                extend:    'pdf',
                                text:      '<i class="fas fa-file-pdf"></i> ',
                                titleAttr: 'Exportar a PDF',
                                className: 'bg-red',
                                exportOptions: {
                        columns: ':not(:last-child)' // Excluir la última columna al exportar a PDF
                    }
                            },
                            {
                                extend:    'print',
                                text:      '<i class="fa fa-print"></i> ',
                                titleAttr: 'Imprimir',
                                className: 'bg-info'
                            },
                            {
                                extend:    'copy',
                                text:      '<i class="fa fa-copy"></i> ',
                                titleAttr: 'Copiar Tabla',
                                className: 'bg-warning'
                            },
                            {
                                extend:    'csv',
                                text:      '<i class="fa fa-file-csv"></i> ',
                                titleAttr: 'Copiar csv',
                                className: 'bg-success'
                            },
                    ]
    } );

    
});
</script>
@stop