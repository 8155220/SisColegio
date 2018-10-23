
<table style="height: 20px;" width="465">
<tbody>
<tr>
<td>Nombre Unidad Educativa: {{$instanciagestion->descripcion}}</td>
<td>COD-Gestion :  {{$instanciagestion->idgestion}}</td>
<td></td>
</tr>
<tr>
	<td>Fecha inicio : {{$instanciagestion->fechainicio}}</td>
</tr>
<tr>
	<td>Fecha Fin : {{$instanciagestion->fechafin}}</td>	
</tr>

<tr>
<td>Turnos   : @foreach($instanciaturno as $turno) {{$turno->descripcion}}
@endforeach
</tr>
<tr>
	<td>Cantidad Estudiantes Inscritos  : {{$cantidadinscritos[0]->cupo}}</td>
	<td></td>
</tr>
<tr>
	<td>
		Lista de Grados :
	</td>
</tr>
@foreach($instanciagrado as $grado)
<tr>
		<td>---------{{$grado->descripcion}}</td>
</tr>
@endforeach
<tr>
	<td>
		Lista de Bloques :
	</td>
</tr>
@foreach($instanciabloque as $bloque)
<tr>
		<td>---------{{$bloque->descripcion}}</td>
</tr>
@endforeach
<tr>
	<td>
		Lista de Materias :
	</td>
</tr>
@foreach($instanciamateria as $materia)
<tr>
		<td>---------{{$materia->descripcion}}</td>
</tr>
@endforeach

</tbody>
</table>
