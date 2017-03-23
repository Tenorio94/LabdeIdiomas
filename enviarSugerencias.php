<?php?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
</head>
<body>
<?php

$idiomas = getConection();

require 'PHPMailer-master/PHPMailerAutoload.php';

$id_recomendacion = $_REQUEST['idrec'];

$query_recomendaciones = "SELECT * FROM tbl_recomendaciones_elementos WHERE id_recomendacion = ".$id_recomendacion;
$recomendaciones_matriz = $idiomas->query($query_recomendaciones);
$elementos=array();
$name=array("id", "id_recomendacion", "id_parent", "name", "children");

while ($row = $recomendaciones_matriz->fetch_assoc()) {
	$row["children"] = array();
	if($row["id_parent"]!=-1) array_push($elementos[$row["id_parent"]]["children"], $row["id"]);
	$row["show_recommendation"] = false;
	$row["show_element"] = false;
	$elementos[$row["id"]]=$row;
}

$nombre = $_POST['nombre'];
$matricula = $_POST['matricula'];
$correo = $_POST['correo'];
$nivel = $_POST['niveles'];

if(!isset($nivel)||$nivel=="") $nivel=0;

$mail = new PHPMailer(); // create a new object¡
$mail->Host = "itesm.mx";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "crai.mty@servicios.itesm.mx";
$mail->Password = "venajebu";
$mail->SetFrom("crai.mty@servicios.itesm.mx");
$mail->Subject = "Material para Estudiar";

$mail->Body = "Nombre: " .$nombre ."<br>Matricula: " .$matricula ."<br>Nivel TOEFL: " .$nivel ."<br>Correo electr&oacute;nico: " .$correo ."<br><br>";
$mail->Body = $mail->Body ."Hola " .$nombre .", <br> " ." Bas&aacute;ndonos en tu puntaje, te recomendamos los siguientes materiales que pueden serte &uacute;tiles para lograr tus metas de aprendizaje. <br><br>";

if(isset($_POST['temas'])) {
	$temas = $_POST['temas'];
	foreach ($temas as $id_tema) {
		$elementos[$id_tema]["show_recommendation"] = true;
		setPrintParents($id_tema);
	}
}
$mail->Body.="<ol>";
foreach($elementos as $val) {
	if($val["id_parent"]==-1) getSugerencias($val["id"]);
}
$mail->Body.="</ol>";

function setPrintParents($id) {
	global $elementos;
	if($elementos[$id]["show_element"]==false) {
		$elementos[$id]["show_element"]= true;
		$id_parent = $elementos[$id]["id_parent"];
		if($id_parent!=-1) {
			setPrintParents($id_parent);
		};
	}
}

//Funcion recursiva para formar el arbol de elementos de html
function getSugerencias($id) {
	global $elementos;
	global $idiomas;
	global $mail;
	global $nivel;
	if($elementos[$id]["show_element"]==true) {
		$query_sugerencia = "SELECT * FROM tbl_sugerencias WHERE id_elemento='".$id ."' AND nivel='" .$nivel. "'";
		$sugerencia = $idiomas->query($query_sugerencia);
		$row_sugerencia = $sugerencia->fetch_assoc();
		$mail->Body .= "<li>" . $elementos[$id]["name"];
		if($elementos[$id]["show_recommendation"]==true) {
			if(!isset($row_sugerencia["recommendation"])) $row_sugerencia["recommendation"] = "Lo sentimos, por el momento no tenemos sugerencias sobre este tema.";
			else if(!isset($row_sugerencia["url"])||$row_sugerencia["url"]=="") {
				$mail->Body .= ": ".$row_sugerencia["recommendation"];
			}
			else {
				$mail->Body .= ": <a href='" .$row_sugerencia["url"] . "' target='_blank'>".$row_sugerencia["recommendation"] . "</a>";
			}
		}
		$mail->Body.="<ol>";
		if(count($elementos[$id]["children"])>0)
		foreach($elementos[$id]["children"] as $element) {
			getSugerencias($element);
		}
		$mail->Body .= "</ol>";
		$mail->Body .= "</li>";
	}
}

$mail->Body = $mail->Body ."Centro de Recursos para el Aprendizaje de Idiomas <br>Departamento de Lenguas Modernas <br>Escuela de Negocios, Ciencias Sociales y Humanidades <br>Rector&iacute;a de la Zona Metropolitana de Monterrey <br>TEC DE MONTERREY";

$mail->AddAddress($correo);

if(!$mail->Send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
}
else {
	echo "<div style='text-align:left; margin-left: 20px;'><br>Mensaje enviado<br><br>" .$mail->Body . "</div>";
}
?>
</body>
</html>
