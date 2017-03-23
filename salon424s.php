<?php 
if(($_SESSION['user'] == null && $_SESSION['user'] == '') || !hasChangedPassword()) { ?>
<script>
	location.href = 'index.php?p=uDes';
</script>
<? }

 $dia = $_REQUEST["d"];
 $mes = $_REQUEST["m"];
 $sem = $_REQUEST["s"];

function getReservacionPorHora($hora, $dia, $mes)
{
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
<style type="text/css">
<!--
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #333333;
}
.style7 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: x-small;
	font-weight: bold;
}
.style10 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: xx-small;
	font-weight: bold;
	color: #FFFFFF;
}
.style15 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: x-small; color: #FFFFFF; }
.style12 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: x-small; color: #000000;}
-->
</style>

<div align="center">
  <form name="form3" method="POST" action="index.php?p=exito&sa=424&d=<?php echo $dia .'&m=' . $mes . '&s=' . $sem;?>" >
    <p class="style2">Paso # 3: Selecciona el horario</p>
    <table width="43%" border="1" align="center">
      <tr bgcolor="#336699"> 
        <th width="46" scope="col"><span class="style15">Equipo</span></th>
       
        <th width="48" scope="col"><span class="style15">10:00</span></th>
        <th width="48" scope="col"><span class="style15">11:00</span></th>
        <th width="49" scope="col"><span class="style15">12:00</span></th>
        <th width="48" scope="col"><span class="style15">13:00</span></th>
        <th width="48" scope="col"><span class="style15">14:00</span></th>
        
      </tr>
      <?php $i = 0; while ($i<40){ ?>
      <tr> 
        <th bgcolor="#336699" scope="row"> 
		<span class="style15">
          <?php $i = $i+1; echo $i ?></span>
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
    <p><span class="style7">Horarios</span>      <select name="hora" id="hora" >
        <option value="10">10:00</option>
        <option value="11">11:00</option>
        <option value="12">12:00</option>
        <option value="13">13:00</option>
        <option value="14">14:00</option>
        
      </select>
    </p>
    <tr> 
      <th scope="row"> <input type="submit" name="Submit" value="Aceptar" >
      </th>
      <input type="hidden" name="hiddensalon" value="424">
      <input type="hidden" name="hiddendia" value="<?php echo $_REQUEST['dia']; ?>">
      <input type="hidden" name="hiddenmes" value="<?php echo $_REQUEST['mes']; ?>">
	   <input type="hidden" name="hiddensemana" value="<?php echo $_REQUEST['sem']; ?>">
      <td>   </form>
  </td>
    </tr>
</table>
<?php

//Cerramos la conexion
closeConection($idiomas);
?>
