@extends('layouts.app')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Tutors <a href="gestionarTutor/create"><button class="btn btn-success">Nuevo</button></a></h3>
	@include('academico.gestionarTutor.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
			<thread>
				<th>ci</th>
				<th>Nombre</th>
				<th>Estado</th>
				<th>CI</th>
				<th>Opciones</th>
			</thread>
			@foreach($instanciatutor as $tutor)
			<tr>
				<td>{{$tutor->ci}}</td>
				<td>{{$tutor->nombrecompleto}}</td>
				<td>{{$tutor->estadodescripcion}}</td>
				<td>{{$tutor->idpersona}}</td>
				<td>
					<a href="{{URL::action('TutorController@edit',$tutor->idtutor)}}"><button class="btn btn-info">Editar</button></a>
					<a href="/academico/gestionarTutor/destroy" data-target="#modal-delete-{{$tutor->idpersona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('academico.gestionarTutor.modal')
			@endforeach

			</table>
		</div>
		{{$instanciatutor->render()}}
	</div>
</div>
@endsection
