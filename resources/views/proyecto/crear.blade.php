@extends('adminlte::page')

@section('title', 'CREAR PROYECTOS')

@section('content_header')
    <h1>CREAR PROYECTOS</h1>
@stop

@section('content')
<p>Apartado de crear carreras.</p>
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

        @if(session('error'))
            <script>
                const errorMessage = "{{ session('error') }}";
                alert(errorMessage); // Mostrar una alerta con el mensaje de error
            </script>
        @endif

        <form method="POST" action="{{ route('proyectos.store') }}">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="nombre">Nombre del proyecto</label>
                        <input type="text" name="nombre" class="form-control" id="nombre">
                    </div>
                    <div class="form-group">
                        <label for="maestro">Asesor</label>
                        <input type="text" name="usuario" value="{{ $usuario }}" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="id_grupo">Grupo</label>
                        <select name="id_grupo" class="selectpicker form-group" data-live-search="true" data-actions-box="true" title="Seleccione el grupo" data-width="100%">
                            @foreach($grupo as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <textarea id="descripcion" class="form-control" name="descripcion" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="impacto">Impacto</label>
                        <textarea id="impacto" class="form-control" name="impacto" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="objetivo">Objetivo</label>
                        <textarea id="objetivo" class="form-control" name="objetivo" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="id_categoria">Categoria</label>
                        <select name="id_categoria" class="selectpicker form-group" data-live-search="true"  data-actions-box="true" title="Seleccione la categoria" data-width="100%">
                            @foreach($categoria as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="metodologia">Metodologia</label>
                        <select name="metodologia" class="selectpicker form-group" data-live-search="true"  data-actions-box="true" title="Seleccione la metodologia" data-width="100%">
                            <option value="Cascada">Cascada </option>
                            <option value="Prototipos">Prototipos </option>
                            <option value="Espiral">Espiral </option>
                            <option value="Etapas">Etapas </option>
                            <option value="RAD">RAD </option>
                            <option value="Kanban">Kanban </option>
                            <option value="SCRUM">SCRUM </option>
                            <option value="N/A">N/A </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="patente">Patente</label>
                        <select name="patente" class="form-control">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                        <div id="participantes">
                            <label for="id_categoria">Participantes</label>
                            <button type="button" onclick="agregarParticipante()" class="btn btn-success mt-3 ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg>
                                Agregar Participante
                            </button>
                            <div class="participante">
                                <!-- Campos para el primer participante -->
                                <b>Datos del Participante</b>
                                <div class="container text-center mt-2">
                                    <div class="row">
                                        <div class="col-4">
                                            <input class="form-control" type="text" name="participantes[0][nombre]" placeholder="Nombre">
                                        </div>
                                        <div class="col-4">
                                        <input class="form-control" type="text" name="participantes[0][apellidopaterno]" placeholder="Apellido Paterno">
                                        </div>
                                        <div class="col-4">
                                        <input class="form-control" type="text" name="participantes[0][apellidomaterno]" placeholder="Apellido Materno">
                                        </div>

                                        <!-- Force next columns to break to new line -->
                                        <div class="w-100"></div>

                                        <div class="col-6">
                                        <input class="form-control" type="text" name="participantes[0][matricula]" placeholder="Matrícula">

                                        </div>
                                        <div class="col-6">
                                        <!-- <input class="form-control" type="text" name="participantes[0][sexo]" placeholder="Sexo"> -->
                                        <select name="participantes[0][sexo]" class="form-control">
                                                        <option value="Hombre">Hombre </option>
                                                        <option value="Mujer">Mujer </option>
                                        </select>
                                        </div>
                                    </div>
                                </div>


                                <!-- Otros campos para el primer participante -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        
        
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a  class="btn btn-danger "  href="{{route('proyectos.index')}}">Cancelar</a>
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>

    <script>
        let participanteIndex = 1;

        function agregarParticipante() {
            const participantesDiv = document.getElementById('participantes');
            const newParticipanteDiv = document.createElement('div');
            newParticipanteDiv.className = 'participante';
            newParticipanteDiv.innerHTML = `
            <div class="participante">
                                    <!-- Campos para el primer participante -->
                                    <b>Datos del Participante</b>
                                    <div class="container text-center mt-2">
                                        <div class="row">
                                            <div class="col-4">
                                                <input class="form-control" type="text" name="participantes[${participanteIndex}][nombre]" placeholder="Nombre">
                                            </div>
                                            <div class="col-4">
                                            <input class="form-control" type="text" name="participantes[${participanteIndex}][apellidopaterno]" placeholder="Apellido Paterno">
                                            </div>
                                            <div class="col-4">
                                            <input class="form-control" type="text" name="participantes[${participanteIndex}][apellidomaterno]" placeholder="Apellido Materno">
                                            </div>

                                            <!-- Force next columns to break to new line -->
                                            <div class="w-100"></div>

                                            <div class="col-6">
                                            <input class="form-control" type="text" name="participantes[${participanteIndex}][matricula]" placeholder="Matrícula">

                                            </div>
                                            <div class="col-6">
                                            <!-- <input class="form-control" type="text" name="participantes[${participanteIndex}][sexo]" placeholder="Sexo"> -->
                                            <select name="participantes[${participanteIndex}][sexo]" class="form-control">
                                                            <option value="Hombre">Hombre </option>
                                                            <option value="Mujer">Mujer </option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-danger" type="button" onclick="eliminarParticipante(this)"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg> Eliminar</button>

                                    <!-- Otros campos para el primer participante -->
                                </div>
            `;
            participantesDiv.appendChild(newParticipanteDiv);
            participanteIndex++;
        }

        function eliminarParticipante(button) {
            const participanteDiv = button.parentNode;
            if (participanteIndex > 1) {
                participanteDiv.parentNode.removeChild(participanteDiv);
                participanteIndex--;
            } else {
                alert('No se puede eliminar el primer participante.');
            }
        }
    </script>
@stop