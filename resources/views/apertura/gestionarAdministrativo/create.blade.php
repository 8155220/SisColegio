@extends('layouts.app')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Administrativo</h3>
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

				{!!Form::open(['route'=>'gestionarAdministrativo.store','method'=>'POST'])!!}

				<div class="form-group">
					{!!form::label('Nombre')!!}
					{!!form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Digite Nombre'])!!}
				</div>
				<div class="form-group">
					{!!form::label('Apellido Paterno')!!}
					{!!form::text('apellidopaterno',null,['id'=>'apellidopaterno','class'=>'form-control','placeholder'=>'Digite Apellido Paterno'])!!}
				</div>
				<div class="form-group">
					{!!form::label('Apellido Materno')!!}
					{!!form::text('apellidomaterno',null,['id'=>'apellidomaterno','class'=>'form-control','placeholder'=>'Digite Apellido Materno'])!!}
				</div>

				<div class="form-group">
					{!!form::label('Numero Carnet Identidad')!!}
					{!!form::text('ci',null,['id'=>'ci','class'=>'form-control','placeholder'=>'Digite CI'])!!}
				</div>
				<div class="form-group">
					{!!form::label('Telefono')!!}
					{!!form::text('telefono',null,['id'=>'telefono','class'=>'form-control','placeholder'=>'Digite Telefono'])!!}
				</div>
				<div class="form-group">
					{!!form::label('Direccion')!!}
					{!!form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Digite Direccion'])!!}
				</div>

				<div class="form-group">
					{!!form::label(' sexo ')!!} <br>
					{!!Form::select('sexo', ['m' => 'Masculino', 'f' => 'Femenino'])!!}
				</div>
				<div class="form-group">
				{!! form::label('Fecha de nacimiento  ')!!}</br>
				{!! Form::date('fechanacimiento', \Carbon\Carbon::now())!!}
				</div>

				<div class="form-group">
					{!!form::label('email')!!}
					{!!form::text('email',null,['id'=>'email','class'=>'form-control','placeholder'=>'Digite Email'])!!}
				</div>
				<div class="form-group">
					{!!form::label('Profesion')!!}
					{!!form::text('profesion',null,['id'=>'profesion','class'=>'form-control','placeholder'=>'Ingrese la profesion'])!!}
				</div>
					{!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span>Guardar</span>','class'=>'btn-warning btn-sm m-t-10'])!!}

				{!!Form::close()!!}
		</div>


		</div>
	</div>
@endsection



{{--
			{!!Form::open(array('url'=>'inscripcion/estudiante','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}


			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" class="form-control" placeholder="Nombre...">

				<label for="apellidopaterno">Apellido Paterno</label>
				<input type="text" name="apellidopaterno" class="form-control" placeholder="Apellido Paterno...">

				<label for="apellidomaterno">Apellido Materno</label>
				<input type="text" name="apellidomaterno" class="form-control" placeholder="Apellido Materno...">

				<label for="ci">CI</label>
				<input type="text" name="ci" class="form-control" placeholder="CI...">

				<label for="idrude">rude</label>
				<input type="text" name="idrude" class="form-control" placeholder="rude...">

				<label for="direccion">direccion</label>
				<input type="text" name="direccion" class="form-control" placeholder="direccion...">

				<label for="sexo">Sexo</label>
				<br>
				{!! Form::select('sexo', ['m' => 'Masculino', 'f' => 'Femenino'], null, ['placeholder' => 'Escoja un genero'])!!}<br>


				<label for="imagen">Imagen</label>
				<input type="text" name="imagen" class="form-control" placeholder="imagen ...">

				<label for="fechanacimiento">Fecha de Nacimiento</label><br>

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

				{{--<ul class="dropdown-menu">
	    	@foreach($grado as $gra)
	      <li><a href="{{$gra->idgrado}}">{{$gra->descripcion}}</a></li>
	      @endforeach
	      </ul>
				@foreach($grado as $grad)
				<tr>
					<td>{{$grad->descripcion}}</td>
				</tr>
				@endforeach--}}
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
			{!!Form::close()!!}
			--}}
