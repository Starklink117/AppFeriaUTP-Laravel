@extends('adminlte::page')

@section('title', 'DIVISIONES')

@section('content_header')
    <h1>DIVISIONES</h1>
@stop

@section('content')
<a class="btn btn-primary" href="{{route('divisiones.create') }}">Crear Nuevo</a>
<div class="table-responsive mt-4">


<table id="divionest" class="table">
    {{-- <caption>Hola esto es la tabla de divisiones</caption> --}}
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($divisiones as $division)
        <tr>
            <td>{{$division->id}}</td>
            <td>{{$division->nombre}}
                {{-- {!! QrCode::generate('route('divisiones.edit', $division->id)');!!} --}}
                
            </td>
            <td>
                <a  class="btn btn-warning "  href="{{route('divisiones.edit', $division->id)}}">Editar</a>
                <form method="POST" action="{{ route('divisiones.destroy', $division->id) }}" style="display:inline">
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
    $('#divionest').DataTable( {
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
                                className: 'bg-red'
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
} );
</script>

@stop