<?php
	//Obtener la información que guardaremos en la base de datos.
	$id = $_POST['id'];
	$descripcion = $_POST['descripcion'];
	$activo = $_POST['activo'];

	//Abrir conexion con la base de datos
	$idiomas = getConection();
	mysql_select_db($database_idiomas, $idiomas);

	//Insertar en la base de datos
	$inserted = 0;
	
	if(mysql_query("UPDATE tbl_avisos SET descripcion = '$descripcion', activo = '$activo' WHERE id = $id", $idiomas))
		$inserted = 1;

	//Cerrar conexion
	closeConection($idiomas);
	
	//Redireccionar a testimonios
	echo "<script>location.href='index.php?p=avisos&t=".$inserted."';</script>";
?>
