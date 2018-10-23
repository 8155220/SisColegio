@extends('layouts.app')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Aula </h3>
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

				{!!Form::model($instanciaaula,['route'=>['gestionarAula.update',$instanciaaula->idaula],'method'=>'PUT'])!!}

				<div class="form-group">
					{!!form::label('Descripcion')!!}
					{!!form::text('descripcion',null,['id'=>'descripcion','class'=>'form-control','placeholder'=>'Ingrese Descripcion'])!!}
				</div>
				<div class="form-group">
					{!!form::label('Capacidad')!!}
					{!!Form::number('capacidad',null,['id'=>'capacidad','class'=>'form-control'])!!}

				</div>

					{!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span>Guardar</span>','class'=>'btn-warning btn-sm m-t-10'])!!}

				{!!Form::close()!!}
		</div>


		</div>
	</div>
@endsection
