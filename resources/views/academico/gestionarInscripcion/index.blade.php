@extends('layouts.app')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Inscripcion <a href="/academico/gestionarInscripcion/create"><button class="btn btn-success">Nuevo</button></a></h3>
	@include('academico.gestionarInscripcion.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
			<thread>
				<th>id</th>
				<th>Administrativo </th>
				<th>Estudiante</th>
				<th>Turno</th>
				<th>Fecha</th>
				<th>Operacion</th>

			</thread>
			@foreach($instanciainscripcion as $inscripcion)
			<tr>

				<td>{{$inscripcion->idinscripcion}}</td>
				<td>{{$inscripcion->nombrecompletoadministrativo}}</td>
				<td>{{$inscripcion->nombrecompletoestudiante}}</td>
				<td>{{$inscripcion->descripcionturno}}</td>
				<td>{{$inscripcion->fecha}}</td>

				<td>
					<a href="{{URL::action('InscripcionController@edit',$inscripcion->idinscripcion)}}"><button class="btn btn-info">Editar</button></a>
					<a href="/academico/gestionarInscripcion/destroy" data-target="#modal-delete-{{$inscripcion->idinscripcion}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('academico.gestionarInscripcion.modal')
			@endforeach

			</table>
		</div>
		{{$instanciainscripcion->render()}}
	</div>
</div>
@endsection
