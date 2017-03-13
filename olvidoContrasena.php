<?php

//Obtenemos la matricula
$matricula = $_REQUEST['m'];

//Abriendo conexion con la base de datos
$idiomas = getConection();

//Obteniendo la informacion del alumno
$query_matricula = mysql_query("SELECT * FROM tbl_matriculas WHERE matricula = $matricula", $idiomas) or die(mysql_error());
$matricula = mysql_fetch_array($query_matricula);
$total_matricula = mysql_num_rows($query_matricula);

//Si no hay registros en la base de datos, enviar mensaje
if($total_matricula < 1)
{
	echo "La matrícula no esta registrada en nuestra base de datos. Verifica que este correcta.";
} else {
	//Enviar correo

	$subject = "Datos de Usuario :: Laboratorio de Idiomas";

	$message = '<p align="left">
					Has solicitado el envío de tu contraseña por correo electrónico. <br><br>
					Tu contraseña es: ' . $matricula['password'] .' 
				</p>';

	$to = $matricula['email'];
	enviarEmail($to, $subject, $message);
	echo '<p align="center"><strong>Se envi&oacute; un correo electronico a tu cuenta: ' . $to . ' con tu contraseña.</strong></p>';

}

//Cerrando conexion 
closeConection($idiomas);
?>