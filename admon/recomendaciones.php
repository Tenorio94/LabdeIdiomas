<?php
//Abriendo conexion con la base de datos

?> 
<div class="title">Recomendaciones</div><br>
<?php
$idiomas = getConection();

$query_recomendaciones = "SELECT * FROM tbl_recomendaciones";
$recomendaciones_matriz = mysql_query($query_recomendaciones, $idiomas) or die(mysql_error());
while ($row = mysql_fetch_assoc($recomendaciones_matriz)) {
	?><li><a href="index.php?p=editRecommendation&idrec=<?php echo $row["id"];?>"><?php echo $row["name"];?></a></li><?php
}
?><br><a href="index.php?p=createCustomRecomendation">Crear nueva recomendación</a>
<?php

//Cerrando la conexion con la base de datos
closeConection($idiomas);
?>
