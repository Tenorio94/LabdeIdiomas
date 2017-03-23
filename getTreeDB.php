<?php
$idiomas = getConection();
$id_recomendacion = $_REQUEST['idrec'];
//Para sacar las recomendaciones, se obtienen sus datos.
$query_recomendacion_nombre = "SELECT * FROM tbl_recomendaciones WHERE id = ".$id_recomendacion;
$recomendacion_nombre = $idiomas->query($query_recomendacion_nombre);
$recomendacion = $recomendacion_nombre->fetch_assoc();

$query_recomendaciones = "SELECT * FROM tbl_recomendaciones_elementos WHERE id_recomendacion = ".$id_recomendacion;
$recomendaciones_matriz = $idiomas->query($query_recomendaciones);
$elementos=array();
$name=array("id", "id_recomendacion", "id_parent", "name", "children");

while ($row = $recomendaciones_matriz->fetch_assoc()) {
	$row["children"] = array();
	if(isset($row["id_parent"])) array_push($elementos[$row["id_parent"]]["children"], $row["id"]);
	$elementos[$row["id"]]=$row;
}
?>
<div class="title"><?php echo $recomendacion["name"] ?></div><br>
<form style="text-align:left; margin-left:20px;" action="index.php?p=enviarSugerencias&idrec=<?php echo $id_recomendacion; ?>" method="post" name="formaEnviar" onSubmit="return mandar()">
	<table>
	<tr><td>Nombre:</td>
		<td><input type="text" name="nombre" required/></td></tr>
	<tr><td>Matricula:</td>
		<td><input type="text" name="matricula" required/></td></tr>

	<tr><td>Nivel:</td>
		<td><select name="niveles" style="width:100%;" required>
		  <option value="1">Nivel A1</option>
		  <option value="2">Nivel A2</option>
		  <option value="3">Nivel B1</option>
		  <option value="4">Nivel B2</option>
		  <option value="5">Nivel C1</option>
		</select></td></tr>

	<tr><td>Correo:</td>
		<td><input type="text" name="correo" required><span id="msjErrorCorreo" style="display:none" >*Por favor ingresa tu correo.</span></td></tr>
	</table>
	<div><ol>
	<?php
		foreach($elementos as $val) {
			if(!isset($val["id_parent"])) getTreeElement($val["id"]);
		}
		?></ol></div><?php

		//Funcion recursiva para formar el arbol de elementos de html
		function getTreeElement($id) {
			global $elementos;
			?><li><input type="checkbox" name="temas[]" value="<?php echo $id;?>"/>
			<?php
				echo $elementos[$id]["name"]
			?><ol><?php 
					if(count($elementos[$id]["children"])>0)
					foreach($elementos[$id]["children"] as $element) {
						getTreeElement($element);
					}
				?></ol></li>
			<?php
		}
	?>
	<br><br><input type="submit" value="Submit" style="margin-bottom:20px">
        <div id="lblExito" style="display:none">Tu mensaje ha sido enviado!</div>
            </div>
</form>