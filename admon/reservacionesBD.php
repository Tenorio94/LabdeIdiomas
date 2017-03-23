<?php
//Obtenemos la informacion
$fecha = getdate(); 
$hora = $_POST["hora"];
$cancelarReservacion = $_POST["cancelarReservacion"];
$dia = $HTTP_GET_VARS["d"];
$mes = $HTTP_GET_VARS["m"];
$sem = $HTTP_GET_VARS["s"];
$diasem = $HTTP_GET_VARS["ds"];
$salon = $HTTP_GET_VARS["salon"];
$salonotro = $HTTP_GET_VARS["salonotro"]; 

//Abrimos conexion con la base de datos
$idiomas = getConection();
	
//**********************************************************************************************************
//Obtenemos la informacion del salon en el que se quiere hacer la reservacion
$reservacion_salon = $idiomas->query("SELECT matricula FROM tbl_reservaciones WHERE semana = $sem AND dia = $dia AND mes = '$mes' AND salon = $salon AND hora = $hora");
$row_query32 = $reservacion_salon->fetch_assoc();
$total_reservacion_salon = $reservacion_salon->num_rows;
	
//Obtenemos la informacion del otro salon disponible
$reservacion_salon_otro = $idiomas->query("SELECT matricula FROM tbl_reservaciones WHERE semana = $sem AND dia = $dia AND mes = '$mes' AND hora = $hora AND salon = $salonotro");
$row_Recordset1 = $reservacion_salon_otro->fetch_assoc();
$total_reservacion_salon_otro = $reservacion_salon_otro->num_rows;
//**********************************************************************************************************

//--------------------------------------------------------------------------------------------------------
/* subject */
$subject = "Cambio en Reservaci�n :: Laboratorio de Idiomas";

/* message */
$message = '
<html>
<head>
<title>Laboratorio de Idiomas :: Confirmaci�n</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<table width="75%" border="0" align="center">
  <tr>
    <td><p align="center"><font size="4"><strong>Hubo un cambio en tu sal�n para el Laboratorio de Idiomas</strong></font></p>
      <table width="40%" border="1" align="center">
        <tr> 
          <td bgcolor="#CCFF66"><strong>D&iacute;a:</strong></td>
          <td bgcolor="#CCFF66">' . $dia . " de " . $mes . '&nbsp; </td>
        </tr>
        <tr> 
          <td bgcolor="#CCFF66"><strong>Hora:</strong></td>
          <td bgcolor="#CCFF66">' . $hora . ':00' . '&nbsp; </td>
        </tr>
        <tr> 
          <td bgcolor="#CCFF66"><strong>Sal&oacute;n:</strong></td>
          <td bgcolor="#CCFF66">' . "CIAP - " . $salonotro . '&nbsp; </td>
        </tr>
      </table>
</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>';

$mensageResultado = "Tu reservaci&oacuten ha sido realizada con &eacutexito";
$mensageReserva="Reservados";
$lugres=0;

/* To send HTML mail, you can set the Content-type header. */
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: Laboratorio de Idiomas <iaranda@itesm.mx>\r\n";
//--------------------------------------------------------------------------------------------------------

//--------------------------------INICIA EL PROGRAMA -------------------------------//

?>
<?php
   //Valida que la reservacion sea a futuro
	 if(($fecha["hours"] >= $hora)&&($fecha["mday"] == $dia))
	 {
?> 		<table border="0" align="center" class="contenido">
  			<tr>
			    <td><p class="titulo">Lo sentimos, tu reservaci�n debe ser a pasado.</p>
					</td>
			  </tr>
			</table>
			<p>&nbsp;</p>
<?php
		}
		else //Paso la primer prueba
		{
			// Si se quiere cancelar las reservaciones de ese dia
			if($cancelarReservacion=="cancelar") {
				$mensageReserva="Cancelados";
				$mensageResultado = "Tu cancelaci&oacuten ha sido realizada con &eacutexito";
				$lugres = $ocupados_salon = $total_reservacion_salon; //J Lugares ocupados en el salon en cuestion
				while($ocupados_salon>0) //si hay alguien ya inscrito en ese salon...
				{
						$mat = $row_query32['matricula']; 
						$deleteSQL = "DELETE FROM tbl_reservaciones WHERE matricula = '" . $mat . "' AND salon = " . $salon . " AND dia = " . $dia . " AND hora = " . $hora . " AND semana = " . $sem . ";" ;
						$idiomas->query($deleteSQL);
						$row_query32 = $reservacion_salon->fetch_assoc();
						$ocupados_salon = $ocupados_salon - 1;
				}
			}
			else {
	 			//Verifique que no este lleno a esa hora el salon
				if($total_reservacion_salon < 40)
				{
					//Salon 424 :: Horario 10 - 17
					if(($diasem == "sabado") || ($salon == 423 && ($hora == 8 || $hora == 9 || $hora == 18)))
					{
							$lugres = 40;
							$i = 0; 
							$ocupados_salon = $total_reservacion_salon ; //J Lugares ocupados en el salon en cuestion
							if($ocupados_salon == 0) //Para llenar los 32 con reservado
							{
									$f = 0; //Simple  contador
									while ($f<40)
									{
										$mat = "Reservado"; 
										$insertSQL = "INSERT INTO tbl_reservaciones (matricula, salon, dia, hora, mes, semana) VALUES ('". $mat ."', " . $salon . ", " . $dia . ", " . $hora . ", '" .$mes . "', " . $sem. ");";
										$idiomas->query($insertSQL);
										$f = $f + 1;
									}
									$lugres = 40;
							}
							else
							{
								$f = 0;
								$t = 40 - $ocupados_salon;
								while ($f<$t)
								{
									$mat = "Reservado"; 
									$insertSQL = "INSERT INTO tbl_reservaciones (matricula, salon, dia, hora, mes, semana) VALUES ('". $mat ."', " . $salon . ", " . $dia . ", " . $hora . ", '" .$mes . "', " . $sem. ");";
									$idiomas->query($insertSQL);
									$f = $f + 1;
								}
								$lugres = $t;
							}					
					}
					else
					{
////////////////////
							$lugres = 40;
							$libres_otro = 40 - $total_reservacion_salon_otro; // Lugares libres en el salon contrario
							$i = 0; 
							$ocupados_salon = $total_reservacion_salon; //J Lugares ocupados en el salon en cuestion
							while($ocupados_salon>0 && $i<$libres_otro) //si hay alguien ya inscrito en ese salon...
							{	
									$mat = $row_query32['matricula']; 
									$insertSQL = "INSERT INTO tbl_reservaciones (matricula, salon, dia, hora, mes, semana) VALUES ('". $mat ."', " . $salonotro . ", " . $dia . ", " . $hora . ", '" .$mes . "', " . $sem. ");";
									$idiomas->query($insertSQL);
									$deleteSQL = "DELETE FROM tbl_reservaciones WHERE matricula = '" . $mat . "' AND salon = " . $salon . " AND dia = " . $dia . " AND hora = " . $hora . " AND semana = " . $sem . ";" ;
									$idiomas->query($deleteSQL);
									
										 $to = $row_query32['email'];
										 if($to != null && $to != '')
											mail($to, $subject, $message, $headers);

									$row_query32 = $reservacion_salon->fetch_assoc();
									$i = $i + 1;
									$ocupados_salon = $ocupados_salon - 1;
							}
							if($ocupados_salon == 0) //Para llenar los 32 con reservado
							{
								$f = 0; //Simple  contador
								while ($f<40)
								{
									$mat = "Reservado"; 
									$insertSQL = "INSERT INTO tbl_reservaciones (matricula, salon, dia, hora, mes, semana) VALUES ('". $mat ."', " . $salon . ", " . $dia . ", " . $hora . ", '" .$mes . "', " . $sem. ");";
									mysql_select_db($database_idiomas, $idiomas);
									mysql_query($insertSQL, $idiomas) or die(mysql_error());
									$f = $f + 1;
								}
								$lugres = 40;
							}
							else
							{
								$f = 0;
								$t = 40 - $ocupados_salon;
								while ($f<$t)
								{
									$mat = "Reservado"; 
									$insertSQL = "INSERT INTO tbl_reservaciones (matricula, salon, dia, hora, mes, semana) VALUES ('". $mat ."', " . $salon . ", " . $dia . ", " . $hora . ", '" .$mes . "', " . $sem. ");";
									mysql_select_db($database_idiomas, $idiomas);
									mysql_query($insertSQL, $idiomas) or die(mysql_error());
									$f = $f + 1;
								}
								$lugres = $t;
							}
					} //*************************************** Caso normal						
				}
				else //Si ya esta lleno el salon a esa hora
				{
				$mensageResultado="Debido a que el salon esta lleno no se ha reservado nada";
				}
			}
?>
			<form name="formaexito" method="POST" action="<?php echo $editFormAction; ?>" >
			<input type="hidden" name="hiddendia" value="<?php echo $HTTP_GET_VARS['d']; ?>">
			<input type="hidden" name="hiddenmes" value="<?php echo $HTTP_GET_VARS['m']; ?>">
			<input type="hidden" name="hiddensalon" value="<?php echo $HTTP_GET_VARS['salon']; ?>">
			<input type="hidden" name="hiddenhora" value="<?php echo $_POST['hora']; ?>">
			<input type="hidden" name="hiddensemana" value="<?php echo $HTTP_GET_VARS['s']; ?>">
			<input type="hidden" name="hiddenmatricula" value="Reservado">
			<input type="hidden" name="MM_insert" value="formaexito">
			</form>
			<table width="75%" border="0" align="center" class="contenido">
				<tr>
					<td class="titulo" align="center"> <?php echo $mensageResultado ?> </td>
				</tr>
				<tr>
					<td align="center">
							<table width="40%" border="1" align="center" class="contenido">
								<tr> 
									<td bgcolor="#CCFF66" class="titulo1">D&iacute;a:</td>
									<td bgcolor="#CCFF66"><?php echo $dia . " de " . $mes; ?>&nbsp; </td>
								</tr>
								<tr> 
									<td bgcolor="#CCFF66" class="titulo1">Hora:</td>
									<td bgcolor="#CCFF66"><?php echo $hora; ?>&nbsp; </td>
								</tr>
								<tr> 
									<td bgcolor="#CCFF66" class="titulo1">Sal&oacute;n:</td>
									<td bgcolor="#CCFF66"><?php echo "CIAP - " . $salon; ?>&nbsp; </td>
								</tr>
								<tr> 
									<td bgcolor="#CCFF66" class="titulo1">Lugares <?php echo $mensageReserva ?>:</td>
									<td bgcolor="#CCFF66"><?php echo $lugres; ?>&nbsp; </td>
								</tr>
							</table>
							<form name="form1" method="post" action="">
							<table width="12%" border="0" align="center">
								<tr>
									<td><a href="index.php?p=semanas" >Regresar</a></td>
								</tr>
							</table>
							</form>
					</td>
				</tr>
			</table>
			<p>&nbsp;</p>
<?php
		}
?>

<?php
//Querys
mysql_free_result($reservacion_salon);
mysql_free_result($reservacion_salon_otro);

//Cerramos conexion
closeConection($idiomas);
?>
