<?php
//Abriendo conexion con la base de datos
$idiomas = getConection();

//Obteniendo los datos de la forma
$id_alumno = $_POST['id_alumno'];
$nombre = $_POST['nombre'];
$ap_paterno = $_POST['ap_paterno'];
$ap_materno = $_POST['ap_materno'];
$email = $_POST['email'];
$password = $_POST['password'];

$success = 0;

//Guardando la informacion en la base de datos
if($password != "") {
	if(mysql_query("UPDATE tbl_matriculas set nombre = '$nombre', ap_paterno = '$ap_paterno', ap_materno = '$ap_materno', email = '$email', password = '$password', flagPassword = 0 WHERE id = $id_alumno",$idiomas) or die(mysql_error()))
		$success = 1;
		
		//Maybe send email.
		
} else {
	if(mysql_query("UPDATE tbl_matriculas set nombre = '$nombre', ap_paterno = '$ap_paterno', ap_materno = '$ap_materno', email = '$email' WHERE id = $id_alumno",$idiomas) or die(mysql_error()))
		$success = 1;
}

//Cerrando la conexion con la base de datos
closeConection($idiomas);
?>
<table>
<?
if($success == 0) {		
?>
	<tr>
		<td><p><strong><font color="#333333" face="Verdana, Arial, Helvetica, sans-serif">
				Lo sentimos, no fue posible guardar la información en nuestra base de datos.<br>
                Intenta más tarde.</font></strong></p>
			<p>&nbsp;</p>
		</td>
	</tr>
<? } else { ?>
	<tr>
		<td><p><strong><font color="#333333" face="Verdana, Arial, Helvetica, sans-serif">
				La información fue guardada exitosamente.
			<p>&nbsp;</p>
		</td>
	</tr>
<? } ?>

</table>
