@extends('layouts.app')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de GradoBloque <a href="gestionarGradoBloque/create"><button class="btn btn-success">Nuevo</button></a></h3>
	@include('apertura.gestionarGradoBloque.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
			<thread>
				<th>Grado </th>
				<th>Bloque </th>
				<th>Cupo Total</th>
				<th>Cupo Restante</th>
			</thread>
			@foreach($instanciagradobloque as $gradobloque)
			<tr>
				<td>{{Auth::getGrado($gradobloque->idgrado)}}</td>
				<td>{{Auth::getBloque($gradobloque->idbloque)}}</td>
				<td>{{$gradobloque->cupototal}}</td>
				<td>{{$gradobloque->cuporestante}}</td>
				<td>
					<a href="{{URL::action('GradoBloqueController@edit',$gradobloque->iddetallegradobloque)}}"><button class="btn btn-info">Editar</button></a>
					<a href="/apertura/gestionarGradoBloque/destroy" data-target="#modal-delete-{{$gradobloque->iddetallegradobloque}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
				</td>
			</tr>
			@include('apertura.gestionarGradoBloque.modal')
			@endforeach

			</table>
		</div>
		{{$instanciagradobloque->render()}}
	</div>
</div>
@endsection
