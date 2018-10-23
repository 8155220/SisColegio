@extends('layouts.app')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva GradoBloque</h3>
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

				{!!Form::open(['route'=>'gestionarGradoBloque.store','method'=>'POST'])!!}

				<div class="form-group">
				{!!form::label('Selecione El Turno')!!}
				{!! Form::select('iddetallegestionturno',$instanciadetallegestionturno,null,['id'=>'turno','class'=>'form-control']) !!}
				</div>
				<div class="form-group">
				{!!form::label('Selecione El Grado')!!}
				{!! Form::select('idgrado',$instanciagrado,null,['idgrado'=>'descripcion','class'=>'form-control']) !!}
				</div>
				<div class="form-group">
				{!!form::label('Selecione El Bloque')!!}
				{!! Form::select('idbloque',$instanciabloque,null,['idbloque'=>'descripcion','class'=>'form-control']) !!}
				</div>
				<div class="form-group">
				{!!form::label('Ingrese el cupo total')!!}
				{!!Form::number('cupototal',null,['id'=>'capacidad','class'=>'form-control'])!!}
				</div>
					{!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span>Guardar</span>','class'=>'btn-warning btn-sm m-t-10'])!!}

				{!!Form::close()!!}
		</div>


		</div>
	</div>
@endsection
