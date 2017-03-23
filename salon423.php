<?php
if(($_SESSION['user'] == null && $_SESSION['user'] == '') || !hasChangedPassword()) { ?>
<script>
	location.href = 'index.php?p=uDes';
</script>
<? }
//agarro las variables que traigo de la pagina pasada.
 $dia = $_REQUEST["d"];
 $mes = $_REQUEST["m"];
 $sem = $_REQUEST["s"]; 
 
 function getReservacionPorHora($hora, $dia, $mes)
{
	//Abrimos la conexion a la base de datos
	if($idiomas == NULL) 
		$idiomas = getConection();

	$reservacion_query = $idiomas->query("SELECT matricula FROM tbl_reservaciones WHERE dia = $dia and hora = $hora and salon = 422 and mes = '$mes'");
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

<style type="text/css">
<!--
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #333333;
}
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: small; }
.style6 {
	font-size: x-small;
	font-weight: bold;
}
.style7 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: x-small;
	font-weight: bold;
}
.style8 {color: #FFFFFF}
.style9 {font-size: x-small}
.style10 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style11 {color: #FFFFFF; font-size: x-small; }
.style14 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: xx-small; font-weight: bold; color: #FFFFFF; }
.style16 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: x-small; color: #000000; }
.style18 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: x-small; color: #FFFFFF; }

-->
</style>
<div align="center">
  <form name="form3" method="POST" action="index.php?p=exito&sa=423&d=<?php echo $dia .'&m=' . $mes . '&s=' . $sem;?>">
    <div class="title">Paso # 3: Selecciona el horario</p>
	<table width="43%" border="1" align="center">
		<tr bgcolor="#336699"> 
			<th width="46" bgcolor="#336699" scope="col"><div align="center" class="style8 style9"><span class="style10">Equipo</span></div></th>
			<th width="48" scope="col" align="center" class="columnHeader">8:00</th>
			<th width="48" scope="col" align="center" class="columnHeader">9:00</th>
			<th width="48" scope="col" align="center" class="columnHeader">10:00</th>
			<th width="48" scope="col" align="center" class="columnHeader">11:00</th>
			<th width="49" scope="col" align="center" class="columnHeader">12:00</th>
			<th width="48" scope="col" align="center" class="columnHeader">13:00</th>
			<th width="48" scope="col" align="center" class="columnHeader">14:00</th>
			<th width="48" scope="col" align="center" class="columnHeader">15:00</th>
			<th width="49" scope="col" align="center" class="columnHeader">16:00</th>
			<th width="48" scope="col" align="center" class="columnHeader">17:00</th>
			<th width="48" scope="col" align="center" class="columnHeader">18:00</th>
		</tr>
      	<? $i = 0; while ($i<30){ ?>
      	<tr> 
        <th bgcolor="#336699" scope="row"> 
          	<span class="style18">
          		<?php $i = $i+1; echo $i ?>
        	</span>        
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
    <p><span class="style7">Horarios 
    </span>
      <select name="hora" id="hora">
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
    <tr> 
      <th scope="row"> <input type="submit" name="Submit" value="Aceptar">
      </th>
      <input type="hidden" name="hiddensalon" value="423">
      <input type="hidden" name="hiddendia" value="<?php echo $_REQUEST['d']; ?>">
      <input type="hidden" name="hiddenmes" value="<?php echo $_REQUEST['m']; ?>">
	   <input type="hidden" name="hiddensemana" value="<?php echo $_REQUEST['s']; ?>">
      <td> <div align="center"> </div>
  </form>
  </td>
    </tr>
  <p>&nbsp;</p>
</div>

<?php

//Cerramos la conexion
closeConection($idiomas);
?>