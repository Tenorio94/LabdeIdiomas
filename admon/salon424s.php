<?php
$dia = $HTTP_GET_VARS["d"];
$mes = $HTTP_GET_VARS["m"];
$sem = $HTTP_GET_VARS["s"];
$diasem = $HTTP_GET_VARS["ds"];

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

$reservacion10 = getReservacionPorHora(10, $dia, $mes);
$reservacion11 = getReservacionPorHora(11, $dia, $mes);
$reservacion12 = getReservacionPorHora(12, $dia, $mes);
$reservacion13 = getReservacionPorHora(13, $dia, $mes);
$reservacion14 = getReservacionPorHora(14, $dia, $mes);
?>

<div align="center"> 
  <form name="form3" method="POST" action="preservaciones.php?salon=424&d=<?php echo $dia .'&m=' . $mes . '&s=' . $sem . '&ds=' . $diasem .'&salonotro=423';?>">
    <table align="center" class="titulo">
		<tr>
			<td>Horario Disponible</td>
		</tr>
	</table>
    <table border="1" align="center" class="contenido">
      <tr bgcolor="#CCFF66"> 
        <th width="46" scope="col">Equipo</th>
       
        <th width="48" scope="col">10:00</th>
        <th width="48" scope="col">11:00</th>
        <th width="49" scope="col">12:00</th>
        <th width="48" scope="col">13:00</th>
        <th width="48" scope="col">14:00</th>
        
      </tr>
      <?php $i = 0; while ($i<32){ ?>
      <tr> 
        <th bgcolor="#CCFF66" scope="row"> 
          <?php $i = $i+1; echo $i ?>
        </th>
        <td><?php $row_reservacion10 = $reservacion10->fetch_assoc(); echo $row_reservacion10['matricula']; ?>&nbsp;</td>
        <td><?php $row_reservacion11 = $reservacion11->fetch_assoc(); echo $row_reservacion11['matricula']; ?>&nbsp;</td>
        <td><?php $row_reservacion12 = $reservacion12->fetch_assoc(); echo $row_reservacion12['matricula']; ?>&nbsp;</td>
        <td><?php $row_reservacion13 = $reservacion13->fetch_assoc(); echo $row_reservacion13['matricula']; ?>&nbsp;</td>
        <td><?php $row_reservacion14 = $reservacion14->fetch_assoc(); echo $row_reservacion14['matricula']; ?>&nbsp;</td>
       
      </tr>
      <?php }  ?>
	  
    </table>
    <p>&nbsp;</p>
    <p class="contenido">Horarios 
      <select name="hora" id="hora">
        <option value="10">10:00</option>
        <option value="11">11:00</option>
        <option value="12">12:00</option>
        <option value="13">13:00</option>
        <option value="14">14:00</option>
        
      </select>
    </p>
    <tr> 
      <th scope="row"> <input type="submit" name="Submit" value="Aceptar" onClick="valida();">
      </th>
      <input type="hidden" name="hiddensalon" value="424">
      <input type="hidden" name="hiddendia" value="<?php echo $HTTP_GET_VARS['d']; ?>">
      <input type="hidden" name="hiddenmes" value="<?php echo $HTTP_GET_VARS['m']; ?>">
	   <input type="hidden" name="hiddensemana" value="<?php echo $HTTP_GET_VARS['s']; ?>">
      <td> <div align="center"> </div> <input type="hidden" name="MM_insert" value="form3">
  </form>
  </td>
    </tr>
  </table>
</div>
<?php

//Cerramos la conexion
global $idiomas;
closeConection($idiomas);
?>
