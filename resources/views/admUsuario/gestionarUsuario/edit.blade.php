@extends('layouts.app')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Usuario</h3>
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

				{!!Form::model($usuario,['route'=>['gestionarUsuario.update',$usuario->id],'method'=>'PUT'])!!}

				<div class="form-group">
					{!!form::label('Nombre')!!}
					{!!form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Digite Nombre'])!!}
				</div>
				<div class="form-group">
					{!!form::label('Apellido Paterno')!!}
					{!!form::text('apellidopaterno',null,['id'=>'apellidopaterno','class'=>'form-control','placeholder'=>'Digite Nombre'])!!}
				</div>
				<div class="form-group">
					{!!form::label('Apellido Materno')!!}
					{!!form::text('apellidomaterno',null,['id'=>'apellidomaterno','class'=>'form-control','placeholder'=>'Digite Nombre'])!!}
				</div>

				<div class="form-group">
					{!!form::label('Numero Carnet Identidad')!!}
					{!!form::text('ci',null,['id'=>'ci','class'=>'form-control','placeholder'=>'Digite Nombre','readonly'])!!}
				</div>

				<div class="form-group">
					{!!form::label(' sexo ')!!}
					{!!Form::select('sexo', ['m' => 'Masculino', 'f' => 'Femenino'])!!}
				</div>
				<div class="form-group">
				{!! form::label('Fecha de nacimiento  ')!!}</br>
				{!! Form::date('fechanacimiento', \Carbon\Carbon::now())!!}
				<div class="form-group">
					{!!form::label('email')!!}
					{!!form::text('email',null,['id'=>'email','class'=>'form-control','placeholder'=>'Digite Nombre','readonly'])!!}
				</div>
				</div>
					<div class="form-group">
						{!!form::label('Selecione el tipo de usuario')!!}
					{!! Form::select('idtipousuario',$tipousuario,null,['idtipousuario'=>'descripcion','class'=>'form-control','readonly']) !!}

					</div>

					{!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span>Guardar</span>','class'=>'btn-warning btn-sm m-t-10'])!!}

				{!!Form::close()!!}
		</div>


		</div>
	</div>
@endsection
