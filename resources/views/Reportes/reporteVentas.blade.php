@extends('panel.panel')
@section('content')
    <!-- vISTA PATA GENERAR PDF-->
    <div class="container-fluid">
        <div class="contenido ">
            <h3 id="title-prod">Reporte de ventas</h3>
        </div>
        <form action="{{ route('pdfs') }}" method="POST" id="regForm">
            @csrf
            <section class="content-header">
                <div class="col-xs-12 col-md-3">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" name="datepicker" id="datepicker" readonly>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" name="datepicker_2" id="datepicker_2" readonly>
                    </div>
                </div>

                <div class="col-xs-12 col-md-3">
                    <div class="input-group">
                        <select id="sale_by" name="sale_by" class='form-control'>
                            <option value="opc">Selecciona vendedor </option>
                            @foreach ($usuarios as $user)
                                <option value="{{ $user->id_employee }}">{{ $user->firstname }}</option>
                            @endforeach
                            <option value="all">Todos</option>
                        </select>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" onclick='load(1);'><i
                                    class='fa fa-search'></i></button>
                        </span>
                    </div>
                </div>


                <div class="col-xs-10 col-md-3 ">
                    <div class="btn-group pull-right">
                        <button type="submit" id="imprime" class="btn btn-default"><i class='fa fa-print'>

                            </i> Generar Pdf
                        </button>
                    </div>
                </div>
            </section>
        </form>

        <div class="table-responsive-lg ">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>

                        <th>Factura</th>
                        <th>Fecha</th>
                        <th>Vendedor</th>
                        <th>Neto</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Descripción</th>

                    </tr>
                </thead>
                <tbody id="tbody_re">
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="7">
                            <h5 class="izquierda">Registros encontrados: <span id="tre"></span></h5>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>



@endsection
