<?php ?>
<?
if(($_SESSION['user'] == null && $_SESSION['user'] == '') || !hasChangedPassword()) { ?>
<script>
	location.href = 'index.php?p=uDes';
</script>
<? }
$idiomas = getConection();
//Para sacar las reservaciones próximas
	//$query_reservaciones_semanas = "SELECT * FROM tbl_reservaciones WHERE matricula = ".$_SESSION['user']." AND semana IN ( SELECT DISTINCT semana FROM tbl_semanas)";
	$reservaciones_array = $idiomas->query("SELECT * FROM tbl_reservaciones WHERE matricula = ".$_SESSION['user']." AND semana IN ( SELECT DISTINCT semana FROM tbl_semanas)");
	//$num_reservaciones = mysql_num_rows($reservaciones_array);
?>

<div class="title-multilingual">proceso_reservaciones</div>
<table width="900px">
	<tr>
		<td align="left" width="650px">
			<div style="width:600px"  class="content">
			<br>
			<div align="justify">
				<p class="multilingual">mensaje_reservacion</p>
				<br /><br />	
				<li class="multilingual">selecciona_dia</li> 
				<li class="multilingual">selecciona_salon</li>
				<!--<li>Selecciona el salón 422.</li>-->
				<li class="multilingual">selecciona_hora</li> 
		 
				<br /><br /><br /><br />
				<br /><br /><br /><br />
		
				<div align="center">
					<button name="reservacionesButton" class="multilingual" onclick="location.href='index.php?p=semanas'">continuar</button>
				</div>
			</div>
			</div>
		</td>
		<td align="left">
			<div class="bordeAzul content" style="width:250px; height:350px; margin:10px; overflow:auto;">
			<p class="multilingual">
				
				<? if ($reservaciones_array->num_rows > 0) {?>
					&nbsp;&nbsp;Tus reservaciones próximas:
					<br><br>
					
					<? while ($reservacion = $reservaciones_array->fetch_assoc()) { ?>
						<li><? echo $reservacion['dia'] . ' ' . $reservacion['mes'] ;  ?><br>
							&nbsp;&nbsp;&nbsp;&nbsp;Hora: <? echo $reservacion['hora']; ?> <br>
							&nbsp;&nbsp;&nbsp;&nbsp;SalónClick="return confirmarCancelacion();" href="index.php?p=cancelacion&i=<? echo $reservacion['id']; ?>&s=<? echo $reservacion['semana']; ?>">Cancelar</a>
						</li> 
						<br><br>
					<? } ?>
				<? } else { ?>
					no_reservaciones
				<? } ?>
				</p>
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