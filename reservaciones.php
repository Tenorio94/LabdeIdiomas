<?php ?>
<?
if(($_SESSION['user'] == null && $_SESSION['user'] == '') || !hasChangedPassword()) { ?>
<script>
	location.href = 'index.php?p=uDes';
</script>
<? }
$idiomas = getConection();
//Para sacar las reservaciones pr�ximas
	//$query_reservaciones_semanas = "SELECT * FROM tbl_reservaciones WHERE matricula = ".$_SESSION['user']." AND semana IN ( SELECT DISTINCT semana FROM tbl_semanas)";
	$reservaciones_array = $idiomas->query("SELECT * FROM tbl_reservaciones WHERE matricula = ".$_SESSION['user']." AND semana IN ( SELECT DISTINCT semana FROM tbl_semanas)");
	//$num_reservaciones = mysql_num_rows($reservaciones_array);
?>

<div class="title">Proceso de Reservaciones</div>
<table width="900px">
	<tr>
		<td align="left" width="650px">
			<div style="width:600px"  class="content">
			<br>
			<div align="justify">
					A continuaci�n se detalla el procedimiento para realizar tu reservaci�n para el laboratorio de idiomas.
				<br /><br />	
					<li>Selecciona el d�a de la semana.</li> 
				<li>Selecciona el sal�n 424.</li>
				<!--<li>Selecciona el sal�n 422.</li>-->
				<li>Selecciona la hora en el men� deslizante y oprime el bot�n "Aceptar".</li> 
		 
				<br /><br /><br /><br />
				<br /><br /><br /><br />
		
				<div align="center"><input name="reservacionesButton" type="button" value="Continuar >>" onClick="location.href='index.php?p=semanas'" /></div>
			</div>
			</div>
		</td>
		<td align="left">
			<div class="bordeAzul content" style="width:250px; height:350px; margin:10px; overflow:auto;">
				<br>
				<? if ($reservaciones_array->num_rows > 0) {?>
					&nbsp;&nbsp;Tus reservaciones pr�ximas:
					<br><br>
					
					<? while ($reservacion = $reservaciones_array->fetch_assoc()) { ?>
						<li><? echo $reservacion['dia'] . ' ' . $reservacion['mes'] ;  ?><br>
							&nbsp;&nbsp;&nbsp;&nbsp;Hora: <? echo $reservacion['hora']; ?> <br>
							&nbsp;&nbsp;&nbsp;&nbsp;Sal�n: <? echo $reservacion['salon']; ?> <br>
							&nbsp;&nbsp;&nbsp;&nbsp;<a onClick="return confirmarCancelacion();" href="index.php?p=cancelacion&i=<? echo $reservacion['id']; ?>&s=<? echo $reservacion['semana']; ?>">Cancelar</a>
						</li> 
						<br><br>
					<? } ?>
				<? } else { ?>
					No tienes reservaciones pr�ximas.
				<? } ?>
			</div>
		</td>
	</tr>
</table>
<? closeConection($idiomas);?>
<script>
	function confirmarCancelacion() {
		var ok = confirm("�Deseas continuar con la cancelaci�n de tu reservaci�n?");
		if(ok) {
			return true;
		}
		return false;
	}
</script>