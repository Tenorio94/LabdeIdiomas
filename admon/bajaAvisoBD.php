<?php
	//Abrir conexion con la base de datos
	$idiomas = getConection();
	
	//Id del testimonio a borrar
	$id = $_REQUEST['cs'];

	//Borrar de la base de datos
	$idiomas->query("DELETE FROM tbl_avisos WHERE id=$id");

	//Cerrar conexion
	closeConection($idiomas);
	
	//Redireccionar a testimonios
	echo "<script>location.href='index.php?p=avisos';</script>";
?>
