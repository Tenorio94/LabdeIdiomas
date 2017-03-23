<?php
	//Obtener el estado de la insercion para saber si desplegamos mensaje
	$inserted = $_REQUEST['t'];
	
	if(inserted == "1")
		echo "El aviso fue dado de alta correctamente";
	else if(inserted == "0")
		echo "Hubo un error al dar de alta el aviso, por favor, intente más tarde.";
?>
	<div align="center" style="width:90%; text-align:right" class="content">
		<img src="../imagenes/alta.jpg" /><a href="index.php?p=aaviso">Dar de alta un aviso</a>
		<br>
	</div>

	<table align="center">
		<tr><td class="title">Avisos<br><br></td></tr>
	</table>

	<table align="center" width="810px" class="table">
		<tr>
			<td width="70px" class="trheader">Fecha</td>
			<td width="600px" class="trheader">Aviso</td>
			<td width="40px" class="trheader">Activo</td>
			<td width="100px" class="trheader">&nbsp;</td>
		</tr>
<?
	//Abriendo conexion con la base de datos
	$idiomas = getConection();
	
	//Obteniendo todos los registros de la base de datos
	$query_avisos = mysql_query("SELECT * FROM tbl_avisos ORDER BY id ASC", $idiomas) or die(mysql_error());
	//Cerramos la conexion
	closeConection($idiomas);
	
	//Por cada video en la base de datos, desplegaremos 
	while($aviso = mysql_fetch_array($query_avisos)) {
	
	//Darle formato a la fecha
	$exploded_fecha = explode('-', $aviso['fecha']); 
	$fecha = $exploded_fecha[2] ."/" . $exploded_fecha[1] ."/" .$exploded_fecha[0];
	
	?>
		
		<tr>
			<td align="center" class="trBottonBorder"> <? echo $fecha; ?> </td>
			<td align="left" class="trBottonBorder"><br><? echo $aviso['descripcion'];?><br><br></td>
			<td align="center" class="trBottonBorder"><? echo $aviso['activo'];?></td>
			<td align="center" class="trBottonBorder">
				<a href="index.php?cs=<? echo $aviso['id']; ?>&p=eaviso">Editar</a>
				&nbsp;&nbsp;&nbsp;
				<a href="index.php?cs=<? echo $aviso['id']; ?>&p=pbaviso" onClick="return confirmarBaja();">Borrar</a>
			</td>
		</tr>
	<?
	}

?>
</table>
<script>
	function confirmarBaja() {
		var ok = confirm("¿Deseas eliminar el aviso seleccionado?");
		if(ok) {
			return true;
		}
		return false;
	}
</script>