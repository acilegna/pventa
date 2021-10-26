@extends('panel.panel')
@section('content')
    <div class="container-fluid">
        <h3 id="title-prod">Módulo de Mayoreo</h3>
        @include("notificacion")
        <div class="contenido ">
            <div class="col-lg-6">
                <h5 id="subtitle-prod" class="izquierda">Formulario para Mayore de Productos</h5>
            </div>
        </div>
        <form action="{{ route('recibe') }}" method="post">
            @csrf
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Producto:</span>
                </div>
                 
                <select class="custom-select" id="descripcion" aria-label="Example select with button addon" name="id">
                    <option value=" "></option>
                   @foreach ($productos as $list)   <option value="{{ $list->id }}"> {{ $list->descripcion }}</option> @endforeach  
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend  ">
                    <span class="input-group-text">Precio Producto</span>
                </div>
                <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="0"
                    name="precioP" id="precioP" disabled="true">
                <div class="input-group-append  ">
                    <span class="input-group-text">.00</span>
                </div>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend  ">
                    <span class="input-group-text">Precio Mayoreo</span>
                </div>
                <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="0"
                    name="precio" required="" step="any" min="1">
                <div class="input-group-append  ">
                    <span class="input-group-text">.00</span>
                </div>
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Cantidad:</span>
                </div>
                <input type="text" class="form-control" name="cantidad" aria-label="Text input with dropdown button"
                    placeholder="0" c pattern="[0-9]+">
            </div>

            <div class="input-group">
                <button class="btn btn-outline-secondary" type="submit" value="0" name="addM"><i class="fa fa-cube"></i> Agregar mayoreo al
                    producto</button>
            </div>
            
        </form>
    </div>
@endsection
