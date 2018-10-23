@section ('contenido')
					{!!Form::open(array('url'=>'inscripcion/estudiante','method'=>'delete','autocomplete'=>'off'))!!}
						{{Form::token()}}
				{!!Form::close()!!}
				@endsection
