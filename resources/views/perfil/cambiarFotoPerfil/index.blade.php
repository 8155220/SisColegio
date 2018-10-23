@extends('layouts.app')
@section ('contenido')
@include('alerts.success')
@if(!empty($persona->imagen))
<div class="form-group">
<img src="/img/users/{{$persona->imagen}}" class="img-circle" width="200" height="200"/>
</div>
@endif
{{--{!!Form::open(['route'=>'cambiarFotoPerfil.store','method'=>'PUT','files'=>true])!!}
{!!Form::model($persona,['route'=>['cambiarFotoPerfil.update'],'method'=>'PUT'])!!}--}}
{!!Form::model($persona,['route'=>['cambiarFotoPerfil.update',$persona->ci],'method'=>'PUT','files'=>true])!!}

	<div class="form-group">
		{!!Form::label('imagen')!!}
		{!!Form::file('imagen')!!}
	</div>
	{!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}

{!!Form::close()!!}

@endsection
