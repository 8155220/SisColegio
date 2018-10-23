@extends('layouts.app')
@section ('contenido')
@include('alerts.success')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Seleccione un Tipo de Usuario <a href="gestionarUsuario/create"></a></h3>
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
					<a href="{{URL::action('PrivilegiosController@edit',$tipousuario->idtipousuario)}}"><button class="btn btn-info">Editar</button></a>
				</td>
			</tr>
			@endforeach

			</table>
		</div>
		{{$instanciatipousuario->render()}}
	</div>
</div>
@endsection
