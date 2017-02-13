
		<p class="title" align="center">Las siguientes matr&iacute;culas fueron dadas de alta</p>
		<table align="center" class="contenido">
			<tr class="titulo">
				<td class="titulo">#</td>
				<td class="titulo">Matr&iacute;cula</td>
				<td class="titulo">Cantidad</td>
			</tr>
<?php
//Abriendo conexion con la base de datos
$idiomas = getConection();

//Contador de alumnos
$contadorInicial = 0;

$uploaddir = 'alumnos/';	
$uploadfile = $uploaddir . $_FILES['alumnos']['name'];	
	
move_uploaded_file($_FILES['alumnos']['tmp_name'], $uploadfile);
$num_iguales = 0;

//Abrimos el archivo
$handle = fopen($uploadfile, "r");
while($string = fgets($handle))
{
	$contadorInicial = $contadorInicial + 1;
	$stringx = str_replace('\'', '', $string);
	$str_aux = str_replace(' ', '_', $stringx);
	$str_aux2 = sscanf($str_aux, "%s\t%s\t%s\t%s\n");

	list ($matriculax, $cantidadx) = $str_aux2;
	
	$alumnos_query = mysql_query("SELECT matricula FROM tbl_matriculas WHERE matricula = $matriculax", $idiomas) or die(mysql_error());
	$alumno = mysql_fetch_assoc($alumnos_query);
	$total_alumno = mysql_num_rows($alumnos_query);

	if($total_alumno == 0)
	{
		mysql_query("INSERT INTO tbl_matriculas (matricula, cantidad, password) VALUES (". $matriculax .", ". $cantidadx .", '". $matriculax . "')", $idiomas);		
			echo '<tr class="contenido">
				<td class="barraArriba" align="center">' . $contadorInicial . '</td>
				<td class="barraArriba" align="center">' . $matriculax . '</td>
				<td class="barraArriba" align="center">' . $cantidadx . '</td>
				</tr>';
	}
	else
	{
		mysql_query("UPDATE tbl_matriculas set cantidad = $cantidadx WHERE matricula = $matriculax",$idiomas);		
			echo '<tr class="contenido">
				<td class="barraArriba">' . $contadorInicial . '</td>
				<td class="barraArriba">' . $matriculax . '</td>
				<td class="barraArriba">' . $cantidadx . '</td>
				</tr>';
	}
}
//Cerramos el archivo
fclose($handle);

//Cerramos conexion con la base de datos
closeConection($idiomas);
	
?> 
</table>
<br><br>