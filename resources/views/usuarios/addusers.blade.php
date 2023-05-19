@extends('panel.panel')
@section('content')
    <div class="container-fluid">
        <h3 id="title-prod">Módulo Alta de Usuarios</h3>
        <div class="contenido ">
            <div class="col-lg-6">
                <h5 id="subtitle-prod" class="izquierda">Formulario para Alta de Usuarios</h5>
            </div>
        </div>
        <form action="{{ url('addUsers') }}" method="POST" id="regForm">
            {{ csrf_field() }}



            <div class="form-row">

                <div class="form-group col-md-3">
                    <label for="inputUser">Usuario</label>
                    <input type="text" class="form-control" name="inputUser" id="inputUser" value="" required="">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputApe">Apellido</label>
                    <input type="text" class="form-control" name="inputApe" id="inputApe" value=" " required="">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" name="inputEmail" id="inputEmail" value=" " required="">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputEmail">Contraseña</label>
                    <input type="password" class="form-control" name="inputPass" id="inputPass" value="" required="">
                </div>
            </div>


            <!--BOTONES-->
            <div class="col-lg-12">
                <div class="btn-group fl-rigth"><a href="{{ route('viewUser') }}" class="btn btn-success"><i
                            class="fa fa-reply"></i> Regresar</a> </div>
                <div class="btn-group fl-rigth"> <button class="btn btn-primary" type="submit" name="actualiza"><i
                            class="fa fa-window-close"></i> Agregar</button></div>

            </div>

        </form>

    </div>
@endsection
