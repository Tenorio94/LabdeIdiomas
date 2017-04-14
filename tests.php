<h3 class="multilingual">bienvenida_aprendizaje</h3>
<p class="multilingual">selecciona_programa</p>
<style>
li {text-align:left}
</style>
<ul>
<li><a href="index.php?p=autoestudio" class="multilingual">programa_autoestudio</a></li>
<li><a href="index.php?p=practicasTOEFL" class="multilingual">practicas_estructura</a></li>
<?php
	$idiomas = getConection();
	$query_recomendaciones = "SELECT * FROM tbl_recomendaciones";
	$recomendaciones_matriz = $idiomas->query($query_recomendaciones);
	while ($row = $recomendaciones_matriz->fetch_assoc()) {
		?><li><a href="index.php?p=customRecommendation&idrec=<?php echo $row["id"];?>"><?php echo $row["name"];?></a></li><?php
	}
?>
</ul>