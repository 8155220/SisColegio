
<table style="height: 20px;" width="465">
<tbody>
<tr>
	<td>
		Nombre y bloque del curso : {{$instanciadetallegradobloque->descripcion}}
	</td>
</tr>
<tr>
	<td>
		Nombre :
	</td>
	<td>
		 Rude:
	</td>
</tr>
@foreach($instanciaestudiante as $estudiante)
<tr>
		<td>---------{{$estudiante->descripcionestudiante}}</td>
		<td>{{$estudiante->rude}}</td>
</tr>
@endforeach


</tbody>
</table>
