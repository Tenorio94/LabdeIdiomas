<?php
$idiomas = getConection();
//Abriendo conexion con la base de datos
$id_recomendacion = $_REQUEST['idrec'];
//Para sacar las recomendaciones, se obtienen sus datos.
$query_recomendacion_nombre = "SELECT * FROM tbl_recomendaciones WHERE id = ".$id_recomendacion;
$recomendacion_nombre = mysql_query($query_recomendacion_nombre, $idiomas) or die(mysql_error());
$recomendacion = mysql_fetch_assoc($recomendacion_nombre);

$query_recomendaciones = "SELECT * FROM tbl_recomendaciones_elementos WHERE id_recomendacion = ".$id_recomendacion;
$recomendaciones_matriz = mysql_query($query_recomendaciones, $idiomas) or die(mysql_error());
$elementos=array();
$name=array("id", "id_recomendacion", "id_parent", "name", "children");

while ($row = mysql_fetch_assoc($recomendaciones_matriz)) {
	$row["children"] = array();
	if(isset($row["id_parent"])) array_push($elementos[$row["id_parent"]]["children"], $row["id"]);
	$elementos[$row["id"]]=$row;
}
?> 
<div class="title" name="programTitle"><?php echo $recomendacion["name"] ?></div><br>
<div style="text-align:left; margin-left:20px;">
Nombre de programa: <input name="updateProgramName" type="text"  value="<?php echo $recomendacion["name"] ?>" onkeyup="updateProgramName()"/><br><br>
<table>
	<tr>
		<td><input type="button" onclick="createBaseNode()" value="Crear Nodo Base"/></td>
		<td><input type="button" onclick="createChild()" value="Crear hijo"/></td>
		<td><input type="button" onclick="deleteElement()" value="Eliminar Nodo"/></td>
	</tr>
</table>
<ol name="recommendationTree">
	<?php
		foreach($elementos as $val) {
			if(!isset($val["id_parent"])) getTreeElement($val["id"]);
		}
		?></ol><?php

		//Funcion recursiva para formar el arbol de elementos de html
		function getTreeElement($id) {
			global $elementos;
			?><li><input onclick="setEditName(this)" type="radio" name="temas" id="<?php echo $id;?>"/><span><?php
				echo $elementos[$id]["name"];
			?></span><ol><?php 
					if(count($elementos[$id]["children"])>0)
					foreach($elementos[$id]["children"] as $element) {
						getTreeElement($element);
					}
				?></ol></li>
			<?php
		}
//Cerrando la conexion con la base de datos
closeConection($idiomas);
?>
<div name="editBox" style="border-style: solid; margin-right: 20px" hidden>
	<div style="margin:10px">
		<div>Editar elemento</div><br>
		Nombre: <input name="updateName" type="text" onkeyup="updateName()"/><br><br>
		<div>Recomendaciones
			<ul>
				<li>A1: <textarea name="recommendation1" type="text" onkeyup="updateRecommendation(1)"></textarea></li>
				<li>A2: <textarea name="recommendation2" type="text" onkeyup="updateRecommendation(2)"></textarea></li>
				<li>B1: <textarea name="recommendation3" type="text" onkeyup="updateRecommendation(3)"></textarea></li>
				<li>B2: <textarea name="recommendation4" type="text" onkeyup="updateRecommendation(4)"></textarea></li>
				<li>C1: <textarea name="recommendation5" type="text" onkeyup="updateRecommendation(5)"></textarea></li>
			</ul>
		</div>
	</div>
</div>
<br><br>
<div>
	<form method="post" action="index.php?p=deleteCustomRecomendation&idrec=<?php echo $id_recomendacion ?>">
		<input type="submit" onclick="confirm('Realmente desea eliminar el programa de recomendaciones?')" value="Eliminar Programa de Recomendaciones">
	</form>
</div>
</div>
<script>
	var checked=null;
	var tempId=1;
	var recId = <?php echo $id_recomendacion ?>;
	function query(data, idUp) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				if(idUp) {
					document.getElementById(idUp).id=JSON.parse(xhttp.responseText)[0].id;
				}
			}
		};
		xhttp.open("GET", "recomendacionesDB.php?"+data, true);
		xhttp.send();
	}
	function deleteElement() {
		if(checked) {
			var node=checked.parentNode;
			node.parentNode.removeChild(node);
			document.getElementsByName("updateName")[0].value = "";
			showEditBox(false);
			var queryData = "op=deleteNode&id="+checked.id;
			query(queryData);
			checked=null;
		}
	}
	function createNewNode(pid) {
		var newNode = document.createElement("LI");
		var inpt= document.createElement("INPUT");
		inpt.type="radio";
		inpt.name="temas";
		inpt.id="t"+tempId++;
		inpt.onclick = function () {setEditName(this);}
		newNode.appendChild(inpt);
		var innerText=document.createElement("SPAN");
		innerText.innerText="Nuevo nodo";
		newNode.appendChild(innerText);
		newNode.appendChild(document.createElement("OL"));
		var queryData = "op=createNode&rid=" + recId + "&name=" + innerText.innerText;
		if(pid) queryData+="&pid="+pid;
		query(queryData,inpt.id);
		return newNode;
	}
	function createBaseNode() {
		document.getElementsByName("recommendationTree")[0].appendChild(createNewNode(null));
	}
	function createChild() {
		if(checked) {
			checked.parentNode.children[2].appendChild(createNewNode(checked.id));
		}
	}
	function updateName() {
		if(checked) {
			var newVal=document.getElementsByName("updateName")[0].value;
			var queryData = "op=updateNode&id="+checked.id + "&name=" + newVal;
			query(queryData);
			checked.parentNode.children[1].innerText=newVal;
		}
	}
	function showEditBox(show) {
		document.getElementsByName("editBox")[0].hidden=!show;
	}
	function setEditName(newChecked) {
		checked=newChecked;
		showEditBox(true);
		document.getElementsByName("updateName")[0].value = checked.parentNode.children[1].innerText;
	}
	function updateProgramName() {
		var newName=document.getElementsByName("updateProgramName")[0].value;
		document.getElementsByName("programTitle")[0].innerText=newName;
		var queryData = "op=updateRecName&id="+recId+ "&name=" + newName;
		query(queryData);
	}
</script>
