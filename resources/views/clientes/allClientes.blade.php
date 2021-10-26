@extends('panel.panel')
@section('content')


<div class="container-fluid">
    <h3 id="title-prod">Módulo de Clientes</h3>
    <div class="contenido ">
        <!-- Msg validacion-->
        <div class="alert alert-success d-none" id="msg_div">
            <span id="res_message"> </span>
        </div>

        <div class="col-lg-6">
            <h5 id="subtitle-prod" class="izquierda">Consulta General de Clientes</h5>
        </div>

        <div class="col-lg-6">
            <a class="btn btn-success derecha" href="javascript:void(0)" id="createNewProduct">Nuevo Cliente</a>
        </div>
    </div>
    <h3 style="font-size:13px" class="" id="mensaje"></h3>

    <div class="table-responsive-lg ">
        <table class="table table-striped table-bordered data-table" style="width: 100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Telefono</th>
                    <th>Dirección</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>



<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="text-success" id='result'>
        @if(Session::has('message'))
        {{Session::get('message')}}
        @endif
    </div>

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
           
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> 
                <form id="productForm" name="productForm" class="form-horizontal" method="post" action="javascript:void(0)">

                    @csrf


                    <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nombre" name="nombre">

                            @if($errors->has('nombre'))
                            <small class="form-text text-danger">{{ $errors->first('nombre') }}</small>

                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Apellidos</label>
                        <div class="col-sm-12">
                            <input id="apellidos" name="apellidos" class="form-control">
                            @if ($errors->any('apellidos'))
                            <small class="form-text text-danger">{{ $errors->first('apellidos') }}</small>
                            <p>Hay errores!</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Telefono</label>
                        <div class="col-sm-12">
                            <input id="telefono" name="telefono" class="form-control">
                            @if ($errors->any('telefono'))
                            <small class="form-text text-danger">{{ $errors->first('telefono') }}</small>
                            <p>Hay errores!</p>
                            @endif

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Direccion</label>
                        <div class="col-sm-12">
                            <input id="direccion" name="direccion" class="form-control">
                            @if ($errors->any('direccion'))
                            <small class="form-text text-danger">{{ $errors->first('ndireccion') }}</small>
                            <p>Hay errores!</p>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12">
                            <button class="btn btn-outline-success" type="submit" style="display:none" value="entrada" id="saveBtns">Guardar
                            </button>
                            <button type="submit" class="btn btn-primary" id="saveBtnn">Nuevo </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection