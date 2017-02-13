
		<form name="usrpass" method="post" action="validacionUsuario.php" onSubmit="return valida();">
		  <table align="center" class="bordeGris">
			<tr> 
			  <td class="titulo1">Usuario:</td>
			  <td><input type="text" name="TxUsername"></td>
			</tr>
			<tr> 
			  <td class="titulo1">Contraseña:</td>
			  <td><input type="password" name="TxPassword"></td>
			</tr>
			<tr> 
			  <td>&nbsp;</td>
			  <td><input type="submit" name="Submit" value="Entrar"></td>
			</tr>
		  </table>
		</form>
		

<script language="JavaScript" type="text/JavaScript">
function valida()
{  if (document.usrpass.TxUsername.value == '')
	{   alert ('Falta el Usuario');
		document.usrpass.TxUsername.focus();
		return false; }
	else
	{   if (document.usrpass.TxPassword.value == '')
		{   alert ('Falta el password');
			document.usrpass.TxPassword.focus();
			return false; }
	} }
</script>
