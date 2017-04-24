<?php
//Obtenemos el id de la reservacion
$id_reservacion = $_REQUEST['cs'];

//Abrimos conexion con la base de datos
$idiomas = getConection();


$delete_query = $idiomas->query("DELETE FROM tbl_reservaciones WHERE id = $id_reservacion");

//Cerrando la conexion con la base de datos
closeConection($idiomas);
?>

<p align="center" class="titulo">La Reservación del Alumno ha sido borrada satisfactoriamente</p>
<p align="center">&nbsp;</p>


