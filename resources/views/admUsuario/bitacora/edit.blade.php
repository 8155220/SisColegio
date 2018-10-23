@extends('layouts.app')
@section ('contenido')
@include('alerts.errors')
@include('alerts.success')

	
			<div class	="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-condensed table-hover">
						<thread>
							<th>#Cod</th>
							<th>Operacion</th>
							<th>Tabla</th>
							<th>Campo</th>>
							<th>Valor Antigua</th>>
							<th>Valor Nuevo</th>>
						</thread>
						@foreach($instanciabitacora as $bitacora)
						<tr>

							<td>{{$bitacora->iddetallebitacora}}</td>
							<td>{{$bitacora->operacion}}</td>
							<td>{{$bitacora->tabla}}</td>
							<td>{{$bitacora->campo}}</td>
							<td>{{$bitacora->valorantiguo}}</td>
							<td>{{$bitacora->valornuevo}}</td>
						</tr>
						@endforeach
						</table>
					</div>
					{{$instanciabitacora->render()}}
				</div>
			</div>
@endsection
