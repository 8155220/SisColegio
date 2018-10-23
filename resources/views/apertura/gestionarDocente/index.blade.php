@extends('layouts.app')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Docentes <a href="gestionarDocente/create"><button class="btn btn-success">Nuevo</button></a></h3>
	@include('apertura.gestionarDocente.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
			<thread>
				<th>ci</th>
				<th>Nombre</th>
				<th>A. Paterno</th>
				<th>A. Materno</th>
				<th>sexo</th>
				<th>Direccion</th>
				<th>Telefono</th>
				<th>Opciones</th>
			</thread>
			@foreach($instanciadocente as $docente)
			<tr>
				<td>{{$docente->ci}}</td>
				<td>{{$docente->nombre}}</td>
				<td>{{$docente->apellidopaterno}}</td>
				<td>{{$docente->apellidomaterno}}</td>
				<td>{{$docente->sexo}}</td>
				<td>{{$docente->direccion}}</td>
				<td>{{$docente->telefono}}</td>
				<td>
					<a href="{{URL::action('DocenteController@edit',$docente->id)}}"><button class="btn btn-info">Editar</button></a>
					<a href="/apertura/gestionarDocente/destroy" data-target="#modal-delete-{{$docente->idpersona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('apertura.gestionarDocente.modal')
			@endforeach

			</table>
		</div>
		{{$instanciadocente->render()}}
	</div>
</div>
@endsection
