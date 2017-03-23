
<?php
	//Abrir conexion con la base de datos
	$idiomas = getConection();

	//Borrar comentarios de la base de datos
	$idiomas->query("DELETE FROM tbl_videos");
	
	//Cerrar conexion
	closeConection($idiomas);
	
	//Redireccionar a testimonios
	echo "<script>location.href='index.php?p=varios';</script>";
?>
