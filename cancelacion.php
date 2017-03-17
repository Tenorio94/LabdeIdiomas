<?php
//Si el usuario no se ha logueado, mostrarle un mensaje.
if(($_SESSION['user'] == null && $_SESSION['user'] == '') || !hasChangedPassword()) { ?>
<script>
	location.href = 'index.php?p=uDes';
</script>
<? }
//Id de la reservacion
$id_reservacion = $_REQUEST['i'];
//Numero de la semana
$id_semana = $_REQUEST['s'];	


if($id_reservacion != "") {
	//Abriendo conexion
	$idiomas = getConection();

	//Obteniendo informacion del alumno	
	$query_matricula = $idiomas->query("SELECT * FROM tbl_matriculas WHERE matricula = ". $_SESSION['user'] . "");
	$alumno = $query_matricula->fetch_assoc();
	
	//Obteniendo informacion de cancelaciones del alumno
	$cancelacion = $idiomas->query("SELECT * FROM tbl_cancelaciones WHERE id_alumno = " . $_SESSION['user'] . " AND semana = $id_semana");

	//Si no ha hecho cancelaciones para esa semana.
	if($cancelacion->num_rows == 0) {
		//Obteniendo la informacion de la reservacion que se quiere cancelar
		$reservacion_array = $idiomas->query("SELECT * FROM tbl_reservaciones WHERE id = $id_reservacion");
		$reservacion = $reservacion_array->fetch_assoc();
		
		//Si son 24 horas antes..
		if(valida1horas($reservacion['dia'], $reservacion['mes'], $reservacion['hora'])) {
			//Si borro la reservacion, hay que agregar la cancelacion a la tabla de cancelaciones
			if($idiomas->query("DELETE FROM tbl_reservaciones WHERE id = $id_reservacion")){
				$idiomas->query("INSERT INTO tbl_cancelaciones (id_alumno, semana) VALUES ( " . $_SESSION['user'] . ", $id_semana)");
				echo "Tu cancelaci�n ha sido realizada con �xito.";
				?>
				<br><br>
				<table width="40%" border="1" align="center">
					<tr bgcolor="#336699"> 
						<td width="35%" class="mensajeError">Matr&iacute;cula:</td>
						<td width="65%"><font color="#FFFFFF"><?php echo $reservacion['matricula']; ?>&nbsp; </font></td>
					</tr>
					<tr bgcolor="#336699"> 
						<td class="mensajeError">D&iacute;a:</td>
						<td><font color="#FFFFFF"><?php echo $reservacion['dia'] . " de " . $reservacion['mes']; ?>&nbsp; </font></td>
					</tr>
					<tr bgcolor="#336699"> 
						<td class="mensajeError">Hora:</td>
						<td><font color="#FFFFFF"><?php echo $reservacion['hora'] . ":00"; ?>&nbsp; </font></td>
					</tr>
					<tr bgcolor="#336699"> 
						<td class="mensajeError">Sal&oacute;n:</td>
						<td><font color="#FFFFFF"><?php echo "CIAP - " . $reservacion['salon']; ?>&nbsp; </font></td>
					</tr>
			  </table>
				<?
				//****************para mandar el correo electronico **************
				/* subject */
				$subject = "Cancelaci�n :: Laboratorio de Idiomas";
				
				/* message */
				$message = '<table width="75%" border="0" align="center">
							  <tr>
								<td><p align="center"><font size="4"><strong>Tu cancelaci&oacute;n ha sido 
									realizada con &eacute;xito</strong></font></p>
								  <table width="60%" border="1" align="center" style="text-align:left;">
									<tr> 
									  <td width="30%"><strong>Matr&iacute;cula:</strong></td>
									  <td width="70%"> '. $reservacion['matricula'] . '&nbsp; </td>
									</tr>
									<tr> 
									  <td><strong>D&iacute;a:</strong></td>
									  <td>' . $reservacion['dia'] . " de " . $reservacion['mes'] . '&nbsp; </td>
									</tr>
									<tr> 
									  <td><strong>Hora:</strong></td>
									  <td>' . $reservacion['hora'] . ':00' . '</td>
									</tr>
									<tr> 
									  <td><strong>Sal&oacute;n:</strong></td>
									  <td>' . "CIAP - " . $reservacion['salon'] . '&nbsp; </td>
									</tr>
								  </table>
								</td>
							  </tr>
							</table>';
				//****************termina mandar el correo electronico************
				
				//Enviamos el correo.
				if($alumno['email'] != "") 
				{
					$to = $alumno['email'];
					enviarEmail($to, $subject, $message);
					echo '<p class="mensajeError">Se envi&oacute; un correo electronico a tu cuenta: ' . $to . ' con la informaci&oacute;n de tu cancelaci&oacute;n</p>';
				}
			}
		} else {
			echo "Para cancelar una reservaci�n, debes hacerlo al menos 1 hora antes.";
		}
	}  else {
		echo "Lo sentimos, solo puedes hacer una cancelaci�n por semana.";
	}
	closeConection($idiomas);
}
?>
<br><br><br>
<input name="Button" align="middle" type="button" onClick="location.href='index.php?p=reservaciones'" value="Regresar">
<br><br><br>