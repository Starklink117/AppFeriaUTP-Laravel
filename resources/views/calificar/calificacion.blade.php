
@extends('adminlte::page')

@section('title', 'Calificar Proyectos')

@section('content_header')
    <h1>Calificar Proyecto: <b>{{$nombreProyecto}}</b> </h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Revise los campos!</strong> Revise los campos que se le solicitan.
            @foreach ($errors->all() as $error)
            <span>{{$error}}</span>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <p>Evalua en los siguientes puntos en base a tu criterio:</p>
        <b>Opciones y Valor</b>
        <p>Excelente: 5, Muy Bien: 4, Bien: 3, Regular: 2, No Aplica: 1</p>



        <form method="POST" action="{{ route('calificar.store', ['id_proyecto' => $id_proyecto]) }}">
            @csrf
            <div class="row">

                <input type="hidden" name="id_proyecto" value="{{$id_proyecto}}">

                @foreach($preguntas as $pregunta)
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                            <label for="calificacion_{{ $pregunta->id }}">{{ $pregunta->descripcion }}:</label>
                            <select name="calificacion_{{ $pregunta->id }}" class="form-control" onchange="calcularPromedio()">
                                <option value="">Seleccione una opcion</option>
                                <option value="5">Excelente</option>
                                <option value="4">Muy Bien </option>
                                <option value="3">Bien </option>
                                <option value="2">Regular </option>
                                <option value="1">No Aplica </option>
                            </select>
                    </div>
                </div>
                @endforeach

                {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="button" class="btn btn-primary" onclick="calcularPromedio()">Calcular Promedio</button>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="resultado">Resultado:</label>
                        <input type="text" name="resultado" class="form-control" id="resultado" readonly>
                    </div>
                </div> --}}

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="resultado">Resultado:</label>
                        <input type="text" name="resultado" class="form-control" id="resultado" readonly>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a  class="btn btn-danger "  href="{{route('dashboard')}}">Cancelar</a>
                </div>
            </div>
        </form>

        
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">


@stop

@section('js')

{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        function calcularPromedio() {
            const totalPreguntas = {{ count($preguntas) }}; // Obtén el total de preguntas desde PHP

            let sumaCalificaciones = 0;
            let preguntasRespondidas = 0; // Contador para verificar si alguna pregunta ha sido respondida

            for (let i = 1; i <= totalPreguntas; i++) {
                const calificacionElement = document.querySelector(`select[name="calificacion_${i}"]`);
                if (calificacionElement && calificacionElement.value) {
                    const calificacion = parseInt(calificacionElement.value);
                    sumaCalificaciones += calificacion;
                    preguntasRespondidas++;
                }
            }

            // Verificar si al menos una pregunta ha sido respondida
            if (preguntasRespondidas > 0) {
                const promedio = sumaCalificaciones / preguntasRespondidas;
                document.getElementById('resultado').value = promedio;
            } else {
                document.getElementById('resultado').value = ""; // Si no hay preguntas respondidas, el resultado se restablece
            }
        }

        // Agregar el evento onchange a cada menú desplegable
        const selectElements = document.querySelectorAll('select');
        selectElements.forEach(select => {
            select.addEventListener('change', calcularPromedio);
        });
    });
</script> --}}

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function calcularPromedio() {
            let sumaCalificaciones = 0;
            let preguntasRespondidas = 0; // Contador para verificar si alguna pregunta ha sido respondida

            const selectElements = document.querySelectorAll('select');
            selectElements.forEach(select => {
                if (select.value) {
                    const calificacion = parseInt(select.value);
                    sumaCalificaciones += calificacion;
                    preguntasRespondidas++;
                }
            });

            // Verificar si al menos una pregunta ha sido respondida
            if (preguntasRespondidas > 0) {
                const promedio = sumaCalificaciones / preguntasRespondidas;
                document.getElementById('resultado').value = promedio;
            } else {
                document.getElementById('resultado').value = ""; // Si no hay preguntas respondidas, el resultado se restablece
            }
        }

        // Agregar el evento onchange a cada menú desplegable
        const selectElements = document.querySelectorAll('select');
        selectElements.forEach(select => {
            select.addEventListener('change', calcularPromedio);
        });
    });
</script>



@stop
