@extends('layouts.app')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Gestion <a href="aperturaGestion/create"><button class="btn btn-success">Nuevo</button></a></h3>
	@include('apertura.aperturaGestion.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
			<thread>
				<th>id</th>
				<th>Descripcion</th>
				<th>Fecha Incio</th>
				<th>Fecha Fin</th>
			</thread>
			@foreach($instanciagestion as $gestion)
			<tr>
				<td>{{$gestion->idgestion}}</td>
				<td>{{$gestion->descripcion}}</td>
				<td>{{$gestion->fechainicio}}</td>
				<td>{{$gestion->fechafin}}</td>
				<td>
					<a href="{{URL::action('GestionController@edit',$gestion->idgestion)}}"><button class="btn btn-info">Editar</button></a>
					<a href="/apertura/aperturaGestion/destroy" data-target="#modal-delete-{{$gestion->idgestion}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('apertura.aperturaGestion.modal')
			@endforeach

			</table>
		</div>
		{{$instanciagestion->render()}}
	</div>
</div>
@endsection
