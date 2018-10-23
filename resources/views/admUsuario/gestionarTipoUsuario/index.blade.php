@extends('layouts.app')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado Tipos de Usuario <a href="gestionarTipoUsuario/create"><button class="btn btn-success">Nuevo</button></a></h3>
	@include('admUsuario.gestionarTipoUsuario.search')
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

			@foreach($instanciatipousuario as $tipousuario)
			<tr>
				<td>{{$tipousuario->idtipousuario}}</td>
				<td>{{$tipousuario->descripcion}}</td>
				<td>
					<a href="{{URL::action('TipoUsuarioController@edit',$tipousuario->idtipousuario)}}"><button class="btn btn-info">Editar</button></a>
					<a href="/admUsuario/gestionarTipoUsuario/destroy" data-target="#modal-delete-{{$tipousuario->idtipousuario}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('admUsuario.gestionarTipoUsuario.modal')
			@endforeach

			</table>
		</div>
		{{$instanciatipousuario->render()}}
	</div>
</div>
@endsection
