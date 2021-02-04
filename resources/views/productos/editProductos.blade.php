@extends('panel.panel')
@section('content')
<div class="container-fluid">
    <h3 id="title-prod">Módulo Actualización de Productos</h3>
    <div class="contenido ">
        <div class="col-lg-6">
            <h5 id="subtitle-prod" class="izquierda">Formulario para Actualización de Productos</h5>     
        </div>
    </div>        
    <form action="{{url('saveChang')}}" method="POST" id="regForm">
        {{ csrf_field() }}
        @foreach($consulta as $product) 
            <input name="inputId" type="hidden" value="{{$product->id}}">
            <input name="inputHay_hi" type="hidden" value="{{$product->existencia}}">
            <div class="form-row">             
                <div class="form-group col-md-3">
                    <label for="inputCodigo">Codigo Producto</label>
                    <input type="text" class="form-control"  name="inputCodigo" id="inputCodigo" value="{{$product->codigo}}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputDescripcion">Descripcion</label>
                    <input type="text" class="form-control"  name="inputDescripcion" id="inputDescripcion" value="{{$product->descripcion}}">
                </div>
                
                <div class="form-group col-md-3">
                    <label for="inputCategoria">Categoria</label>
                    <input type="text" class="form-control"  name="inputCategoria" id="inputCategoria" value="{{$product->categoria}}"  >
                </div>
                <div class="form-group col-md-3">
                    <label for="inputHay">Existencia</label>
                    <input type="number" class="form-control"  name="inputHay" id="inputHay" value="{{$product->existencia}}" disabled>
                </div>
            </div> 

            <div class="form-row">             
                <div class="form-group col-md-3">
                    <label for="inputPrecioc">Precio Compra</label>
                    <input type="number" class="form-control"  name="inputPrecioc" id="inputPrecioc" value="{{$product->p_compra}}">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputGanancia">Ganancia</label>
                    <input type="text" class="form-control"  name="inputGanancia" id="inputGanancia" value="{{$product->ganancia}}"  >
                </div>
                <div class="form-group col-md-3">
                    <label for="inputPreciov">Precio venta</label>
                    <input type="number" class="form-control"  name="inputPreciov" id="inputPreciov" value="{{$product->p_venta}}" readonly="">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputCategoria">Status:</label>
                    <select name="codcaja" id="codcaja" class='form-control' required="" aria-required="true" > 
                        <option 
                            value="1" 
                            @if($product->status==1)
                                selected
                            @endif
                        >
                            Activo
                        </option> 
                        <option 
                            value="2" 
                            @if($product->status==2)
                                selected
                            @endif
                        >
                            Inactivo
                        </option>    
                    </select>
                    
                </div>
            </div> 
 
            

            <!--BOTONES-->
            <div class="col-lg-12">
                <div class="btn-group fl-rigth"><a href="{{ route('viewFiltro') }}" class="btn btn-success"><i class="fa fa-reply"></i> Regresar</a> </div>  

                <div class="btn-group fl-rigth">  <button class="btn btn-primary" type="submit" name="actualiza"><i class="fa fa-window-close"></i> Actualizar</button></div>     
            </div>
        @endforeach
    </form>

</div>

@endsection