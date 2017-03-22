<?php
//Abriendo conexion con la base de datos
$idiomas = getConection();

//Contador de alumnos
$contadorInicial = 0;

$uploaddir = 'horas/';	
$uploadfile = $uploaddir . $_FILES['alumnos']['name'];	
	
move_uploaded_file($_FILES['alumnos']['tmp_name'], $uploadfile);
$num_iguales = 0;

//Abrimos el archivo
$handle = fopen($uploadfile, "r");
while($string = fgets($handle))
{
	//Se utiliza el tokenizer para separar en partes la informacion del alumno.
	$nombre = strtok( $string , ";" );
	$guiado = strtok(";");
	$libre = strtok(";");
	$dinamico = strtok(";");
	$total = strtok(";");
	$sesiones = strtok(";");
	
	//Se utiliza tokenizer para obtener la matricula, ya que esta hasta el final de nombre.
	$tok=strtok($nombre, " ");
	while ($tok !== false) {
		$matricula=$tok;
		$tok = strtok(" ");
	}
	//Se obtienen las horas, ya considerando que 40 minutos=1 hora.
	$horas=date('G', 3*strtotime(str_replace('/', '-', $total))/2);
	
	//echo $matricula. "  ". $horas. "\n";

	//Se busca un alumno y si lo encuentra incrementa en 1 la cantidad de alumnos modificados y se modifica.
	$alumnos_query = $idiomas->query("SELECT matricula FROM tbl_matriculas WHERE matricula = ".$matricula));
	$alumno = $alumnos_query->fetch_assoc();
	$total_alumno = mysql_num_rows($alumnos_query);
	if($alumno->num_rows > 0) {
		//Se modifican las horas de cada alumno
		$idiomas->query("UPDATE tbl_matriculas SET hora = ".$horas." WHERE matricula = ".$matricula,$idiomas);	
		$contadorInicial = $contadorInicial + 1; 
	}
}
//Cerramos el archivo
fclose($handle);

$fecha= date ("Y-m-d");
echo $fecha;
$idiomas->query("INSERT INTO tbl_fecha VALUES ('". $fecha ."')", $idiomas);
//
//Cerramos conexion con la base de datos
closeConection($idiomas);
	
?> 
<p class="title" align="center">Se ha actualizado la informacion de <?echo $contadorInicial ?> alumnos.</p>
<br><br>