<?php
//Abriendo conexion con la base de datos

?> 
<div class="title">Recomendaciones</div><br>
<?php
$idiomas = getConection();

$query_recomendaciones = "SELECT * FROM tbl_recomendaciones";
$recomendaciones_matriz = $idiomas->query($query_recomendaciones);
while ($row = $recomendaciones_matriz->fetch_assoc()) {
	?><li><a href="index.php?p=editRecommendation&idrec=<?php echo $row["id"];?>"><?php echo $row["name"];?></a></li><?php
}
?><br><a href="index.php?p=createCustomRecomendation">Crear nueva recomendaci�n</a>
<?php

//Cerrando la conexion con la base de datos
closeConection($idiomas);
?>
