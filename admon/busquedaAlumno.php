<form name="formBusquedaAlumno" method="POST" action="index.php?p=busqueda">
	<table align="center" class="contenido">
		<tr>
			<td align="center" colspan="2" class="title">Búsqueda de Alumno <br><br></td>
		</tr>
		<tr>
			<td align="right" class="titulo1">Matr&iacute;cula:</td>
			<td><input name="matricula" type="text" id="matricula" size="10" maxlength="10"></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><br><br><input type="submit" name="Submit" value="Buscar" onClick="verificaMat()"></td>
		</tr>
	</table>
</form>


<!-- en caso de que venga de alguna búsqueda -->
<?php
$matricula = $_POST['matricula'];
//Si viene de una busqueda realizamos todo el procedimiento.
if($matricula != ""  && $matricula != NULL){
	//Abrimos la conexion a la base de datos
	$idiomas = getConection();

	//Obteniendo la informacion del alumno
	$query_alumno = $idiomas->query("SELECT * FROM tbl_matriculas WHERE matricula = $matricula");
	$alumno = $query_alumno->fetch_assoc();
	$total_alumno = $query_alumno->num_rows;
	
	//Obteniendo la informacion de las reservaciones del alumno
	$query_reservaciones = $idiomas->query("SELECT * FROM tbl_reservaciones WHERE matricula = $matricula AND semana IN ( SELECT DISTINCT semana FROM tbl_semanas)");
	$total_reservaciones = $query_reservaciones->num_rows;
	
	//Cerrar conexion a la base de datos
	closeConection($idiomas);
	
	//Si el query si trajo resultados
	if($total_alumno > 0) {
		
	?>
	<table border="0" align="center" class="contenido" width="500px">
		<tr>
			<td class="title" align="center">Resultado de Búsqueda</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td align="left">Información del Alumno:</td>
		</tr>
		<tr>
			<td align="center">
				<table border="1">
					<tr>
						<td align="left">Matrícula:</td>
						<td align="left"><? echo $alumno['matricula']; ?></td>
					</tr>
					<tr>
						<td align="left">Nombre:</td>
						<td align="left"><? echo $alumno['nombre'] . " " . $alumno['ap_paterno'] . " " . $alumno['ap_materno']; ?></td>
					</tr>		
					<tr>
						<td align="left">Email:</td>
						<td align="left"><? echo $alumno['email']; ?></td>
					</tr>		
					<tr>
						<td>Cantidad de Reservaciones:</td>
						<td align="left"><? echo $alumno['cantidad']; ?></td>
					</tr>												
					<tr>
						<td align="left">¿Cambio Contraseña?</td>
						<td align="left"><? if($alumno['flagPassword'] == 1) echo "Sí";  else echo "No"; ?></td>
					</tr>	
					<tr>
						<td colspan="2" align="right"><a href="index.php?cs=<? echo $alumno['id']; ?>&p=ealumno">Editar</a></td>
					</tr>								
				</table>
			</td>
		</tr>
		<tr>
			<td align="left"><br><br>Reservaciones:</td>
		</tr>
		<tr>
			<td align="center">
				<table border="1">
					<tr>
						<td>Día</td>
						<td>Hora</td>
						<td>Salón</td>
						<td>&nbsp;</td>
					</tr>
					<? while($reservacion = $query_reservaciones->fetch_assoc()) { ?>
					<tr>
						<td><?php echo $reservacion['dia'] . " de " . $reservacion['mes'];?></td>
						<td><?php echo $reservacion['hora'] . ":00 ";?></td>
						<td><?php echo $reservacion['salon'];?></td>
						<td><a href="index.php?cs=<? echo $reservacion['id']; ?>&p=pbreservacion" onClick="return confirmarBaja();">Borrar</a></td>
					</tr>
					<? } ?>
				</table>
			</td>
		</tr>
	</table>
<? }

}?>


<script language="javascript">
function verificaMat()
{
  strMat = document.formBusquedaAlumno.matricula.value;
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;
	 if(document.formBusquedaAlumno.matricula.value == ""){
			alert("Favor de escribir su matricula"),
			document.formBusquedaAlumno.matricula.focus();
		}
		else	{
		 for (i = 0; i < strMat.length && IsNumber == true; i++) 
      { 
      Char = strMat.charAt(i); 
      if (ValidChars.indexOf(Char) == -1)  {
         	IsNumber = false;
  			alert("Sólo se aceptan números en la matricula (Sin espacios)");
  			document.formBusquedaAlumno.matricula.focus();
  			return false;
         }
      }document.formBusquedaAlumno.submit();
	}	 
}

	function confirmarBaja() {
		var ok = confirm("¿Deseas eliminar el testimonio seleccionado?");
		if(ok) {
			return true;
		}
		return false;
	}
</script>

