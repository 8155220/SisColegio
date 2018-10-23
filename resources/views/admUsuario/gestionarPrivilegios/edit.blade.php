@extends('layouts.app')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Tipo de Usuario </h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			 	</ul>
			</div>
			@endif
			<div class="register-logo">
					<a><b>Paquetes</b></a>
			</div>
		<div class="register-box-body">

			{{Form::Open(array('action'=>array('PrivilegiosController@destroy',$id),'method'=>'PUT'))}}

			@foreach($instanciamenutipousuario as $menutipousuario)

			<div class="form-group">
				{!!form::label(Auth::obtenerNombreMenu($menutipousuario->idmenu))!!} <br>
				{!!Form::select('estado'.$menutipousuario->idmenu, ['1' => 'Activado', '0' => 'Desactivado'])!!}
			</div>
			@endforeach

			<div class="register-logo">
					<a><b>Casos de Uso</b></a>
			</div>

			@foreach($instanciasubmenutipousuario as $submenutipousuario)

			<div class="form-group">
				{!!form::label(Auth::obtenerNombreSubMenu($submenutipousuario->idsubmenu))!!} <br>
				{!!Form::select('estadosubmenu'.$submenutipousuario->idsubmenu, ['1' => 'Activado', '0' => 'Desactivado'])!!}
			</div>
			@endforeach
				{!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span>Guardar</span>','class'=>'btn btn-primary btn-lg'])!!}
				{!!Form::close()!!}
		</div>


		</div>
	</div>
@endsection
