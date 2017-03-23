<?
//Abriendo conexion con la base de datos
?> 
<h2>Recomendaciones</h2>
<?php
$idiomas = getConection();

$idiomas->query("INSERT INTO tbl_recomendaciones (name) VALUES ('Nuevo programa de recomendaciones')");
//Cerrando la conexion con la base de datos
closeConection($idiomas);
?>
<p>Nuevo programa de recomendaciones creado</p>
