@extends('layouts.app')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Estudiante</h3>
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

				{!!Form::open(['route'=>'gestionarEstudiante.store','method'=>'POST'])!!}

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
					{!!form::label('Rude')!!}
					{!!Form::number('rude',null,['id'=>'rude','class'=>'form-control'])!!}
				</div>
				<div class="form-group">
					{!!form::label('Tutor')!!}
					{!!Form::select('tutor',$tutor,['id'=>'rude','class'=>'form-control'])!!}
				</div>
					{!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span>Guardar</span>','class'=>'btn-warning btn-sm m-t-10'])!!}

				{!!Form::close()!!}
		</div>


		</div>
	</div>
@endsection
