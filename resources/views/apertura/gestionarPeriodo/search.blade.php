{!! Form::open(array('url'=>'apertura/gestionarPeriodo', 'method'=>'GET','autocomplete'=>'off','rule'=>'search'))!!}
<div class="container">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-condensed table-hover">
		<thread>
			<th><input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
			</th>
			<th>
			{!!Form::select('idturno',$turno,$iddetallegestionturno,['id'=>'turno','class'=>'form-control'])!!}
			</th>
			<th><span class="input-group-btn">

				<button type="submit" class ="btn btn-primary">Buscar</button>
			</span></th>
		</thread>

		</table>
	</div>
</div>
{{Form::close()}}
