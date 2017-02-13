<table align="center">
	<tr>
		<td class="title">Alta de Testimonio</td>
	</tr>
</table>
<form name="forma" method="post" action="index.php?p=patestimonio" enctype="multipart/form-data">
<table align="center" width="50%" class="content">
	<tr>
		<td align="left" width="50%">Nombre del Alumno:</td>
		<td align="left"><input type="text" name="nombreAlumno" size="50" /></td>
	</tr>
	<tr>
		<td align="left"><br>Descripción:</td>
		<td align="left"><br><textarea name="descripcion" rows="5" cols="37"></textarea></td>
	</tr>
	<tr>
		<td align="left"><br>Fecha:</td>
		<td align="left"><br><input type="text" name="fecha"  size="50" value="dd/mm/aaaa"/></td>
	</tr>
	<tr>
		<td align="left"><br>Archivo:</td>
		<td align="left"><br><input type="file" name="archivoTestimonio"  size="37"></td>
	</tr>
	<tr>
		<td align="left"><br>Tipo de Archivo:</td>
		<td align="left">
			<br><input type="radio" name="tipoArchivo" value="video" /> video &nbsp; &nbsp;<input type="radio" name="tipoArchivo" value="foto" /> foto
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2">
			<br><br>
			<input type="submit" name="Submit" value="Dar de Alta">
		</td>
	</tr>
</table>
</form>
