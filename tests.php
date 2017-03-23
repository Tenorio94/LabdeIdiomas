<h3>Bienvenido al programa de Aprendizaje Autorregulado</h3>
<p>Selecciona el programa de tu inter&eacute;s:</p>
<style>
li {text-align:left}
</style>
<ul>
<li><a href="index.php?p=autoestudio">Programa de auto estudio</a></li>
<li><a href="index.php?p=practicasTOEFL">Pr&aacute;cticas para Structure and Written Expression</a></li>
<?php
	$idiomas = getConection();
	$query_recomendaciones = "SELECT * FROM tbl_recomendaciones";
	$recomendaciones_matriz = $idiomas->query($query_recomendaciones);
	while ($row = $recomendaciones_matriz->fetch_assoc()) {
		?><li><a href="index.php?p=customRecommendation&idrec=<?php echo $row["id"];?>"><?php echo $row["name"];?></a></li><?php
	}
?>
</ul>