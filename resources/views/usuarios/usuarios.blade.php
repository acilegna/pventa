@extends('panel.panel')
@section('content')
    @include('notificacion')
    <div class="container-fluid">
        <h3 id="title-prod">Módulo de Usuarios</h3>
        <div class="contenido ">
            <div class="col-lg-6">
                <h5 id="subtitle-prod" class="izquierda">Consulta General de Usuarios</h5>
            </div>
            <div class="col-lg-2">
                <input type="text" name="inputSearch" id="search" class="derecha" placeholder="Usuarios.. " />
            </div>
            <div class="col-lg-4">
                <div class="btn-group derecha"><a href="{{ route('viewAdd') }}" class="btn btn-primary"><i
                            class="fa fa-cube"></i> Alta Usuarios</a> </div>
            </div>
        </div>

        <div class="table-responsive-lg ">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Status</th>

                        <th id="mitable">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbodyusers">

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6">
                            <h5 class="izquierda">Registros encontrados: <span id="total_records"></span></h5>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
