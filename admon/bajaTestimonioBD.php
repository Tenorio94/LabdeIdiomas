
<?php
	//Abrir conexion con la base de datos
	$idiomas = getConection();
	mysql_select_db($database_idiomas, $idiomas);
	
	//Id del testimonio a borrar
	$id = $_REQUEST['cs'];

	//Borrar de la base de datos
	mysql_query("DELETE FROM tbl_videos WHERE id=$id", $idiomas);

	//Cerrar conexion
	closeConection($idiomas);
	
	//Redireccionar a testimonios
	echo "<script>location.href='index.php?p=testimonios';</script>";
?>
