@extends('layouts.app')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Estado de cuota</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			 	</ul>
			</div>
			@endif
		<div class="panel-body">

				{!!Form::model($instanciacuota,['route'=>['gestionarCuota.update',$instanciacuota->idcuota],'method'=>'PUT'])!!}


				<div class="form-group">
					{!!form::label('Numero de Cuota')!!}
					{!!form::text('idcuota',null,['id'=>'idcuota','class'=>'form-control','placeholder'=>'Ingrese un monto solo cifras','readonly'])!!}
				</div>

				<div class="form-group">
					{!!form::label(' Estado ')!!} <br>
					{!!Form::select('estado', ['5' => 'Pendiente', '4' => 'Pagado'])!!}
				</div>
					{!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span>Guardar</span>','class'=>'btn-success btn-sm m-t-14'])!!}

				{!!Form::close()!!}
		</div>


		</div>
	</div>
@endsection



















		{{--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Estudiante :{{$estudiante->nombre}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			 	</ul>
			</div>
			@endif

			{!!Form::model($estudiante,['method'=>'PATCH','route'=>['estudiante.update',$estudiante->ci]])!!}

			{{Form::token()}}
			<div class="form-group">



				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" class="form-control" value="{{$estudiante->nombre}}" placeholder="Nombre...">

				<label for="apellidopaterno">Apellido Paterno</label>
				<input type="text" name="apellidopaterno" class="form-control" value="{{$estudiante->apellidopaterno}}"placeholder="Apellido Paterno...">

				<label for="apellidomaterno">Apellido Materno</label>
				<input type="text" name="apellidomaterno" class="form-control" value="{{$estudiante->apellidomaterno}}" placeholder="Apellido Materno...">

				<label for="ci">CI</label>
				<input type="text" name="ci" class="form-control" value="{{$estudiante->ci}}"placeholder="CI...">

				<label for="idrude">rude</label>
				<input type="text" name="idrude" class="form-control" value="{{$estudiante->idrude}}" placeholder="rude...">

				<label for="direccion">direccion</label>
				<input type="text" name="direccion" class="form-control" value="{{$estudiante->direccion}}" placeholder="direccion...">

				<label for="sexo">Sexo</label>
				<br>
				{!! Form::select('sexo', ['m' => 'Masculino', 'f' => 'Femenino'],"{{$estudiante->sexo}" )!!}<br>


				<label for="imagen">Imagen</label>
				<input type="text" name="imagen" class="form-control" value="{{$estudiante->imagen}}"placeholder="imagen ...">

				<label for="fechanacimiento">Fecha de Nacimiento</label><br>
			</div>

				{!! Form::date('fechanacimiento', \Carbon\Carbon::now())!!}
				<div class="form-group">
							<label for="estado">Grado</label>
						<select name="descripcionGrado" class="form-control">
								@foreach($instanciagrado as $grado)
								<option>{{$grado->descripcion}}</option>
								@endforeach
						</select>
				</div>

				<div class="form-group">
					<label for="estado">Estado</label>
						<select name="descripcionEstado" class="form-control">
								@foreach($instanciaestado as $estado)
								<option>{{$estado->descripcion}}</option>
								@endforeach
						</select>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>

			</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection  --}}
