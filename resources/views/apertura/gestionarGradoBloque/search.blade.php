

{{-- {!! Form::open(array('url'=>'apertura/gestionarGradoBloque', 'method'=>'GET','autocomplete'=>'off','rule'=>'search'))!!}

<div class="table-responsive">
	<table class="table table-striped table-bordered table-condensed table-hover">
	<thread>
		<th><input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
		</th>
		<th>
		{!!Form::select('idturno',$turno,null,['id'=>'turno'])!!}
		</th>
		<th><span class="input-group-btn">

			<button type="submit" class ="btn btn-primary">Buscar</button>
		</span></th>
	</thread>

	</table>
</div>
{{Form::close()}}  --}}


{!! Form::open(array('url'=>'apertura/gestionarGradoBloque', 'method'=>'GET','autocomplete'=>'off','rule'=>'search'))!!}
<div class="container">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-condensed table-hover">
		<thread>
			<th><input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
			</th>
			<th>
			{!!Form::select('idturno',$turno,null,['id'=>'turno','class'=>'form-control'])!!}
			</th>
			<th><span class="input-group-btn">

				<button type="submit" class ="btn btn-primary">Buscar</button>
			</span></th>
		</thread>

		</table>
	</div>
</div>

{{Form::close()}}
