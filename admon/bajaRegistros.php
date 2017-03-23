<?php
	//Abrir conexion con la base de datos
	$idiomas = getConection();

	//Borrar cancelaciones de la base de datos
	$idiomas->query("DELETE FROM tbl_cancelaciones");

	//Borrar reservaciones de la base de datos
	$idiomas->query("DELETE FROM tbl_reservaciones");

	//Borrar alumnos de la base de datos
	$idiomas->query("DELETE FROM tbl_matriculas");
	
	//Cerrar conexion
	closeConection($idiomas);
	
	//Redireccionar a testimonios
	echo "<script>location.href='index.php?p=varios';</script>";
?>
