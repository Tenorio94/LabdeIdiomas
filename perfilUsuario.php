<?php
if($_SESSION['user'] == null && $_SESSION['user'] == '') { 
?><script>
	location.href = 'index.php?p=uDes';
</script>
<? } 

//Abriendo conexion con la base de datos
$idiomas = getConection();

//Obteniendo la informacion del alumno
$user_info_array = $idiomas->query("SELECT * FROM tbl_matriculas WHERE matricula = " . $_SESSION['user']);
$user_info = $user_info_array->fetch_assoc();

//Si es la primera vez que se loguea, obligarlo a cambiar su password
if($user_info['flagPassword'] == 0) {
 $password = '';
} else {
 $password = $user_info['password']; 
}

//Cerrar la conexion
closeConection($idiomas);
?>

<form name="perfilUsuarioForm" method="POST" action="index.php?p=peperfil" onSubmit="return validaPerfilUsuarioForm();">
    
  <p align="center" class="titulo">Informaci�n del Usuario</p>
  <table border="0" align="center" class="contenido" style="text-align:left ">
    	<tr>
			<td>M�tricula:</td>
			<td><? echo $user_info['matricula']; ?></td>
		</tr>
		<tr>
			<td>Nombre:</td>
			<td><input type="text" name="nombre" size="50" maxlength="50" value="<? echo $user_info['nombre']; ?>"></td>
		</tr>
		<tr>
			<td>Apellido Paterno:</td>
			<td><input type="text" name="ap_paterno" size="50" maxlength="50" value="<? echo $user_info['ap_paterno']; ?>"></td>
		</tr>		
		<tr>
			<td>Apellido Materno:</td>
			<td><input type="text" name="ap_materno" size="50" maxlength="50" value="<? echo $user_info['ap_materno']; ?>"></td>
		</tr>				
		<tr>
			<td>Correo Electr�nico:</td>
			<td><input type="text" name="email" size="50" maxlength="100" value="<? echo $user_info['email']; ?>"></td>
		</tr>		
		<tr>
			<td>Contrase�a:</td>
			<td><input type="password" name="password" size="50" maxlength="50" value="<? echo $password;?>"></td>
		</tr>			
		<tr>
			<td>Confirmaci�n de Contrase�a:</td>
			<td><input type="password" name="password2" size="50" maxlength="50" value="<? echo $password; ?>"></td>
		</tr>
  		<tr> 
   			<td colspan="2" align="center">
        		<input type="submit" name="Submit" value="Guardar">
   			</td>
   		</tr>
   </table>
</form>
<script>

function validaPerfilUsuarioForm()
{
	var stringError = '';
	
	if (document.perfilUsuarioForm.email.value == '')
	{   stringError = stringError + ' \n Correo Electrónico es un campo requerido';
		document.perfilUsuarioForm.email.focus();
	} else {
		if(!validEmail(document.perfilUsuarioForm.email.value)){
			stringError = stringError + ' \n Correo Electrónico es invalido';
			document.perfilUsuarioForm.email.focus();
		}
	}
	
	if (document.perfilUsuarioForm.password.value == '')
	{   stringError = stringError + ' \n Contraseña es un campo requerido';
		document.perfilUsuarioForm.password.focus();
	}
	if (document.perfilUsuarioForm.password2.value == '')
	{   stringError = stringError + ' \n Confirmación de Contraseña es un campo requerido';
		document.perfilUsuarioForm.password2.focus();
	}
	if (document.perfilUsuarioForm.password.value != document.perfilUsuarioForm.password2.value)
	{   stringError = stringError + ' \n La contraseña y la confirmación de contraseña deben ser iguales';
		document.perfilUsuarioForm.password.focus();
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