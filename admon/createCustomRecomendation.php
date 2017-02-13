<?
//Abriendo conexion con la base de datos
?> 
<h2>Recomendaciones</h2>
<?php
$idiomas = getConection();

mysql_query("INSERT INTO tbl_recomendaciones (name) VALUES ('Nuevo programa de recomendaciones')", $idiomas);
//Cerrando la conexion con la base de datos
closeConection($idiomas);
?>
<p>Nuevo programa de recomendaciones creado</p>
