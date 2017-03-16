<?php
if(($_SESSION['user'] == null && $_SESSION['user'] == '') || !hasChangedPassword()) { ?>
<script>
	location.href = 'index.php?p=uDes';
</script>
<? }
//*********validacion de la tabla tbl_matriculas***********
$banderaMatricula = 0;// para ver si si esta en nuestra base de datos...
$cantidad = 1;

//Iniciacion de variables
$mat = $_SESSION['user'];
$salon = $_REQUEST['sa'];
$mes = $_REQUEST['m'];
$hora = $_POST['hora'];
$dia = $_REQUEST['d'];
$sem = $_REQUEST["s"];
$fecha = getdate();

//Abrir conexion con la base de datos y seleccionar base de datos
$idiomas = getConection();
mysql_select_db($database_idiomas, $idiomas);

//Obtener la informacion del alumno
$query_matricula = mysql_query("SELECT * FROM tbl_matriculas WHERE matricula = ". $_SESSION['user'] . "", $idiomas) or die(mysql_error());
$alumno = mysql_fetch_array($query_matricula);
$result_rows = mysql_num_rows($query_matricula);

if($result_rows == 1)
{
	$cantidad = $alumno['cantidad'];
}


//****************para mandar el correo electronico **************
/* subject */
$subject = "Reservación :: Laboratorio de Idiomas";

/* message */
$message = '<table width="75%" border="0" align="center">
			  <tr>
				<td><p align="center"><font size="4"><strong>Tu reservaci&oacute;n ha sido 
					realizada con &eacute;xito</strong></font></p>
				  <table width="60%" border="1" align="center" style="text-align:left;">
					<tr> 
					  <td width="30%"><strong>Matr&iacute;cula:</strong></td>
					  <td width="70%"> '. $mat . '&nbsp; </td>
					</tr>
					<tr> 
					  <td><strong>D&iacute;a:</strong></td>
					  <td>' . $dia . " de " . $mes . '&nbsp; </td>
					</tr>
					<tr> 
					  <td><strong>Hora:</strong></td>
					  <td>' . $hora . ':00' . '</td>
					</tr>
					<tr> 
					  <td><strong>Sal&oacute;n:</strong></td>
					  <td>' . "CIAP - " . $salon . '&nbsp; </td>
					</tr>
				  </table>
				</td>
			  </tr>
			</table>';
//****************termina mandar el correo electronico************

//****************busquedas en BD ********************************
//Obtener la informacion de las reservaciones del alumno para la semana
	$query_reservaciones = mysql_query("SELECT * FROM tbl_reservaciones WHERE matricula = $mat AND semana = $sem", $idiomas) or die(mysql_error());
	$total_reservaciones = mysql_num_rows($query_reservaciones);
	
	//Validar que el alumno no tenga ya una reservacion para esta hora
	$query_reservaciones_hoy = mysql_query("SELECT matricula FROM tbl_reservaciones WHERE semana = $sem AND dia = $dia AND mes = '$mes' AND salon = $salon AND hora = $hora", $idiomas) or die(mysql_error());
	$row_query32 = mysql_fetch_assoc($query_reservaciones_hoy);
	$total_reservaciones_hoy = mysql_num_rows($query_reservaciones_hoy);
//************ termina busquedas en BD ********************

?>
<?php 
/********************* INICIA PROCESO DE RESERVACION ******************/
	//Si quiere reservar en una hora que ya paso...
   	if (!esReservacionAFuturo($dia, $mes, $hora))
	{
		?>
			<table width="75%" border="0" align="center">
				<tr>
					<td class="mensajeError">
						Lo sentimos, la reservación debe ser a futuro.
						<br><br>
						<input name="Button" type="button" onClick="location.href='index.php?p=reservaciones'" value="Regresar a Reservaciones">
					</td>
				</tr>
			</table>
		<p>&nbsp;</p>
		<? 	
	}
	else
	{
		//Si excede el numero maximo de reservaciones que puede hacer
		if($total_reservaciones >= $cantidad)
		{  
			?>
			<table width="75%" border="0" align="center">
				<tr>
					<td>
						<p align="center" class="mensajeError">
							Lo sentimos, ya tienes <? echo $cantidad; ?> reservaciones para esta semana.
						</p>
					  	<!-- Mostrarle sus reservaciones de esta semana -->
						<table width="40%" border="1" align="center">
							<? while($rows = mysql_fetch_array($query_reservaciones)) { ?>
							<tr bgcolor="#336699"> 
						  		<td width="35%" class="mensajeNormal">
									Matr&iacute;cula:
								</td>
						  		<td width="65%">
									<font color="#FFFFFF"><?php echo $rows['matricula'];?>&nbsp; </font>
								</td>
							</tr>
							<tr bgcolor="#336699"> 
						  		<td class="mensajeNormal">D&iacute;a: </td>
						  		<td>
									<font color="#FFFFFF">
										<?php echo $rows['dia'] . " de " . $rows['mes']; ?>&nbsp; 
									</font>
								</td>
							</tr>
							<tr bgcolor="#336699"> 
						   		<td class="mensajeNormal">
									Hora:
								</td>
						  		<td>
									<font color="#FFFFFF"> <?php  echo $rows['hora'] . ":00"; ?>  &nbsp; </font>
								</td>
							</tr>
							<tr bgcolor="#336699"> 
						  		<td class="mensajeNormal">
									Sal&oacute;n:
								</td>
						  		<td>
									<font color="#FFFFFF"><?php echo "CIAP - " . $rows['salon']; ?>&nbsp; </font>
								</td>
							</tr>
							<tr> 
						  		<td bgcolor="#FFFFFF">&nbsp;</td>
						  		<td bgcolor="#FFFFFF">&nbsp;</td>
							</tr>
						<? } ?>
					  </table>
					  <br><br>
					  <div align="center"><input name="Button" type="button" onClick="location.href='index.php?p=reservaciones'" value="Regresar a Reservaciones""></div>
				</td>
			  </tr>
			</table>
	<?	} 
		else
		{ //si aunpuede reservar...
			$mismodiahora =0;
			while($row_query1 = mysql_fetch_array($query_reservaciones))
				if($row_query1[3] == $dia && $row_query1[4] == $hora)
					$mismodiahora = 1;

			if ($mismodiahora == 1) //si ya tiene una reservacion el mismo dia a la misma hora...
			{ ?>
					<table width="75%" border="0" align="center">
					  <tr>
						<td class="mensajeError">
							Lo sentimos, no se permite elegir dos reservaciones a la misma hora.
							<br><br>
						  	<table width="40%" border="1" align="center">
								<tr bgcolor="#336699"> 
							  		<td width="35%" class="mensajeNormal">Hora:</td>
							  		<td width="65%" class="mensajeNormal"><?php echo $hora . ":00 "; ?>&nbsp; </td>
								</tr>
						  	</table>
							<br><br>
						  	<p align="center" class="mensajeNormal">Porfavor selecciona otra hora.</p>
							<br><br>
							<div align="center"><input name="Button" type="button" onClick="location.href='index.php?p=reservaciones'" value="Regresar a Reservaciones""></div>
						</td>
					  </tr>
					</table>
					<p>&nbsp;</p> <?
				}
				else
				{   
					if($total_reservaciones_hoy < 40) 
					{   
						//Paso todas las validaciones
						//Insertar la reservacion en la base de datos.
						$insertSQL = "INSERT INTO tbl_reservaciones (matricula, salon, dia, hora, mes, semana) VALUES (". $mat .", " . $salon . ", " . $dia . ", " . $hora . ", '" .$mes . "', " . $sem. ");";
						mysql_query($insertSQL, $idiomas) or die(mysql_error());
						?>
						<table width="75%" border="0" align="center">
						  <tr>
							<td class="mensajeNormal">
								Tu reservaci&oacute;n ha sido realizada con &eacute;xito <br><br>
								<table width="40%" border="1" align="center">
									<tr bgcolor="#336699"> 
								  		<td width="35%" class="mensajeNormal">Matr&iacute;cula:</td>
								  		<td width="65%"><font color="#FFFFFF"><?php echo $mat; ?>&nbsp; </font></td>
									</tr>
									<tr bgcolor="#336699"> 
								  		<td class="mensajeNormal">D&iacute;a:</td>
								  		<td><font color="#FFFFFF"><?php echo $dia . " de " . $mes; ?>&nbsp; </font></td>
									</tr>
									<tr bgcolor="#336699"> 
								  		<td class="mensajeNormal">Hora:</td>
								  		<td><font color="#FFFFFF"><?php echo $hora . ":00"; ?>&nbsp; </font></td>
									</tr>
									<tr bgcolor="#336699"> 
								 		<td class="mensajeNormal">Sal&oacute;n:</td>
								  		<td><font color="#FFFFFF"><?php echo "CIAP - " . $salon; ?>&nbsp; </font></td>
									</tr>
							  </table>
							  <?
								if($alumno['email'] != "") 
								{
									$to = $alumno['email'];
									enviarEmail($to, $subject, $message);
									echo '<p class="mensajeGris"><img src="imagenes/email.jpg" />Se envi&oacute; un correo electrónico a tu cuenta: ' . $to . ' con la informaci&oacute;n de tu reservaci&oacute;n</p>';
								}?>
							  	<br><br>
								<div align="center"><input name="Button" type="button" onClick="location.href='index.php?p=reservaciones'" value="Regresar a Reservaciones""></div>
							</td>
						  </tr>
						</table>
						<br><br>
					<?php 
					}
					else
					{ //Si ya no hay cupo el dia y la hora elegidas
						?>
						<table width="75%" border="0" align="center">
						  	<tr>
								<td class="mensajeError">
									Lo sentimos, ya no hay lugares disponibles en el d&iacute;a, hora y sal&oacute;n que tu elegiste. <br><br>
							  		<table width="40%" border="1" align="center">
										<tr bgcolor="#336699"> 
								  			<td width="35%" class="mensajeNormal">D&iacute;a:</td>
								  			<td width="65%" class="mensajeNormal"><?php echo $dia . " de " . $mes; ?></td>
										</tr>
										<tr bgcolor="#336699"> 
								  			<td width="35%" class="mensajeNormal">Hora:</td>
								  			<td width="65%" class="mensajeNormal"><?php echo $hora . ":00"; ?></td>
										</tr>
										<tr bgcolor="#336699"> 
								  			<td width="35%" class="mensajeNormal">Sal&oacute;n:</td>
								  			<td width="65%" class="mensajeNormal"><?php echo "CIAP - " . $salon; ?></td>
										</tr>			
							  		</table>
									<br><br>
							  		<p align="center" class="mensajeNormal">Puedes elegir otra hora, o bien otro sal&oacute;n</p>
									<div align="center"><input name="Button" type="button" onClick="location.href='index.php?p=reservaciones'" value="Regresar a Reservaciones""></div>
							  	</td>
						  	</tr>
						</table>
						<br><br>
		<?php		}
				}
			}
		}

	
?>
<?php
mysql_free_result($query_reservaciones);
mysql_free_result($query_reservaciones_hoy);
closeConection($idiomas);
?>

