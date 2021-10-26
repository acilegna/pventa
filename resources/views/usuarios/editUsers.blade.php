@extends('panel.panel')
@section('content')
    <div class="container-fluid">
        <h3 id="title-prod">Módulo Actualización de Usuarios</h3>
        <div class="contenido ">
            <div class="col-lg-6">
                <h5 id="subtitle-prod" class="izquierda">Formulario para Actualización de Usuarios</h5>
            </div>
        </div>
        <form action="{{ url('saveUser') }}" method="POST" id="regForm">
            {{ csrf_field() }}
            @foreach ($consultaId as $usuarios)
                <input name="inputId" type="hidden" value="{{ $usuarios->id_employee }}">

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label> {{ $usuarios->firstname }} </label>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" name="inputEmail" id="inputEmail"
                            value="{{ $usuarios->email }}" required="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputHay">Status</label>

                        <select name="status" id="status" class='form-control' required="" aria-required="true">
                            <option value="1" @if ($usuarios->active == 1) selected @endif>Activo</option>
                            <option value="0" @if ($usuarios->active == 0) selected @endif>Inactivo</option>
                        </select>
                    </div>
                </div>


                <!--BOTONES-->
                <div class="col-lg-12">
                    <div class="btn-group fl-rigth"><a href="{{ route('viewFiltro') }}" class="btn btn-success"><i
                                class="fa fa-reply"></i> Regresar</a> </div>
                    <div class="btn-group fl-rigth"> <button class="btn btn-primary" type="submit" name="actualiza"><i
                                class="fa fa-window-close"></i> Actualizar</button></div>

                </div>
            @endforeach
        </form>

    </div>

@endsection
