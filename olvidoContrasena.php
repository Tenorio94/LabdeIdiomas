<?php

//Obtenemos la matricula
$matricula = $_REQUEST['m'];

//Abriendo conexion con la base de datos
$idiomas = getConection();

//Obteniendo la informacion del alumno
$query_matricula = $idiomas->query("SELECT * FROM tbl_matriculas WHERE matricula = $matricula");
$matricula = $query_matricula->fetch_assoc();

//Si no hay registros en la base de datos, enviar mensaje
if($query_matricula->num_rows < 1)
{
	echo "La matrícula no esta registrada en nuestra base de datos. Verifica que este correcta.";
} else {
	//Enviar correo

	$subject = "Datos de Usuario :: Laboratorio de Idiomas";

	$message = '<p align="left">
					Has solicitado el envío de tu contraseña por correo electronico. <br><br>
					Tu contraseña es: ' . $matricula['password'] .' 
				</p>';

	$to = $matricula['email'];
	enviarEmail($to, $subject, $message);
	echo '<p align="center"><strong>Se envi&oacute; un correo electronico a tu cuenta: ' . $to . ' con tu contraseña.</strong></p>';

}

//Cerrando conexion 
closeConection($idiomas);
?>