
<?php
require_once('../php/connections.php'); 

	//Abrir conexion con la base de datos
	$idiomas = getConection();
	
	//Borrar de la base de datos
	//if(mysql_query("ALTER TABLE tbl_videos ADD fecha DATE NULL", $idiomas))	
		//echo "alter table succesfull";
		
	if(mysql_query("ALTER TABLE tbl_semanas ADD asueto INT NULL", $idiomas))	
		echo "alter table succesfull";
		
	//Cerrar conexion
	closeConection($idiomas);
?>
