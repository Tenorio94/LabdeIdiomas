<?php
//Abriendo conexion con la base de datos
$idiomas = getConection();

//Contador de alumnos
$contadorInicial = 0;

//Contador de alumons nuevos
$contadorNuevos=0;

//Establece el idioma
$idioma=0;

$uploaddir = 'horas/';	
$uploadfile = $uploaddir . $_FILES['alumnos']['name'];	
	
move_uploaded_file($_FILES['alumnos']['tmp_name'], $uploadfile);
$num_iguales = 0;

$QUERY="INSERT INTO tbl_horas (matricula, periodo, idioma, horas) VALUES";
//Abrimos el archivo
$handle = fopen($uploadfile, "r");

//Se guardan los alumnos que se han procesado
$alumnos;

//Obtener el periodo
$periodo=$_POST["periodo"];
if(!isset($periodo)||$periodo=="") $periodo=1;
$periodo-=1;

while($string = fgets($handle))
{
	// Si es una oración que marca que se va a recibir ahora, entonces se establece el tipo de idioma que se va a guardar ahora.
	if(strpos($string, "Resultados")!==false) {
		//echo $string;
		if(strpos($string, "Ing")!==false) {
			$idioma="00";
		}
		else if(strpos($string, "Ale")!==false) {
			$idioma="10";
		}
		else if(strpos($string, "Ita")!==false) {
			$idioma="20";
		}
		else if(strpos($string, "Esp")!==false) {
			$idioma="30";
		}
		else if(strpos($string, "Fra")!==false) {
			$idioma="40";
		}
		//echo " ". $idioma ." ";
	}
	else {
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
		
		if(!is_numeric($matricula)) {
			$matricula= substr($matricula, 0, -1);
		}

		//Solucion temporal a matriculas, verifica si es valido y si no lo es, lo ignora
		if(is_numeric($matricula)) {
			//Se verifica si ya se agrego el alumno para ponerle idioma next, sino se le pone 0.
			if(!isset($alumnos[$matricula])||$alumnos[$matricula]=="") {
				$alumnos[$matricula]=0;
			}
			else {
				$alumnos[$matricula]=$alumnos[$matricula]+1;				
			}
			//Se agrega a una query, es importante que sea una para evitar overhead de commits.
			$QUERY.=" (".$matricula .", ". $periodo .", ". ($idioma+$alumnos[$matricula]) .", '". $total . "'),"; //El idioma se guarda como el idioma mas la cantidad de veces que lleva el idioma.
			$contadorInicial=$contadorInicial+1;
		}
	}
}
//Cerramos el archivo
fclose($handle);
$idiomas->query( substr($QUERY, 0, -1)." ON DUPLICATE KEY UPDATE horas=VALUES(horas)");
$fecha = date("Y-m-d H:i:s");
echo $fecha;
$idioms->query("INSERT INTO tbl_fecha VALUES ('". $fecha ."')");
//
//Cerramos conexion con la base de datos
closeConection($idiomas);
	
?> 
<p class="title" align="center">Se ha actualizado la informacion de <?echo $contadorInicial ?> alumnos.</p>
<p class="title" align="center">El periodo es <?echo $periodo+1 ?>.</p>
<br><br>