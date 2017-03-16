<?php
<?
if(($_SESSION['user'] == null && $_SESSION['user'] == '') || !hasChangedPassword()) { ?>
<script>
	location.href = 'index.php?p=uDes';
</script>
<? }
$idiomas = getConection();
//Para sacar las reservaciones próximas
	$query_reservaciones_semanas = "SELECT * FROM tbl_reservaciones WHERE matricula = ".$_SESSION['user']." AND semana IN ( SELECT DISTINCT semana FROM tbl_semanas)";
	$reservaciones_array = mysql_query($query_reservaciones_semanas, $idiomas) or die(mysql_error());
	$num_reservaciones = mysql_num_rows($reservaciones_array);
?>

<div class="title">Proceso de Reservaciones</div>
<table width="900px">
	<tr>
		<td align="left" width="650px">
			<div style="width:600px"  class="content">
			<br>
			<div align="justify">
					A continuación se detalla el procedimiento para realizar tu reservación para el laboratorio de idiomas.
				<br /><br />
					<li>Selecciona el día de la semana.</li> 
				<li>Selecciona el salón 424.</li>
				<!--<li>Selecciona el salón 422.</li>-->
				<li>Selecciona la hora en el menú deslizante y oprime el botón "Aceptar".</li> 
		 
				<br /><br /><br /><br />
				<br /><br /><br /><br />
		
				<div align="center"><input name="reservacionesButton" type="button" value="Continuar >>" onClick="location.href='index.php?p=semanas'" /></div>
			</div>
			</div>
		</td>
		<td align="left">
			<div class="bordeAzul content" style="width:250px; height:350px; margin:10px; overflow:auto;">
				<br>
				<? if ($num_reservaciones > 0) {?>
					&nbsp;&nbsp;Tus reservaciones próximas:
					<br><br>
					
					<? while ($reservacion = mysql_fetch_array($reservaciones_array)) { ?>
						<li><? echo $reservacion['dia'] . ' ' . $reservacion['mes'] ;  ?><br>
							&nbsp;&nbsp;&nbsp;&nbsp;Hora: <? echo $reservacion['hora']; ?> <br>
							&nbsp;&nbsp;&nbsp;&nbsp;Salón: <? echo $reservacion['salon']; ?> <br>
							&nbsp;&nbsp;&nbsp;&nbsp;<a onClick="return confirmarCancelacion();" href="index.php?p=cancelacion&i=<? echo $reservacion['id']; ?>&s=<? echo $reservacion['semana']; ?>">Cancelar</a>
						</li> 
						<br><br>
					<? } ?>
				<? } else { ?>
					No tienes reservaciones próximas.
				<? } ?>
			</div>
		</td>
	</tr>
</table>
<? closeConection($idiomas);?>
<script>
	function confirmarCancelacion() {
		var ok = confirm("¿Deseas continuar con la cancelación de tu reservación?");
		if(ok) {
			return true;
		}
		return false;
	}
</script>