<?php
$dia = $_GET["d"];
$mes = $_GET["m"];
$sem = $_GET["s"];
$diasem = $_GET["ds"];

$idiomas = getConection();

function getReservacionPorHora($hora, $dia, $mes)
{
	global $idiomas;
	//Abrimos la conexion a la base de datos
	if($idiomas == NULL) 
		$idiomas = getConection();

	$reservacion_query = $idiomas->query("SELECT matricula FROM tbl_reservaciones WHERE dia = $dia and hora = $hora and salon = 424 and mes = '$mes'");
	return $reservacion_query;
}

$reservacion8 = getReservacionPorHora(8, $dia, $mes);
$reservacion9 = getReservacionPorHora(9, $dia, $mes);
$reservacion10 = getReservacionPorHora(10, $dia, $mes);
$reservacion11 = getReservacionPorHora(11, $dia, $mes);
$reservacion12 = getReservacionPorHora(12, $dia, $mes);
$reservacion13 = getReservacionPorHora(13, $dia, $mes);
$reservacion14 = getReservacionPorHora(14, $dia, $mes);
$reservacion15 = getReservacionPorHora(15, $dia, $mes);
$reservacion16 = getReservacionPorHora(16, $dia, $mes);
$reservacion17 = getReservacionPorHora(17, $dia, $mes);
$reservacion18 = getReservacionPorHora(18, $dia, $mes);

?>

<div align="center">
  <form name="form3" method="POST" action="index.php?p=preservaciones&salon=424&d=<?php echo $dia .'&m=' . $mes . '&s=' . $sem . '&ds=' . $diasem .'&salonotro=423';?>">
    <table align="center" class="titulo">
		<tr>
			<td>Horario Disponible</td>
		</tr>
	</table>
    <table width="43%" border="1" align="center" class="contenido">
      <tr bgcolor="#CCFF66"> 
	<th width="46" scope="col">Equipo</th>
        <th width="48" scope="col">8:00</th>
        <th width="48" scope="col">9:00</th>
	<th width="48" scope="col">10:00</th>
        <th width="48" scope="col">11:00</th>
        <th width="49" scope="col">12:00</th>
        <th width="48" scope="col">13:00</th>
        <th width="48" scope="col">14:00</th>
        <th width="48" scope="col">15:00</th>
        <th width="49" scope="col">16:00</th>
        <th width="48" scope="col">17:00</th>
	<th width="48" scope="col">18:00</th>
      </tr>
      <?php $i = 0; while ($i<40){ ?>
      <tr> 
        <th bgcolor="#CCFF66" scope="row"> 
          <?php $i = $i+1; echo $i ?>
        </th>
        <td><?php $row_reservacion8 = $reservacion8->fetch_assoc(); echo $row_reservacion8['matricula']; ?>&nbsp;</td>
        <td><?php $row_reservacion9 = $reservacion9->fetch_assoc(); echo $row_reservacion9['matricula']; ?>&nbsp;</td>
        <td><?php $row_reservacion10 = $reservacion10->fetch_assoc(); echo $row_reservacion10['matricula']; ?>&nbsp;</td>
        <td><?php $row_reservacion11 = $reservacion11->fetch_assoc(); echo $row_reservacion11['matricula']; ?>&nbsp;</td>
        <td><?php $row_reservacion12 = $reservacion12->fetch_assoc(); echo $row_reservacion12['matricula']; ?>&nbsp;</td>
        <td><?php $row_reservacion13 = $reservacion13->fetch_assoc(); echo $row_reservacion13['matricula']; ?>&nbsp;</td>
        <td><?php $row_reservacion14 = $reservacion14->fetch_assoc(); echo $row_reservacion14['matricula']; ?>&nbsp;</td>
        <td><?php $row_reservacion15 = $reservacion15->fetch_assoc(); echo $row_reservacion15['matricula']; ?>&nbsp;</td>
        <td><?php $row_reservacion16 = $reservacion16->fetch_assoc(); echo $row_reservacion16['matricula']; ?>&nbsp;</td>
        <td><?php $row_reservacion17 = $reservacion17->fetch_assoc(); echo $row_reservacion17['matricula']; ?>&nbsp;</td>
	<td><?php $row_reservacion18 = $reservacion18->fetch_assoc(); echo $row_reservacion18['matricula']; ?>&nbsp;</td>
      </tr>
      <?php }  ?>
    </table>
    <p>&nbsp;</p>
	<table align="center" class="contenido">
		<tr>
			<td><p>Horarios 
				  <select name="hora" id="hora" onFocus="verificaMat();">
  					<option value="8">8:00</option>
					<option value="9">9:00</option>					
					<option value="10">10:00</option>
					<option value="11">11:00</option>
					<option value="12">12:00</option>
					<option value="13">13:00</option>
					<option value="14">14:00</option>
					<option value="15">15:00</option>
					<option value="16">16:00</option>
					<option value="17">17:00</option>
					<option value="18">18:00</option>
				  </select>
				</p>
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="Submit" value="Aceptar">
				  <input type="checkbox" name="cancelarReservacion" value="cancelar"> Cancelar Reservaciones <br>
				  <input type="hidden" name="hiddensalon" value="424">
				  <input type="hidden" name="hiddendia" value="<?php echo $_GET['d']; ?>">
				  <input type="hidden" name="hiddenmes" value="<?php echo $_GET['m']; ?>">
				  <input type="hidden" name="hiddensemana" value="<?php echo $_GET['s']; ?>">
			</td>
		</tr>
	</table>
  </form>
</div>
<?php

//Cerramos la conexion
global $idiomas;
closeConection($idiomas);
?>