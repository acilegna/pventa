@extends('panel.panel')
@section('content')
    @include("notificacion")

    <div class="container-fluid">
        <h3 id="title-prod">Módulo de Cajas</h3>
        <div class="contenido ">
            <div class="col-lg-6">
                <h5 id="subtitle-prod" class="izquierda">Consulta General de Productos</h5>
            </div>
            <div class="col-lg-2">
                <input type="text" name="inputSearch" id="search" class="derecha" placeholder="Busqueda.. " />
            </div>
            <div class="col-lg-4">
                <div class="btn-group derecha"><a href="{{ route('viewcaja') }}" class="btn btn-primary"><i
                            class="fa fa-cube"></i> Alta cajas</a> </div>
            </div>
        </div>

        <div class="table-responsive-lg ">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Descripcion</th>
                        <th>Status</th>

                        <th id="mitable">Acciones</th>
                    </tr>
                </thead>
                <tbody id="cajabody">


                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6">
                            <h5 class="izquierda">Registros encontrados: <span id="total_cajas"></span></h5>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
