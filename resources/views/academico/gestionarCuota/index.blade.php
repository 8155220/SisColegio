@extends('layouts.app')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Cuotas</h3>
	@include('academico.gestionarCuota.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
			<thread>
				<th>#Cod</th>
				<th>#PlanDePago</th>
				<th>Nombre Estudiante</th>
 				<th>$Cuota</th>
				<th>Monto</th>
				<th>Estado</th>
				<th>Opciones</th>
			</thread>
			@foreach($instanciacuota as $cuota)
			@if($cuota->idestado==4)
			<tr class="success" >
			@endif
			@if($cuota->idestado!=4)
			<tr class="warning">
			@endif
				<td>{{$cuota->idcuota}}</td>
				<td>{{$cuota->idplandepago}}</td>
				<td>{{$cuota->nombrecompleto}}</td>
				<td>{{$cuota->numerocuota}}</td>
				<td>{{$cuota->monto}}</td>
				<td>{{$cuota->descripcionestado}}</td>
				<td>
					<a href="{{URL::action('CuotaController@edit',$cuota->idcuota)}}"><button class="btn btn-info">Editar</button></a>
					<a href="{{URL::action('CuotaController@show',$cuota->idplandepago)}}"><button class="btn btn-info">Imprimir</button></a>
				</td>
			</tr>
			@endforeach

			</table>
		</div>
		{{$instanciacuota->render()}}
	</div>
</div>
@endsection
