@extends('layouts.app')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Grado <a href="gestionarGrado/create"><button class="btn btn-success">Nuevo</button></a></h3>
	@include('apertura.gestionarGrado.search')
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
			@foreach($instanciagrado as $grado)
			<tr>
				<td>{{$grado->idgrado}}</td>
				<td>{{$grado->descripcion}}</td>
				<td>
					<a href="{{URL::action('GradoController@edit',$grado->idgrado)}}"><button class="btn btn-info">Editar</button></a>
					<a href="/apertura/gestionarGrado/destroy" data-target="#modal-delete-{{$grado->idgrado}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('apertura.gestionarGrado.modal')
			@endforeach

			</table>
		</div>
		{{$instanciagrado->render()}}
	</div>
</div>
@endsection
