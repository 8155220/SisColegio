@section ('contenido')
					{!!Form::open(array('url'=>'admUsuario.gestionarTipoUsuario','method'=>'delete','autocomplete'=>'off'))!!}
						{{Form::token()}}
				{!!Form::close()!!}
				@endsection
