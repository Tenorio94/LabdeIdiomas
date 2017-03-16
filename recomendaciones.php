<?php 
$enviar=$_POST['nombre']."<br>".$_POST['matricula']."<br>".$_POST['correo']."<br><br>";
$filename="arboles/arbol.txt";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);
//echo $contents;
$Nodos=explode("\n",$contents);
for($i=0; $i<count($Nodos); $i++) {
	$Nodos[$i]=explode("/", $Nodos[$i]);
}
$recomendados=explode(",",$_POST['jsfields']);
$j=0;
$enviar.="A continuación se muestran las recomendaciones para lo que desea practicar.<br>";
for($i=0; $i<count($recomendados); $i++) {
	for($j=0; $j<count($Nodos); $j++) {
		if($Nodos[$j][0]==$recomendados[$i]) {
			break;
		}
	}
	$enviar.=$Nodos[$j][2].": ".$Nodos[$j][3]."<br>";
}
echo "<br>La informacion ha sido enviada exitosamente.";
//SEND MAIL
enviarEmail($_POST['correo'], "Sugerencias para prácticas de Structure and Written Expression", $enviar);
enviarEmail("crai.mty@servicios.itesm.mx", "Sugerencias para prácticas de Structure and Written Expression", $enviar);
?>