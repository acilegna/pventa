@extends('panel.panel')
@section('content')
    <div class="container-fluid">
        <h3 id="title-prod">Módulo de Mayoreo</h3>
        @include("notificacion")
        <div class="contenido ">
            <div class="col-lg-6">
                <h5 id="subtitle-prod" class="izquierda">Modificar Mayoreo de Productos</h5>
            </div>
        </div>
        <form action="{{ route('datosM') }}" method="post">
            @csrf
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Producto:</span>
                </div>

                @foreach ($consulta as $list)
                    <input type="text" class="form-control" value="{{ $list->descripcion }}" name="descripcion"
                        id="descripcion" readonly=true>

            </div>
            <input type="hidden" class="form-control" value="{{ $list->id_prod }}" name="id" id="id">
            <input type="hidden" class="form-control" value="{{ $list->id }}" name="idM" id="idM">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Precio Producto</span>
                </div>
                <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)"
                    value="{{ $list->p_venta }}" name="precioP" id="precioP" disabled="true">
                <div class="input-group-append  ">
                    <span class="input-group-text">.00</span>
                </div>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend  ">
                    <span class="input-group-text">Precio Mayoreo</span>
                </div>
                <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)"
                    value="{{ $list->p_mayoreo }}" name="precio" required="" step="any" min="1">
                <div class="input-group-append  ">
                    <span class="input-group-text">.00</span>
                </div>
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">A partir de</span>
                </div>
                <input type="text" class="form-control" name="cantidad" aria-label="Text input with dropdown button"
                    value="{{ $list->cantidad }}" c pattern="[0-9]+">
            </div>
            @endforeach

            <div class="input-group">
                <button class="btn btn-outline-secondary" type="submit" value="change" name="editM"><i
                        class="fa fa-cube"></i> Guardar cambios</button>
            </div>

        </form>
    </div>
@endsection
