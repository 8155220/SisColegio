@extends('layouts.app')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Administrativos <a href="gestionarAdministrativo/create"><button class="btn btn-success">Nuevo</button></a></h3>
	@include('apertura.gestionarAdministrativo.search')
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
			@foreach($instanciaadministrativo as $administrativo)
			<tr>
				<td>{{$administrativo->ci}}</td>
				<td>{{$administrativo->nombre}}</td>
				<td>{{$administrativo->apellidopaterno}}</td>
				<td>{{$administrativo->apellidomaterno}}</td>
				<td>{{$administrativo->sexo}}</td>
				<td>{{$administrativo->direccion}}</td>
				<td>{{$administrativo->telefono}}</td>
				<td>
					<a href="{{URL::action('AdministrativoController@edit',$administrativo->id)}}"><button class="btn btn-info">Editar</button></a>
					<a href="/apertura/gestionarAdministrativo/destroy" data-target="#modal-delete-{{$administrativo->idpersona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('apertura.gestionarAdministrativo.modal')
			@endforeach

			</table>
		</div>
		{{$instanciaadministrativo->render()}}
	</div>
</div>
@endsection
