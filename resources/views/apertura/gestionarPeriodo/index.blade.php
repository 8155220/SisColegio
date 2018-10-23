@extends('layouts.app')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Periodo <a href="gestionarPeriodo/create"><button class="btn btn-success">Nuevo</button></a></h3>
	@include('apertura.gestionarPeriodo.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
			<thread>
				<th>id</th>
				<th>descripcion</th>
				<th>Hora Inicio</th>
				<th>Hora Fin</th>
				<th>Turno</th>
			</thread>
			@foreach($instanciaperiodo as $periodo)
			<tr>
				<td>{{$periodo->idperiodo}}</td>
				<td>{{$periodo->descripcion}}</td>
				<td>{{$periodo->horainicio}}</td>
				<td>{{$periodo->horafin}}</td>
				<td>{{$periodo->descripcionturno}}</td>
				<td>
					<a href="{{URL::action('PeriodoController@edit',$periodo->idperiodo)}}"><button class="btn btn-info">Editar</button></a>
					<a href="/apertura/gestionarPeriodo/destroy" data-target="#modal-delete-{{$periodo->idperiodo}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('apertura.gestionarPeriodo.modal')
			@endforeach

			</table>
		</div>
		{{$instanciaperiodo->render()}}
	</div>
</div>
@endsection
