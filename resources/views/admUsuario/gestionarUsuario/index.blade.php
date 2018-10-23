@extends('layouts.app')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Usuarios <a href="gestionarUsuario/create"><button class="btn btn-success">Nuevo</button></a></h3>
	@include('admUsuario.gestionarUsuario.search')
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
			@foreach($instanciausuario as $usuario)
			<tr>
				<td>{{$usuario->ci}}</td>
				<td>{{$usuario->nombre}}</td>
				<td>{{$usuario->apellidopaterno}}</td>
				<td>{{$usuario->apellidomaterno}}</td>
				<td>{{$usuario->sexo}}</td>
				<td>{{$usuario->direccion}}</td>
				<td>{{$usuario->telefono}}</td>
				<td>
					<a href="{{URL::action('UsuarioController@edit',$usuario->id)}}"><button class="btn btn-info">Editar</button></a>
					<a href="/admUsuario/gestionarUsuario/destroy" data-target="#modal-delete-{{$usuario->idpersona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('admUsuario.gestionarUsuario.modal')
			@endforeach

			</table>
		</div>
		{{$instanciausuario->render()}}
	</div>
</div>
@endsection
