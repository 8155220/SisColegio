@extends('layouts.app')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Materia <a href="gestionarMateria/create"><button class="btn btn-success">Nuevo</button></a></h3>
	@include('apertura.gestionarMateria.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
			<thread>
				<th>id</th>
				<th>descripcion</th>
			</thread>
			@foreach($instanciamateria as $materia)
			<tr>
				<td>{{$materia->idmateria}}</td>
				<td>{{$materia->descripcion}}</td>
				<td>
					<a href="{{URL::action('MateriaController@edit',$materia->idmateria)}}"><button class="btn btn-info">Editar</button></a>
					<a href="/apertura/gestionarMateria/destroy" data-target="#modal-delete-{{$materia->idmateria}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('apertura.gestionarMateria.modal')
			@endforeach

			</table>
		</div>
		{{$instanciamateria->render()}}
	</div>
</div>
@endsection
