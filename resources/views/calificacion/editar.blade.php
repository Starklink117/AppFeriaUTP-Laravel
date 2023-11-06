@extends('adminlte::page')

@section('title', 'EDITAR CALIFICACION')

@section('content_header')
    <h1>EDITAR CALIFICACION</h1>
@stop

@section('content')
<p>Apartado de editar calificacion.</p>
<div class="card">
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Revise los campos!</strong> Revise los campos que se le solicitan.
            @foreach ($errors->all() as $error)
            <span>{{$error}}</span>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <h3>Calificaciones del proyecto: <b>{{$calificacione->proyecto->nombre}}</b></h3>
        <b>Opciones y Valor</b>
        <p>Excelente: 5, Muy Bien: 4, Bien: 3, Regular: 2, No Aplica: 1</p>



        <form method="POST" action="{{ route('calificaciones.update', $calificacione->id) }}">
            @csrf
            @method('PATCH')
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="promedio">Promedio:</label>
                        <input type="text" name="promedio" class="form-control" id="promedio" value="{{$calificacione->promedio}}" readonly>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="calificacion_1">Calificacion 1</label>
                        <select name="calificacion_1" class="selectpicker form-group" data-live-search="true" data-actions-box="true" title="Seleccione una calificacion" data-width="100%">
                            <option value="5" {{ $calificacione->calificacion_1 == '5' ? 'selected' : '' }}>Excelente </option>
                            <option value="4" {{ $calificacione->calificacion_1 == '4' ? 'selected' : '' }}>Muy Bien </option>
                            <option value="3" {{ $calificacione->calificacion_1 == '3' ? 'selected' : '' }}>Bien </option>
                            <option value="2" {{ $calificacione->calificacion_1 == '2' ? 'selected' : '' }}>Regular </option>
                            <option value="1" {{ $calificacione->calificacion_1 == '1' ? 'selected' : '' }}>No Aplica </option>
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="calificacion_2">Calificacion 2</label>
                        <select name="calificacion_2" class="selectpicker form-group" data-live-search="true" data-actions-box="true" title="Seleccione una calificacion" data-width="100%">
                            <option value="5" {{ $calificacione->calificacion_2 == '5' ? 'selected' : '' }}>Excelente </option>
                            <option value="4" {{ $calificacione->calificacion_2 == '4' ? 'selected' : '' }}>Muy Bien </option>
                            <option value="3" {{ $calificacione->calificacion_2 == '3' ? 'selected' : '' }}>Bien </option>
                            <option value="2" {{ $calificacione->calificacion_2 == '2' ? 'selected' : '' }}>Regular </option>
                            <option value="1" {{ $calificacione->calificacion_2 == '1' ? 'selected' : '' }}>No Aplica </option>
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="calificacion_3">Calificacion 3</label>
                        <select name="calificacion_3" class="selectpicker form-group" data-live-search="true" data-actions-box="true" title="Seleccione una calificacion" data-width="100%">
                            <option value="5" {{ $calificacione->calificacion_3 == '5' ? 'selected' : '' }}>Excelente </option>
                            <option value="4" {{ $calificacione->calificacion_3 == '4' ? 'selected' : '' }}>Muy Bien </option>
                            <option value="3" {{ $calificacione->calificacion_3 == '3' ? 'selected' : '' }}>Bien </option>
                            <option value="2" {{ $calificacione->calificacion_3 == '2' ? 'selected' : '' }}>Regular </option>
                            <option value="1" {{ $calificacione->calificacion_3 == '1' ? 'selected' : '' }}>No Aplica </option>
                        </select>
                    </div>
                </div>
                

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a  class="btn btn-danger "  href="{{route('calificaciones.index')}}">Cancelar</a>
                </div>

            </div>
        </form>
        

    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>


<script>
    function calcularPromedio() {
        const calificacion1 = document.querySelector('select[name="calificacion_1"]').value;
        const calificacion2 = document.querySelector('select[name="calificacion_2"]').value;
        const calificacion3 = document.querySelector('select[name="calificacion_3"]').value;

        const promedio = (parseInt(calificacion1) + parseInt(calificacion2) + parseInt(calificacion3)) / 3;

        document.getElementById('promedio').value = promedio;
    }

    // Agregar el evento onchange a cada menú desplegable
    const selectElements = document.querySelectorAll('select');
    selectElements.forEach(select => {
        select.addEventListener('change', calcularPromedio);
    });

    // Calcular el promedio inicial
    calcularPromedio();
</script>

@stop