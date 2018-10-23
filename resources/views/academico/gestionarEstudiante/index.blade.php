@extends('layouts.app')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Estudiantes <a href="gestionarEstudiante/create"><button class="btn btn-success">Nuevo</button></a></h3>
	@include('academico.gestionarEstudiante.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
			<thread>
				<th>ID</th>
				<th>Nombre Completo</th>
				<th>rude</th>
				<th>Estado</th>
				<th>ci tutor</th>
				<th>Opciones</th>
			</thread>
			@foreach($instanciaestudiante as $estudiante)
			<tr>
				<td>{{$estudiante->idestudiante}}</td>
				<td>{{$estudiante->nombrecompleto}}</td>
				<td>{{$estudiante->rude}}</td>
				<td>{{$estudiante->estadodescripcion}}</td>
				<td>{{$estudiante->idtutor}}</td>
				<td>
					<a href="{{URL::action('EstudianteController@edit',$estudiante->idestudiante)}}"><button class="btn btn-info">Editar</button></a>
					<a href="/academico/gestionarEstudiante/destroy" data-target="#modal-delete-{{$estudiante->idpersona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('academico.gestionarEstudiante.modal')
			@endforeach

			</table>
		</div>
		{{$instanciaestudiante->render()}}
	</div>
</div>
@endsection
