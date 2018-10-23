@extends('layouts.app')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Detalles Gestion </h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			 	</ul>
			</div>
			@endif
			<table class="table table-striped table-bordered table-condensed table-hover">
			<thread>
				<th>Turno</th>
			</thread>
			@foreach($instanciagestionturno as $gestionturno)
			<tr>
				@if($gestionturno->idturno==1)
				<td>Turno Mañana</td>
				@endif
				@if($gestionturno->idturno==2)
				<td>Turno Tarde</td>
				@endif
				@if($gestionturno->idturno==3)
				<td>Turno Noche</td>
				@endif
			</tr>
			@endforeach
			</table>
			<div class="panel-body">

					{!!Form::model($instanciagestion,['route'=>['aperturaGestion.update',$instanciagestion->idgestion],'method'=>'PUT'])!!}

					<div class="form-group">
						{!!form::label('Descripcion')!!}
						{!!form::text('descripcion',null,['id'=>'descripcion','class'=>'form-control','placeholder'=>'Digite Nombre'])!!}
					</div>
					<div class="form-group">
						{!!form::label('Estado')!!}
						{!!Form::select('idestado', ['1' => 'Activo', '2' => 'Inactivo'], null)!!}
					</div>

						{!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span>Guardar</span>','class'=>'btn-warning btn-sm m-t-10'])!!}

					{!!Form::close()!!}
			</div>
		</div>
	</div>
@endsection
