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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="product_id" id="product_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nombre</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value=""
                                    maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Apellidos</label>
                            <div class="col-sm-12">
                                <input id="apellidos" name="apellidos" required="" placeholder=""
                                    class="form-control"></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Telefono</label>
                            <div class="col-sm-12">
                                <input id="telefono" name="telefono" required="" placeholder=""
                                    class="form-control"></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Direccion</label>
                            <div class="col-sm-12">
                                <input id="direccion" name="direccion" required="" placeholder=""
                                    class="form-control"></input>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Guardar cambios
                                </button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
