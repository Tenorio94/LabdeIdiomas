
<?php
	//Preparar el path en el que se guardara el archivo.
	$uploaddir = 'testimonios/';	
	$uploadfile = $uploaddir . $_FILES['archivoTestimonio']['name'];	
	
	//Copiar el archivo
	move_uploaded_file($_FILES['archivoTestimonio']['tmp_name'], $uploadfile);
	
	//Obtener la informaci�n que guardaremos en la base de datos.
	$autor = $_POST['nombreAlumno'];
	$descripcion = $_POST['descripcion'];
	$fecha = $_POST['fecha'];
	$archivo = $_FILES['archivoTestimonio']['name'];
	$tipo = $_POST['tipoArchivo'];
	
	//Darle formato a la fecha
	//Recibe la fecha en formato dd/mm/aaaa
	$exploded_fecha = explode('/', $fecha);
	//Cambia la fecha a formato aaaa-mm-dd
	$fecha = $exploded_fecha[2] ."-" . $exploded_fecha[1] ."-" .$exploded_fecha[0];
	
	//Abrir conexion con la base de datos
	$idiomas = getConection();

	//Insertar en la base de datos
	$inserted = 0;
	if($idiomas->query("INSERT INTO tbl_videos (descripcion, autor, archivo, tipo, fecha) VALUES ('". $descripcion ."', '". $autor ."', '". $archivo . "', '". $tipo ."', '". $fecha . "')"))
		$inserted = 1;		

	//Cerrar conexion
	closeConection($idiomas);
	
	//Redireccionar a testimonios
	echo "<script>location.href='index.php?p=testimonios&t=".$inserted."';</script>";
?>
