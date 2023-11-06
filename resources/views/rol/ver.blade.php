@extends('adminlte::page')

@section('title', 'ROLES')

@section('content_header')
    <h1>ROLES</h1>
@stop

@section('content')
    <a class="btn btn-primary" href="{{route('roles.create') }}">Crear Nuevo</a>

    <div class="table-responsive mt-4">
        <table id="rolt" class="table">
            <thead class="table-dark">
                <tr>
                    <th class="text-light" scope="col">ROL</th>
                    <th class="text-light" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{$role->name}}</td>
                    <td>
                            <a class="btn btn-warning" href="{{route('roles.edit', $role->id)}}">Editar</a>

                        <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline">
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
    
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css">


@stop

@section('js')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script> {{-- Es para lo de datatable --}}
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> {{-- Es para lo de datatable --}}
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script> {{-- Es para lo de datatable --}}


{{-- <script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script> --}}

    <script>
        $(document).ready(function() {
            $('#rolt').DataTable( {
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
            // buttons: [
            //                 {
            //                     extend:    'excelHtml5',
            //                     text:      '<i class="fas fa-file-excel"></i> ',
            //                     titleAttr: 'Exportar a Excel',
            //                     className: 'bg-green'
            //                 },
            //                 {
            //                     extend:    'pdfHtml5',
            //                     text:      '<i class="fas fa-file-pdf"></i> ',
            //                     titleAttr: 'Exportar a PDF',
            //                     className: 'bg-red'
            //                 },
            //                 {
            //                     extend:    'print',
            //                     text:      '<i class="fa fa-print"></i> ',
            //                     titleAttr: 'Imprimir',
            //                     className: 'bg-info'
            //                 },
            //                 {
            //                     extend:    'copy',
            //                     text:      '<i class="fa fa-copy"></i> ',
            //                     titleAttr: 'Copiar Tabla',
            //                     className: 'bg-warning'
            //                 },

            //         ]
                } );
        } );

    </script>

@stop
