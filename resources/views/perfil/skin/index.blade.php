@extends('layouts.app')
@section ('contenido')
@include('alerts.success')

<body class="hold-transition register-page">
<div class="register-box">
		<div class="register-logo">
				<a><b> Seleccione Un Color</b></a>
		</div>


		<div class="register-box-body">

			{!!Form::open(['route'=>'skin.store','method'=>'POST'])!!}

						<div class="form-group">
							{!!Form::select('skin',
							['skin-blue' => 'Azul',
							'skin-black' => 'Negro',
							'skin-purple' => 'Violeta',
							'skin-yellow' => 'Amarillo',
							'skin-red' => 'Rojo',
							'skin-green' => 'Verde'])!!}
						</div>

						{!!form::submit('Guardar',['name'=>'grabar','id'=>'grabar','content'=>'<span>Guardar</span>','class'=>'btn btn-primary btn-block btn-flat'])!!}

				{!!Form::close()!!}

		</div><!-- /.form-box -->
</div><!-- /.register-box -->

@endsection
