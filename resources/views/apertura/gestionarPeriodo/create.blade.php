@extends('layouts.app')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Periodo</h3>
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

				{!!Form::open(['route'=>'gestionarPeriodo.store','method'=>'POST'])!!}
				<div class="form-group">
				{!!form::label('Selecione El Turno')!!}
				{!! Form::select('iddetallegestionturno',$instanciadetallegestionturno,null,['id'=>'turno','class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!!form::label('Descripcion')!!}
					{!!form::text('descripcion',null,['id'=>'descripcion','class'=>'form-control','placeholder'=>'ingrese una descripcion'])!!}
				</div>
				<div class="form-group">
					{!!form::label('Selecione la hora de inicio')!!}
				  <input type="time" name="horainicio">
				</div>
				<div class="form-group">
					{!!form::label('Selecione la hora de fin')!!}
				  <input type="time" name="horafin">
				</div>

					{!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span>Guardar</span>','class'=>'btn-warning btn-sm m-t-10'])!!}

				{!!Form::close()!!}
		</div>


		</div>
	</div>
@endsection
