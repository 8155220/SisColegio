@extends('layouts.app')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Bloques <a href="gestionarBloque/create"><button class="btn btn-success">Nuevo</button></a></h3>
	@include('apertura.gestionarBloque.search')
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
			@foreach($instanciabloque as $bloque)
			<tr>
				<td>{{$bloque->idbloque}}</td>
				<td>{{$bloque->descripcion}}</td>
				<td>
					<a href="{{URL::action('BloqueController@edit',$bloque->idbloque)}}"><button class="btn btn-info">Editar</button></a>
					<a href="/apertura/gestionarBloque/destroy" data-target="#modal-delete-{{$bloque->idbloque}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('apertura.gestionarBloque.modal')
			@endforeach

			</table>
		</div>
		{{$instanciabloque->render()}}
	</div>
</div>
@endsection
