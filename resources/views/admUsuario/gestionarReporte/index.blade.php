@extends('layouts.app')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado Tipos de Usuario <a href="gestionarTipoUsuario/create"><button class="btn btn-success">Nuevo</button></a></h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
			<thread>
				<th>Nombre</th>
				<th>Seleccione</th>
				<th>Operacion</th>
			</thread>

			<tr>
				<td>Reporte de Gestion</td>
				<td></td>
				<td>
					<a href="/admUsuario/gestionarReporte/gestion"><button class="btn btn-info">Ver</button></a>
					<a href="/admUsuario/gestionarTipoUsuario/destroy"><button class="btn btn-info">Descargar</button></a>

				</td>
			</tr>
			<tr>
				<td>Reporte Por Cursos</td>
				<td>
					<select name="iddetallegradobloque" class="form-control selectpicker" id="iddetallegradobloque" data-live-search="true">
						@foreach ($instanciadetallegradobloque as $detallegradobloque)
						<option value="{{$detallegradobloque->iddetallegradobloque}}">{{$detallegradobloque->descripcion}}</option>
						@endforeach
					</select>
				</td>

				<td>
					<button type="button" name="button2" id="botondetallegradobloque" class='btn btn-info'>Ver</button>
					<a href="/admUsuario/gestionarTipoUsuario/destroy"><button class="btn btn-info">Descargar</button></a>

				</td>
			</tr>
			{!!Form::close()!!}

			</table>
		</div>
	</div>
</div>

@endsection
