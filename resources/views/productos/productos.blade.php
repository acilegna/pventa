@extends('panel.panel')
@section('content')
<div class="container-fluid">
    <h3 id="title-prod">Módulo Registro de Productos</h3>
    <div class="contenido ">
        <div class="col-lg-6">
            <h5 id="subtitle-prod" class="izquierda">Formulario Registro de Productos</h5>
        </div>
    </div>
    <form action="{{ url('saveProduct') }}" method="POST" id="regForm">
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputCodigo">Codigo Producto</label>
                <input id="inputCodigo" type="text" class="form-control{{ $errors->has('inputCodigo') ? ' is-invalid' : '' }}" name="inputCodigo" required="" pattern="[0-9]+">
                @if ($errors->has('inputCodigo'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('inputCodigo') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group col-md-4">
                <label for="inputDescripcion">Descripción</label>
                <input type="text" class="form-control{{ $errors->has('inputDescripcion') ? ' is-invalid' : '' }}" id="inputDescripcion" name="inputDescripcion" id="inputDescripcion" placeholder="Descripcion" required="" pattern="[A-Za-z]+">
                @if ($errors->has('inputDescripcion'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('inputDescripcion') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group col-md-4">
                <label for="inputCategoria">Categoria</label>


                <select name="inputCategoria" id="inputCategoria" class='form-control'>
                    <option value="Alimento" selected>Alimento</option>
                    <option value="Automedicacion" >Automedicacion</option>
                    <option value="Bebidas">Bebidas</option>
                    <option value="Botana">Botana</option>                    
                    <option value="Domestico">Domestico</option>  
                    <option value="Dulceria">Dulceria</option>
                    <option value="Harinas">Harinas</option>
                    <option value="Helado">Helado</option>
                    <option value="Higiene">Higiene</option>                    
                    <option value="lacteos">Lacteos</option>
                                   
                </select>

            </div>
        </div>

        <div class="form-row">

            <div class="form-group col-md-4">
                <label for="inputPrecioc">Precio Compra</label>

                <input type="number" class="form-control" name="inputPrecioc" id="inputPrecioc" required="" min="1">
            </div>
            <div class="form-group col-md-4">
                <label for="inputGanancia">Ganancia</label>
                <input type="number" class="form-control" name="inputGanancia" id="inputGanancia" min="1" step="0.5">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPreciov">Precio Venta</label>
                <input type="text" class="form-control" name="inputPreciov" id="inputPreciov" readonly>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputExiste">Existencia</label>
                <input type="text" class="form-control" name="inputExiste" id="inputExiste" placeholder="Existencia" pattern="[0-9]+" required="">
            </div>

            <div class="form-group col-md-6">
                <label for="codcaja">Status</label>
                <select name="codcaja" id="codcaja" class='form-control' required="" aria-required="true">
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                </select>
            </div>

        </div>


        <!--BOTONES-->
        <div class="col-lg-12">
            <div class="btn-group fl-rigth"><a href="{{ route('viewFiltro') }}" class="btn btn-success"><span class="fa fa-mail-reply"></span> Regresar</a> </div>

            <div class="btn-group fl-rigth"> <button class="btn btn-primary" type="submit" name="btn1" value="new"><span class="fa fa-cube"></span> Guardar</button></div>
        </div>
    </form>
</div>
@endsection