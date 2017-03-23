<?php
//Abrimos la conexion
$idiomas = getConection();

//Id del testimonio a editar
$id = $_REQUEST['cs'];

//Obtenemos el testimonio de la base de datos
$testimonio_array = $idiomas->query("SELECT * FROM tbl_videos WHERE id = $id");
$testimonio = $testimonio_array->fetch_assoc();

//Darle formato a la fecha
$exploded_fecha = explode('-', $testimonio['fecha']); 
$fecha = $exploded_fecha[2] ."/" . $exploded_fecha[1] ."/" . $exploded_fecha[0];

//Cerramos la conexion
closeConection($idiomas);
?>

<table align="center">
	<tr>
		<td class="title">Edici�n de Testimonio</td>
	</tr>
</table>
<form name="forma" method="post" action="index.php?p=petestimonio" enctype="multipart/form-data">
<input type="hidden" name="id" value="<? echo $id; ?>" />
<table align="center" width="50%" class="content">
	<tr>
		<td align="left" width="50%">Nombre del Alumno:</td>
		<td align="left"><input type="text" name="nombreAlumno" size="50" value="<? echo $testimonio['autor']; ?>"/></td>
	</tr>
	<tr>
		<td align="left"><br>Descripci�n:</td>
		<td align="left"><br><textarea name="descripcion" rows="5" cols="37"><? echo $testimonio['descripcion']; ?></textarea></td>
	</tr>
	<tr>
		<td align="left"><br>Fecha:</td>
		<td align="left"><br><input type="text" name="fecha"  size="50" value="<? echo $fecha; ?>"/></td>
	</tr>
	<tr>
		<td align="left"><br>Archivo:</td>
		<td align="left"><br><input type="file" name="archivoTestimonio"  size="37"  value="<? echo $testimonio['archivo']; ?>"></td>
	</tr>
	<tr>
		<td align="left"><br>Tipo de Archivo:</td>
		<td align="left">
			<br><input type="radio" name="tipoArchivo" value="video" <? if($testimonio['tipo'] == "video") { ?> checked <? }?>/> video 
			&nbsp; &nbsp;
			<input type="radio" name="tipoArchivo" value="foto"  <? if($testimonio['tipo'] == "foto") { ?> checked <? }?>/> foto
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2">
			<br><br>
			<input type="submit" name="Submit" value="Guardar">
		</td>
	</tr>
</table>
</form>
