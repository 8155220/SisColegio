@extends('layouts.app')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Aulas <a href="gestionarAula/create"><button class="btn btn-success">Nuevo</button></a></h3>
	@include('apertura.gestionarAula.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
			<thread>
				<th>id</th>
				<th>Descripcion</th>
				<th>Capacidad</th>
			</thread>
			@foreach($instanciaaula as $aula)
			<tr>
				<td>{{$aula->idaula}}</td>
				<td>{{$aula->descripcion}}</td>
				<td>{{$aula->capacidad}}</td>
				<td>
					<a href="{{URL::action('AulaController@edit',$aula->idaula)}}"><button class="btn btn-info">Editar</button></a>
					<a href="/apertura/gestionarAula/destroy" data-target="#modal-delete-{{$aula->idaula}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('apertura.gestionarAula.modal')
			@endforeach

			</table>
		</div>
		{{$instanciaaula->render()}}
	</div>
</div>
@endsection
