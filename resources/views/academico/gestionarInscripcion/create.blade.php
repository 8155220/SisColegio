@extends('layouts.app')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Inscripcion</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}} </li>
				@endforeach
			 	</ul>
			</div>
			@endif
		<div class="panel-body">

				{!!Form::open(['route'=>'gestionarInscripcion.store','method'=>'POST'])!!}


				<div class="form-group">
					{!!form::label('Turno')!!}
					{!!Form::select('iddetallegestionturno',$turno,null,['id'=>'iddetallegestionturno','placeholder'=>'Selecciona','class'=>'form-control'])!!}
				</div>
				<div class="form-group">
					{!!form::label('Grado')!!}
					{!!Form::select('idgrado',['placeholder'=>'Selecciona'],null,['id'=>'grado','class'=>'form-control'])!!}
				</div>
				<div class="form-group">
					{!!form::label('Bloque')!!}
					{!!Form::select('idbloque',['placeholder'=>'Selecciona'],null,['id'=>'bloque','class'=>'form-control'])!!}
				</div>
				</div>
				<div class="form-group">
					{!!form::label('Cupo')!!}
					{{--{!!Form::label('cuporestante',null,['id'=>'cuporestante','class'=>'form-control'])!!} --}}
					{!!form::text('cuporestante',null,['id'=>'cuporestante','class'=>'form-control','readonly'])!!}
					<button type="button" name="button" id=botoncuporestante class='btn btn-success'>Verificar Cupo</button>
				</div>
				<div class="form-group">
					{!!form::label('Estudiante')!!}
					{!!Form::select('idestudiante',$estudiante,null,['id'=>'estudiante','class'=>'form-control'])!!}
				</div>


					{!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span>Guardar</span>','class'=>'btn-warning btn-sm m-t-10'])!!}

				{!!Form::close()!!}
		</div>


		</div>
	</div>
@endsection
