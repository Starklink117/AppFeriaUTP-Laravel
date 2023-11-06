@extends('adminlte::page')

@section('title', 'CREAR PREGUNTAS')

@section('content_header')
    <h1>CREAR PREGUNTAS</h1>
@stop

@section('content')

<p>Apartado de crear preguntas.</p>
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

            <form method="POST" action="{{ route('preguntas.store') }}">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="descripcion">Pregunta o Descripcion</label>
                            <input type="text" name="descripcion" class="form-control" id="descripcion">
                        </div>
                    </div>
            
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a  class="btn btn-danger "  href="{{route('preguntas.index')}}">Cancelar</a>
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