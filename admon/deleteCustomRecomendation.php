<?
//Abriendo conexion con la base de datos
?> 
<h2>Recomendaciones</h2>
<?php
$idiomas = getConection();
$id_recomendacion = $_REQUEST['idrec'];

mysql_query("DELETE FROM tbl_recomendaciones WHERE id=".$id_recomendacion, $idiomas);
//Cerrando la conexion con la base de datos
closeConection($idiomas);
?>
<p>El programa fue borrado exitosamente</p>
