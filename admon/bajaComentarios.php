
<?php
	//Abrir conexion con la base de datos
	$idiomas = getConection();
	mysql_select_db($database_idiomas, $idiomas);

	//Borrar comentarios de la base de datos
	mysql_query("DELETE FROM tbl_videos", $idiomas);
	
	//Cerrar conexion
	closeConection($idiomas);
	
	//Redireccionar a testimonios
	echo "<script>location.href='index.php?p=varios';</script>";
?>
