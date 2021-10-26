@extends('panel.panel')
@section('content')
<div class="container-fluid">
	<h3 id="title-prod">Módulo de Mayoresos</h3>
	<div class="contenido ">
	@include("notificacion")
		<div class="col-lg-6">
			<h5 id="subtitle-prod" class="izquierda"> Mayoreos</h5>
		</div>
		<div class="col-lg-2">
			<input type="text" name="inputSearch" id="search" class="derecha" placeholder="Busqueda.. " />
		</div>
		<div class="col-lg-4">
			<div class="btn-group derecha"><a href="{{route('newM')}}" class="btn btn-primary"><i class="fa fa-cube"></i> Agregar Mayoreo</a> </div>
		</div>
	</div>

	<div class="table-responsive-lg ">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Producto</th>
					<th>Precio Producto </th>
					<th>Precio Mayoreo</th>
					<th>Cantidad</th>
					<th id="btns">Acciones</th>
				</tr>
			</thead>
			<tbody id="tbodymayoreos">

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