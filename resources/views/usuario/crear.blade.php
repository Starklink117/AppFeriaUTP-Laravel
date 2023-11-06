@extends('adminlte::page')

@section('title', 'CREAR USUARIOS')

@section('content_header')
    <h1>CREAR USUARIOS</h1>
@stop

@section('content')

<p>Apartado de crear usuarios.</p>
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

        <form method="POST" action="{{ route('usuarios.store') }}">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                </div>
        
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="text" name="email" class="form-control" id="email">
                    </div>
                </div>
        
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                </div>
        
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="confirm-password">Confirmar Password</label>
                        <input type="password" name="confirm-password" class="form-control" id="confirm-password">
                    </div>
                </div>
        
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="roles">Roles</label>
                        <select name="roles" class="form-control">
                            @foreach($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="id_division">División</label>
                            <select name="id_division" class="form-control">
                                @foreach($division as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
        
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a  class="btn btn-danger "  href="{{route('usuarios.index')}}">Cancelar</a>

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
    <script> console.log('Hi!'); </script>
@stop