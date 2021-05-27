@extends('panel.panel')
@section('content')
    <div class="container-fluid">
        @include('layouts.message')
        <h3 id="title-prod">Módulo Registro de Inventario</h3>
        <div class="contenido ">
            <div class="col-lg-6">
                <h5 id="subtitle-prod" class="izquierda">Formulario Alta de Inventario</h5>
            </div>
        </div>
        <form action="{{ url('saveProduct') }}" method="POST" id="regForm">
            {{ csrf_field() }}
            @foreach ($consulta as $product)
                <input name="inputId" type="hidden" value="{{ $product->id }}">
                <input name="inputHay_hi" type="hidden" value="{{ $product->existencia }}">

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputCodigo">Codigo Producto</label>
                        <input type="number" class="form-control" name="inputCodigo" id="inputCodigo"
                            value="{{ $product->codigo }}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputDescripcion">Descripcion</label>
                        <input type="text" class="form-control" name="inputDescripcion" id="inputDescripcion"
                            value="{{ $product->descripcion }}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputHay">Hay</label>
                        <input type="number" class="form-control" name="inputHay" id="inputHay"
                            value="{{ $product->existencia }}" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputAgregar">Cantidad a Agregar88</label>
                        <input type="number" class="form-control" name="inputAgregar" id="inputAgregar" required>
                    </div>
                </div>

                <!--BOTONES-->
                <div class="col-lg-12">
                    <div class="btn-group fl-rigth"><a href="{{ route('viewFiltro') }}" class="btn btn-success"><i
                                class="fa fa-reply"></i> Regresar</a> </div>

                    <div class="btn-group fl-rigth"> <button class="btn btn-primary" type="submit" name="btn2"
                            value="alta"><i class="fa fa-cube"></i> Guardar</button></div>
                </div>
            @endforeach
        </form>
    </div>


@endsection
