@extends('panel.panel')
@section('content')
    <div class="container-fluid">
        @include('layouts.message')
        @include("notificacion")
        <h3 id="title-prod">Módulo Registro de Cajas</h3>
        <div class="contenido ">
            <div class="col-lg-6">
                <h5 id="subtitle-prod" class="izquierda">Formulario Alta de Cajas</h5>
            </div>
        </div>
        <form action="{{ url('newcaja') }}" method="POST" id="regForm">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control{{ $errors->has('inputCaja') ? ' is-invalid' : '' }}"
                    placeholder="Nombre de la caja" aria-label="Text input with dropdown button" name="inputCaja">
                @if ($errors->has('inputCaja'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('inputCaja') }}</strong>
                    </span>
                @endif
                <select class="custom-select form-control{{ $errors->has('inputStatus') ? ' is-invalid' : '' }}"
                    id="inputStatus" name="inputStatus">
                    <option placeholder="Nombre de la caja"> </option>
                    <option value="1">Activa</option>
                    <option value="0">Inactiva</option>
                </select>
                @if ($errors->has('inputStatus'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('inputStatus') }}</strong>
                    </span>
                @endif
                <div class="btn-group fl-rigth">
                    <button class="btn btn-success" type="submit" name="btn2" value="alta"><i class="fa fa-cube"></i>
                        Guardar</button>
                </div>
                <div class="btn-group fl-rigth ">
                    <a href="{{ route('welcome') }}" class="btn btn-danger"><i class="fa fa-reply"></i> Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
