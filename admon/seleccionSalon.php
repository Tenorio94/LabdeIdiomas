<?php
	$dia = $_GET["d"];
	$mes = $_GET["m"];
	$sem = $_GET["s"];
	$diasem = $_GET["ds"];
?>
<table align="center" class="contenido">
	<tr>
		<td align="center" class="title">Selecci&oacute;n de Horario<br><br></td>
	</tr>
</table>    
<table border="1" align="center" bgcolor="#FFFFCC">
	<tr bgcolor="#CCFF66">
		<td>
			<p class="Estilo1"><strong><a href="index.php?p=salon423&d=<?php echo $dia .'&m=' . $mes . '&s=' . $sem . '&ds=' . $diasem;?>">Sal&oacute;n 423</a></strong></p>
			<p class="Estilo1" align="left"><strong>Horario: <br> 10:00 a 17:00</strong></p>
		</td>
		<td></td>
		<td>
			<p align="center" class="Estilo1"><strong><a href="index.php?p=salon424&d=<?php echo $dia .'&m=' . $mes . '&s=' . $sem . '&ds=' . $diasem;?>">Sal&oacute;n 424</a></strong></p>
			<p class="Estilo1" align="left"><strong>Horario: <br> 8:00 a 19:00 </strong></p>
		</td>
	</tr>
</table>







