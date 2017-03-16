<?php
//Abriendo conexion con la base de datos
$idiomas = getConection();

$id_alumno = $_REQUEST['cs'];

//Obteniendo la informacion del alumno
$alumno_query = mysql_query("SELECT * FROM tbl_matriculas WHERE id = $id_alumno", $idiomas) or die(mysql_error());
$alumno = mysql_fetch_array($alumno_query);

//Cerrar la conexion
closeConection($idiomas);
?>

<form name="form" method="POST" action="index.php?p=pealumno" onSubmit="return validaPerfilUsuarioForm();">
    
  <p align="center" class="titulo">Información del Alumno</p>
  <table border="0" align="center" class="contenido" style="text-align:left ">
    	<tr>
			<td>Mátricula:</td>
			<td><? echo $alumno['matricula']; ?></td>
		</tr>
		<tr>
			<td>Nombre:</td>
			<td><input type="text" name="nombre" size="50" maxlength="50" value="<? echo $alumno['nombre']; ?>" /></td>
		</tr>
		<tr>
			<td>Apellido Paterno:</td>
			<td><input type="text" name="ap_paterno" size="50" maxlength="50" value="<? echo $alumno['ap_paterno']; ?>" /></td>
		</tr>		
		<tr>
			<td>Apellido Materno:</td>
			<td><input type="text" name="ap_materno" size="50" maxlength="50" value="<? echo $alumno['ap_materno']; ?>" /></td>
		</tr>				
		<tr>
			<td>Correo Electrónico:</td>
			<td><input type="text" name="email" size="50" maxlength="100" value="<? echo $alumno['email']; ?>" /></td>
		</tr>		
		<tr>
			<td>Cantidad:</td>
			<td><input type="text" name="cantidad" size="50" maxlength="100" value="<? echo $alumno['cantidad']; ?>" /></td>
		</tr>		
		<tr>
			<td>¿Cambio contraseña?</td>
			<td><? echo $alumno['flagPassword']; ?></td>
		</tr>
		<tr>
			<td>Contraseña:</td>
			<td><input type="password" name="password" size="50" maxlength="50" /></td>
		</tr>			
		<tr>
			<td>Confirmación de Contraseña:</td>
			<td><input type="password" name="password2" size="50" maxlength="50" /></td>
		</tr>
  		<tr> 
   			<td colspan="2" align="center">
        		<input type="hidden" name="id_alumno" value="<? echo $id_alumno; ?>" />
				<input type="submit" name="Submit" value="Guardar">
   			</td>
   		</tr>
   </table>
</form>
<script>

function validaPerfilUsuarioForm()
{
	var stringError = '';
	
	if (document.form.email.value != '') {
		if(!validEmail(document.form.email.value)){
			stringError = stringError + ' \n Correo Electrónico es invalido';
			document.form.email.focus();
		}
	}
	
	if (document.form.password.value != '') {
		if (document.form.password.value != document.form.password2.value)
		{   stringError = stringError + ' \n La contraseña y la confirmación de contraseña deben ser iguales';
			document.form.password.focus();
		}
	}
	
	if(stringError != '') {
		alert(stringError);
		return false; 
	}
}


function validEmail(str) {
		var at="@";
		var dot=".";
		var lat=str.indexOf(at);
		var lstr=str.length;
		var ldot=str.indexOf(dot);
		if (str.indexOf(at)==-1){
		   return false;
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   return false;
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    return false;
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		    return false;
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    return false;
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		    return false;
		 }
		
		 if (str.indexOf(" ")!=-1){
		    return false;
		 }

 		 return true					
	}
</script>