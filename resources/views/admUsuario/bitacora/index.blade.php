@extends('layouts.app')
@section ('contenido')
@include('alerts.errors')
@include('alerts.success')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3> Bitacora </h3>
	@include('admUsuario.bitacora.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
			<thread>
				<th>#Cod</th>
				<th>Usuario</th>
				<th>CI</th>
				<th>Fecha</th>
				<th>Descripcion</th>>
			</thread>
			@foreach($instanciabitacora as $bitacora)
			<tr>

				<td>{{$bitacora->idbitacora}}</td>
				<td>{{Auth::obtenerNombrePersona($bitacora->idusuario)}}</td>
				<td>{{$bitacora->idusuario}}</td>
				<td>{{$bitacora->fecha}}</td>
				<td>{{$bitacora->descripcion}}</td>
				<td>
					<a href="{{URL::action('BitacoraController@edit',$bitacora->idbitacora)}}"><button class="btn btn-info">Detalles</button></a>
				</td>
			</tr>
			@endforeach

			</table>
		</div>
		{{$instanciabitacora->render()}}
	</div>
</div>
@endsection
