@extends('layouts.app')
@section ('contenido')
@include('alerts.errors')
@include('alerts.success')
<body class="hold-transition register-page">
<div class="register-box">
		<div class="register-logo">
				<a><b>Cambiar Contraseña</b></a>
		</div>

		@if (count($errors) > 0)
				<div class="alert alert-danger">
						<strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
						<ul>
								@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
								@endforeach
						</ul>
				</div>
		@endif

		<div class="register-box-body">

			{{--{!!Form::open(['route'=>'gestionarUsuario.store','method'=>'POST'])!!}--}}
			{!!Form::open(['route'=>'cambiarPassword.store','method'=>'POST'])!!}

						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							{!!Form::password('oldpassword', ['class' => 'form-control', 'placeholder'=>"Antigua Contraseña"])!!}
						</div>
						<div class="form-group">
							{!!Form::password('newpassword', ['class' => 'form-control', 'placeholder'=>"Nueva Contraseña"])!!}
						</div>
						<div class="form-group">
							{!!Form::password('newpassword2', ['class' => 'form-control', 'placeholder'=>"Confirme Contraseña"])!!}
						</div>


						{!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span>Guardar</span>','class'=>'btn btn-primary btn-block btn-flat'])!!}

				{!!Form::close()!!}

		</div><!-- /.form-box -->
</div><!-- /.register-box -->

@include('layouts.partials.scripts_auth')

@include('auth.terms')

<script>
		$(function () {
				$('input').iCheck({
						checkboxClass: 'icheckbox_square-blue',
						radioClass: 'iradio_square-blue',
						increaseArea: '20%' // optional
				});
		});
</script>
</body>
@endsection


{{--<span class="glyphicon glyphicon-lock form-control-feedback"></span>

<div class="form-group has-feedback">
		<input type="password" class="form-control" placeholder="Antigua Contraseña" name="password"/>
		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
</div>
<div class="form-group has-feedback">
		<input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.password') }}" name="password"/>
		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
</div>
<div class="form-group has-feedback">
		<input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.retrypepassword') }}" name="password_confirmation"/>
		<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
</div>
<div class="row">

		<div class="col-xs-4 col-xs-push-1">
				<button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('adminlte_lang::message.register') }}</button>
		</div><!-- /.col -->
</div>--}}
