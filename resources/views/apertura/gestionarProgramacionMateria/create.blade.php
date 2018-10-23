@extends('layouts.app')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva ProgramacionMateria</h3>
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

				{!!Form::open(['route'=>'gestionarProgramacionMateria.store','method'=>'POST'])!!}


				<div class="form-group">
					{!!form::label('Turno')!!}
					{!!Form::select('turno',$turno,null,['id'=>'iddetallegestionturno','placeholder'=>'Selecciona','class'=>'form-control'])!!}
				</div>
				<div class="form-group">
					{!!form::label('Grado')!!}
					{!!Form::select('grado',['placeholder'=>'Selecciona'],null,['id'=>'grado','class'=>'form-control'])!!}
				</div>
				<div class="form-group">
					{!!form::label('Bloque')!!}
					{!!Form::select('bloque',['placeholder'=>'Selecciona'],null,['id'=>'bloque','class'=>'form-control'])!!}
				</div>
				<div class="form-group">
					{!!form::label('Materia')!!}
					{!!Form::select('materia',$materia,null,['id'=>'materia','class'=>'form-control'])!!}
				</div>
				<div class="form-group">
					{!!form::label('Docente')!!}
					{!!Form::select('docente',$docente,null,['id'=>'docente','class'=>'form-control'])!!}
				</div>
				<div class="form-group">
					{!!form::label('Dia')!!}
					{!!Form::select('dia',$dia,null,['id'=>'dia','class'=>'form-control'])!!}
				</div>
				<div class="form-group">
					{!!form::label('Aula')!!}
					{!!Form::select('aula',$aula,null,['id'=>'aula','class'=>'form-control'])!!}
				</div>
				<div class="form-group">
					{!!form::label('Periodo')!!}
					{!!Form::select('periodo',$periodo,null,['id'=>'periodo','class'=>'form-control'])!!}
				</div>

					{!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span>Guardar</span>','class'=>'btn-warning btn-sm m-t-10'])!!}

				{!!Form::close()!!}
		</div>


		</div>
	</div>
@endsection
