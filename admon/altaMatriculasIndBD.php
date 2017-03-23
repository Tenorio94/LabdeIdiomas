<?php
//Obtenemos la informacion de la forma
$matricula = $_POST["matricula"];
$cantidad = $_POST["cantidad"];

//Abrimos conexion con la base de datos
$idiomas = getConection();

//Obteniendo informacion del alumno ( para ver si ya esta en la base de datos

$query_alumno = $idiomas->query("SELECT matricula FROM tbl_matriculas WHERE matricula = $matricula");
$alumno = $query_alumno->fetch_assoc();
$total_alumno = $query_alumno->num_rows;

//Para validar si se realiza o no la transaccion
$transactionSucceded = false;

//Si la  matricula no es vacia
if($matricula != "") {
	if($total_alumno == 0)
	{
		if($idiomas->query("INSERT INTO tbl_matriculas (matricula, cantidad, password) VALUES (". $matricula .", ". $cantidad .", '".$matricula."')")) 
			$transactionSucceded = true;
	}
	else
	{
		if($idiomas->query("UPDATE tbl_matriculas set cantidad = $cantidad WHERE matricula = $matricula"))
			$transactionSucceded = true;
	}
}
//Cerramos la conexion
closeConection($idiomas);

//Si se realizo la transaccion, entonces se despliega el mensaje.
if($transactionSucceded) {
?> 
	<p class="titulo" align="center">La siguiente matr&iacute;cula fue dada de alta</p>
	<table align="center" class="contenido" border="1">
		<tr class="title">
			<td class="title">Matr&iacute;cula</td>
			<td class="title">Cantidad</td>
		</tr>
		<tr class="contenido">
			<td class="barraArriba"><?  echo $matricula; ?></td>
			<td class="barraArriba"><? echo $cantidad; ?> </td>
		</tr>
	</table>
	<br><br>
<? } ?>