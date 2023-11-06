@extends('adminlte::page')

@section('title', 'CREAR ROLES')

@section('content_header')
    <h1>CREAR ROLES</h1>
@stop

@section('content')

    <p>Apartado de crear roles.</p>
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

            <form action="{{ route('roles.store') }}" method="POST">
                @csrf <!-- Agrega esto para protección contra ataques CSRF -->
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="name">Nombre del rol</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="permission" >Permisos del Rol:</label><br>
                            {{-- @foreach ($permission as $value)
                                <label>
                                    <input type="checkbox" name="permission[]" value="{{ $value->id }}" class="name">
                                    {{ $value->name }}
                                </label><br>
                            @endforeach --}}
                            <select name="permission[]"  class="selectpicker form-group" data-live-search="true" multiple data-actions-box="true" title="Seleccione los permisos" data-width="100%">
                                @foreach($permission as $key => $value)
                                    <option value="{{ $value->name }}">{{ $value->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a  class="btn btn-danger "  href="{{route('roles.index')}}">Cancelar</a>
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
@stop
