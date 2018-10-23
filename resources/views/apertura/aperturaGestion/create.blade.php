@extends('layouts.app')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Gestion</h3>
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

				{!!Form::open(['route'=>'aperturaGestion.store','method'=>'POST'])!!}

				<div class="form-group">
					{!!form::label('Descripcion')!!}
					{!!form::text('descripcion',null,['id'=>'descripcion','class'=>'form-control','placeholder'=>'ingrese una descripcion'])!!}
				</div>
				<div class="form-group">
					{!! form::label('Fecha de Inicio  ')!!}</br>
					{!! Form::date('fechainicio', \Carbon\Carbon::now())!!}
				</div>
				<div class="form-group">
					{!! form::label('Fecha de Fin  ')!!}</br>
					{!! Form::date('fechafin', \Carbon\Carbon::now())!!}
				</div>
				<div class="form-group">
					{!! form::label('Turno Mañana ')!!}<span>.....</span>
					{!!Form::checkbox('turnomañana', 'value', false)!!}
				</div>
				<div class="form-group">
					{!! form::label('Turno Tarde ')!!}<span>.....</span>
					{!!Form::checkbox('turnotarde', 'value', false)!!}
				</div>
				<div class="form-group">
					{!! form::label('Turno Noche ')!!}<span>.....</span>
					{!!Form::checkbox('turnonoche', 'value', false)!!}
				</div>
					{!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span>Guardar</span>','class'=>'btn-warning btn-sm m-t-10'])!!}

				{!!Form::close()!!}
		</div>


		</div>
	</div>
@endsection
