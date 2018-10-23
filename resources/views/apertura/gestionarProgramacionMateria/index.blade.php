@extends('layouts.app')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de ProgramacionMateria <a href="gestionarProgramacionMateria/create"><button class="btn btn-success">Nuevo</button></a></h3>
	@include('apertura.gestionarProgramacionMateria.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
			<thread>
				<th>id</th>
				<th>Detalle Grado</th>
				<th>Materia</th>
				<th>Docente</th>
				<th>Operacion</th>

			</thread>
			@foreach($instanciaprogramacionmateria as $programacionmateria)
			<tr>
				{{--<td>{{$programacionmateria->idprogramacionmateria}}</td>
				<td>{{Auth::getDetalleGradoBloque($programacionmateria->iddetallegradobloque)}}</td>
				<td>{{Auth::getMateria($programacionmateria->idmateria)}}</td>
				<td>{{Auth::getDocente($programacionmateria->iddocente)}}</td>
				<td>{{Auth::getDetalleGestionTurno($programacionmateria->iddetallegestionturno)}}</td>--}}
				<td>{{$programacionmateria->idprogramacionmateria}}</td>
				<td>{{$programacionmateria->gradocompleto}}</td>
				<td>{{$programacionmateria->descripcionmateria}}</td>
				<td>{{$programacionmateria->nombrecompletodocente}}</td>

				<td>
					<a href="{{URL::action('ProgramacionMateriaController@edit',$programacionmateria->idprogramacionmateria)}}"><button class="btn btn-info">Editar</button></a>
					<a href="/apertura/gestionarProgramacionMateria/destroy" data-target="#modal-delete-{{$programacionmateria->idprogramacionmateria}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('apertura.gestionarProgramacionMateria.modal')
			@endforeach

			</table>
		</div>
		{{$instanciaprogramacionmateria->render()}}
	</div>
</div>
@endsection
