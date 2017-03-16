<?php
	//Abrir conexion con la base de datos
	$idiomas = getConection();
	mysql_select_db($database_idiomas, $idiomas);

	//Borrar cancelaciones de la base de datos
	mysql_query("DELETE FROM tbl_cancelaciones", $idiomas);

	//Borrar reservaciones de la base de datos
	mysql_query("DELETE FROM tbl_reservaciones", $idiomas);

	//Borrar alumnos de la base de datos
	mysql_query("DELETE FROM tbl_matriculas", $idiomas);
	
	//Cerrar conexion
	closeConection($idiomas);
	
	//Redireccionar a testimonios
	echo "<script>location.href='index.php?p=varios';</script>";
?>
