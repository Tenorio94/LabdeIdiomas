<?php
//Abrimos la conexion
$idiomas = getConection();

//Id del testimonio a editar
$id = $_REQUEST['cs'];

//Obtenemos el aviso de la base de datos
$query_aviso = mysql_query("SELECT * FROM tbl_avisos WHERE id = $id", $idiomas) or die(mysql_error());
$aviso = mysql_fetch_array($query_aviso);

//Cerramos la conexion
closeConection($idiomas);
?>

<table align="center">
	<tr>
		<td class="title">Edici�n de Testimonio</td>
	</tr>
</table>
<form name="forma" method="post" action="index.php?p=peaviso" >
<input type="hidden" name="id" value="<? echo $id; ?>" />
<table align="center" width="50%" class="content">
	<tr>
		<td align="left"><br>Descripci�n:</td>
		<td align="left"><br><textarea name="descripcion" rows="5" cols="37"><? echo $aviso['descripcion']; ?></textarea></td>
	</tr>
	<tr>
		<td align="left"><br>Activo:</td>
		<td align="left"><br>
			<select name="activo">
				<option value="Y" <? if($aviso['activo'] == "Y") {?>selected<? }?>>S�</option>
				<option value="N" <? if($aviso['activo'] == "N") {?>selected<? }?>>No</option>				
			</select>
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
