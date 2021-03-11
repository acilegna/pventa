@extends('panel.panel')
@section('content')
    <div class="container-fluid">
        <h3 id="title-prod">Módulo Actualización de Cajas</h3>
        <div class="contenido ">
            <div class="col-lg-6">
                <h5 id="subtitle-prod" class="izquierda">Formulario para Actualización de Productos</h5>
            </div>
        </div>
        <form action="{{ url('saveC') }}" method="POST" id="regForm">
            {{ csrf_field() }}
            @foreach ($res as $cajas)
                <input name="inputId" type="hidden" value="{{ $cajas->id }}">

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputDescripcion">Descripcion</label>
                        <input type="text" class="form-control" name="inputDescripcion" id="inputDescripcion"
                            value="{{ $cajas->descripcion }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="stcaja">Status</label>
                        <select name="stcaja" id="stcaja" class='form-control'>
                            <option value="0" @if ($cajas->status == 0) selected @endif>
                                Inactiva
                            </option>
                            <option value="1" @if ($cajas->status == 1) selected @endif>
                                Activa
                            </option>
                        </select>

                    </div>


                </div>
            @endforeach
            <!--BOTONES-->
            <div class="col-lg-12">
                <div class="btn-group fl-rigth"><a href="{{ route('allcaja') }}" class="btn btn-success"><i
                            class="fa fa-reply"></i> Regresar</a> </div>

                <div class="btn-group fl-rigth"> <button class="btn btn-primary" type="submit" name="actualiza"><i
                            class="fa fa-window-close"></i> Actualizar</button></div>
            </div>

        </form>

    </div>

@endsection
