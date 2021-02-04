
@extends('panel.panel')
@section('content') 
<div class="container-fluid">
	<h3 id="title-prod">Módulo de Ventas</h3>
	@include("notificacion")
	<div class="contenido">		   	 
	  	<div class="row">  
	  		<div class="col-md-7">  
            	<form action="{{route("buscarProducto")}}" method="post">
            	@csrf
            	
					<div class="form-group">
		                <div class="input-group mb-3">
		                	<input id="codigo" autocomplete="off" required autofocus name="codigo" type="text"
	                               class="form-control"
	                               placeholder="Ingresa el codigo..">		  	

							<div class="input-group-append">
								<button class="btn btn-outline-primary" type="submit"><i class="fa fa-cube"></i> Agregar el Producto</button>
							</div>
						</div>
						 <span> Escribe el codigo presiona Enter  o da clic en el boton</span> 
					</div>
				</form>
            </div>           
            <div class=" col-md-5">
            	<form action='{{route("terminarOCancelarVenta")}}' method="post">
		  		@csrf
	            	<div class="form-group">	            
	                    <div class="input-group mb-3">
	                    	@if(session("productos") !== null)
								<div class="input-group-append">
									<button class="btn btn-outline-danger" type="submit" name="accion" value="cancelar"><i class="fa fa-cube"></i>Cancelar Venta</button>
								</div>
							@endif
		                     		                    
		                </div>
	                </div>
	                             
                </form>          	 
            </div>                           	      	                                                     	 
        </div> 
               	  
    </div>		

	<div class="contenido">
	 	<div class="form-inline">     		 
		  	<div class="btn-group group-left">
		  		<a href="javascript:void(0)"  class="btn btn-primary mb-2" id="busquedas"><i class="fa fa-search"></i>Buscar</a>
		  	</div>	


		  	<div class="btn-group group-left">
		  		<a href="#" class="btn btn-primary mb-2" id="verificadorb"><i class="fa fa-binoculars"></i>Verificador</a>
		  	</div>

		  	<div class="btn-group group-left">
		  		<a href="#" class="btn btn-primary mb-2" id="varios"><i class="fa fa-layer-group"></i>Varios</a>
		  	</div>
		</div>			
	</div>
	 
	 
    @if(session("productos") !== null)
		<div class="table-responsive-lg">
			<table class="table table-striped table-bordered" name="tabla1" id="tabl">
				<thead>
					<tr>			 
						<th style="width:6%;">Codigo</th>
						<th style="width:6%;">Descripcion</th>
						<th style="width:6%;">categoria</th>
						<th style="width:5%;">Precio</th>					     
						<th style="width:2%;">Cantidad</th>
						 
					</tr>
				</thead>
				<tbody id="venta">
		 
				@foreach(session("productos") as $producto)
					@php 						 
						$cantidad_p=$producto->cantidad; 			
						$id_agregado=$producto->id;
						$mayoreos=$producto->mayoreo; 
					@endphp	
					 		 
					@foreach ($sql_mayoreo as  $productos_mayoreo)
						@if($id_agregado== $productos_mayoreo->id_prod)
							@php
								$id_prod=$productos_mayoreo->id_prod;
		                		$precio_mayoreo=$productos_mayoreo->p_mayoreo;
		                		$cantidad_mayoreo=$productos_mayoreo->cantidad;
		                		
		                   	@endphp
	                   	@endif 					                 	 
					@endforeach	
					
					{{--inicio para productos que no se registro mayoreo--}}
					@if ($id_prod != $id_agregado and $total[1]==1)
						@php 
							$cantidad_mayoreo=999; 
							$cantidad_p== $cantidad_mayoreo;
						@endphp						
					@endif
					@if ($id_prod == $id_agregado and $total[1]!=1)
						@php 
							$cantidad_p == $cantidad_mayoreo;
						@endphp						
					@endif
					{{--Fin codigo para productos que no se registro mayoreo--}}

					
		            <tr>
                    	<td style="display:none;">{{$producto->id}}</td>
                        <td>{{$producto->codigo}}</td>
                        <td>{{$producto->descripcion}}</td>
                        <td>{{$producto->categoria}} </td>
 						@if ($cantidad_p>= $cantidad_mayoreo  )
						 	<td style="background-color:#ff0000e8;color: white" >${{number_format($producto->p_venta, 2)}} </td>                     	 
					    @endif
					    @if ($cantidad_p< $cantidad_mayoreo )
						    <td>${{number_format($producto->p_venta, 2)}} </td>	                   
	                    @endif
	               
                        <td>
                        	<form action="{{route('addDelete')}}" method="post">                        	
                        		@csrf    	                         	  
								<a data-toggle="tooltip" data-placement="bottom" title="Aumente la cantidad">
	                            	<button class="btn btn-outline-danger" type="submit" name="elimina" value="elimina"><i class="fa fa fa-minus-square"></i> </button>
	                            </a> 
	                        		{{$producto->cantidad}}
	                        	<a data-toggle="tooltip" data-placement="bottom" title="Aumente la cantidad">
	                            	<button class="btn btn-outline-danger" type="submit" name="accion" value="agrega"><i class="fa fa fa-plus-square"></i> </button>
	                            </a>
	                            <input type="hidden" name="codigo" value="{{$producto->codigo}}"> 
	                            
	                            <input type="hidden" name="indice" value="{{$loop->index}}"> 
                        	</form>
                        </td>    
                                  
                    </tr>
                    	

                   @endforeach	
              				 
				</tbody>			 
                        		
               			 
			</table>
		   	<div class="row col-12">
		   		<div class="col-7">
			   		<div class="float-left d-none d-sm-inline-block">
			    		<strong style="font-size:24px; color:#0032bf">{{$total_produtos}}</strong>
			    		<span style="font-size:19px; color:#0032bf"> Productos en la venta actual</span>
			    		
			    	</div>
			    </div>
		  		<div class="col-5">
		  			<div class="btn-group group-left" >
			  			<a href="#" class="btn btn-primary mb-2 table-mesas" id="cobrar" value="cobra" ><i class="fa fa-layer-group"></i>Cobrar</a>		    
			  		</div>
			   		<div class="btn-group group-left">			  			
			  			<span style="font-size:58px; color:#0032bf"> ${{number_format($total[0] , 2)}}</span>
			  		</div>
		  		</div>
	  		</div>	
	  			   
		</div>
		
         
        @endif
</div>

<!-- Buscar Productos -->
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog"  >
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		        	<span aria-hidden="true">&times;</span>
		        </button>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">          
                    <div class="form-group">
			            <label for="recipient-name" class="col-form-label">Teclea las primeras letras o codigo del producto</label>
			            <input type="text" class="form-control" id="busca" name="busca" placeholder="Buscar" >
			        </div> 
			        <div class="table-responsive">                    
	                    <table class="table table-striped table-bordered">
							<thead>
								<tr>			 
								 <th style="width:5%;">Codigo</th>
								 <th style="width:6%;">Producto</th>							 
								 <th style="width:5%;">Precio</th>
								 <th style="width:6%;">Existencia</th>
								 <th style="width:7%;"id="mitable">Acciones</th>
								</tr>
							</thead>
							<tbody id="tbodyV"></tbody>
							<tfoot style="display:none">
								<tr>
									<th colspan="6"><h5 class="izquierda">Registros encontrados: <span id="total_recordsV"></span></h5></th>
								</tr>
					  		</tfoot>
						</table>
					</div>
             
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Verificador de precios -->
<div class="modal fade" id="verificador" aria-hidden="true">
    <div class="modal-dialog"  >
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Verificador de Precios</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		        	<span aria-hidden="true">&times;</span>
		        </button>
            </div>
            <div class="modal-body">
                <form action="{{route('buscarProducto')}}" method="post" id="verificaForm" name="productForm" class="form-horizontal">                   
                    <div class="form-group">
			            <label for="recipient-name" class="col-form-label">Agrega el codigo del producto</label>
			            <input type="text" class="form-control" id="txtverificador" name="busca" placeholder="Buscar" >
			        </div>                       
	                <div class="col-md-12 text-center">
			        	<h1 id="tbodyVs" style="font-size:50px; color:#0d069c">$0.00</h1>
						<h2 style="display:none" id="total"></h2>
			        </div> 	     
				   	<div class="modal-footer">
				   			
				        <button type="submit" class="btn btn-success" value="0" name="agregarV">Agregar a Venta</button>
				     
				        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeVerificador">Cerrar</button>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>
<!-- **------------------------------------------------------------------------- -->
<!-- Varios -->
<div class="modal fade" id="variosProd" aria-hidden="true">
    <div class="modal-dialog"  >
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Varios Productos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		        	<span aria-hidden="true">&times;</span>
		        </button>
            </div>
            <div class="modal-body">
                <form action="{{route('buscarProducto')}}" method="post" id="verificaForm" name="productForm" class="form-horizontal">  
                @csrf                  
                    <div class="form-group">
			            <label for="recipient-name" class="col-form-label">Agrega el codigo del producto</label>
			            <input type="text" class="form-control" id="txtbusca" name="txtbusca" placeholder="Buscar" >
			        </div> 
			        <div class="form-group">
			            <label for="recipient-name" class="col-form-label">Cantidad</label>
			            <input type="number"class="form-control" id="cantidad" name="cantidad"  >			            
			        </div>  

			        <div class="col-md-12 text-center">
			        	<h1 id="price" style="font-size:50px; color:#0d069c"></h1>
						<h2 style="display:none" id="total"></h2>
						 
						<h3 style="font-size:13px" class="" id="mensaje"></h3>
					   
			        </div>                      
	                   
				   	<div class="modal-footer">				   			
				        <button type="submit" class="btn btn-success" value="1" id="agregarVarios" name="agregarVarios">Agregar a Venta</button>
				     
				        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeVerificador">Cancelar</button>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>

<!-- **------------------------------------------------------------------------- -->
<!-- Cobrar -->
<div class="modal fade" id="modalCobro" aria-hidden="true">
    <div class="modal-dialog"  >
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHead">Cobrar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		        	<span aria-hidden="true">&times;</span>
		        </button>
            </div>
            <div class="modal-body">
            	<div class="container-fluid">
            		<form action='{{route("terminarOCancelarVenta")}}' method="post">
            			@csrf                  
	  					<div class="row">
	    					<div class="col-8">
	    						<div class="row">
		     					 	<div class="col-md-12">
		     					 		<div class="input-group text-center">			            					
			            					<h2 style="font-size:50px;color:#0d069c" class="text-center">$</h2>	   
			            					<h1 id="total_pagar" class="text-center"style="font-size:50px;color:#0d069c"></h1>
			            					<h3 style="font-size:50px;color:#0d069c" class="text-center">.00</h3>			            
			            				</div>					        						 
				        			</div>	
				        		</div>
				        		<div class="row">
		     					 	<div class="col-md-12 text-center">
			            				<div class="input-group">
			            					<span class="input-group-text">Pago con</span>
			            					<span class="input-group-text">$</span>		            		
			            					<input id="pago" class="form-control">					 
										</div>		 
				        			</div>	
				        		</div>
				        		<div class="row">
		     					 	<div class="col-md-12 text-center">
			            				<div class="input-group">
			            					<span class="input-group-text">Su cambio</span>
			            					<span class="input-group-text">$</span>		            		
			            					<input id="cambio" type="number" class="form-control" value="0" readonly="true"> 			 
										</div>		 
				        			</div>	
				        		</div>				        	       
	    					</div>
	   						<div class="col-4">
	   							<button class="btn btn-outline-success" type="submit" name="accion" value="terminar">Terminar Venta</button>	     					    
	     					    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="Btncancela">Cancelar cobro</button>
	     					    <span id="labelt" class="label">Total de artículos</span>
	     					    <h5 id="articulos" class="text-center" style="font-size:20px;color:#0d069c">$0.00</h5>

	    					</div>
	  					</div>
	  					<!-- mandar total de la venta -->
	                	<input type="hidden" name="totalP" value="{{$total[0] }}">              
  					</form>
				</div>              
            </div>
        </div>
    </div>
</div>

     



@endsection  
   	