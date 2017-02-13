
<?php
	//Obtener la información que guardaremos en la base de datos.
	$descripcion = $_POST['descripcion'];
	$activo = $_POST['activo'];
	
	//Darle formato a la fecha
	$fecha = date("y-m-d"); 

	//Abrir conexion con la base de datos
	$idiomas = getConection();
	mysql_select_db($database_idiomas, $idiomas);

	//Insertar en la base de datos
	$inserted = 0;
	if(mysql_query("INSERT INTO tbl_avisos (descripcion, fecha, activo) VALUES ('". $descripcion ."', '". $fecha ."', '". $activo . "')", $idiomas))
		$inserted = 1;		

	//Cerrar conexion
	closeConection($idiomas);
	
	//Redireccionar a testimonios
	echo "<script>location.href='index.php?p=avisos&t=".$inserted."';</script>";
?>
