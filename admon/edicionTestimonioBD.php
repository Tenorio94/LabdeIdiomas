<?php
	//Si el archivo fue modificado
	if($_FILES['archivoTestimonio']['name'] != "") {
		//Preparar el path en el que se guardara el archivo.
		$uploaddir = 'testimonios/';	
		$uploadfile = $uploaddir . $_FILES['archivoTestimonio']['name'];	
		
		//Copiar el archivo
		move_uploaded_file($_FILES['archivoTestimonio']['tmp_name'], $uploadfile);
	}
	//Obtener la informaci�n que guardaremos en la base de datos.
	$id = $_POST['id'];
	$autor = $_POST['nombreAlumno'];
	$descripcion = $_POST['descripcion'];
	$fecha = $_POST['fecha'];
	$archivo = $_FILES['archivoTestimonio']['name'];
	$tipo = $_POST['tipoArchivo'];
	
	//Darle formato a la fecha
	$exploded_fecha = explode('/', $fecha); 
	$fecha = $exploded_fecha[2] ."-" . $exploded_fecha[1] ."-". $exploded_fecha[0];
	
	//Abrir conexion con la base de datos
	$idiomas = getConection();

	//Insertar en la base de datos
	$inserted = 0;
	
	if($_FILES['archivoTestimonio']['name'] != "") {
		if($idiomas->query("UPDATE tbl_videos SET descripcion = '$descripcion', autor = '$autor', archivo = '$archivo', tipo = '$tipo', fecha = '$fecha' WHERE id = $id"))
			$inserted = 1;
	} else {
		if($idiomas->query("UPDATE tbl_videos SET descripcion = '$descripcion', autor = '$autor', tipo = '$tipo', fecha = '$fecha' WHERE id = $id"))
			$inserted = 1;
	}		

	//Cerrar conexion
	closeConection($idiomas);
	
	//Redireccionar a testimonios
	echo "<script>location.href='index.php?p=testimonios&t=".$inserted."';</script>";
?>
