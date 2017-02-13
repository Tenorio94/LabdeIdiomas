<table align="center">
	<tr>
		<td class="title">Alta de Aviso</td>
	</tr>
</table>
<form name="forma" method="post" action="index.php?p=paaviso">
<table align="center" width="50%" class="content">
	<tr>
		<td align="left"><br>Descripción:</td>
		<td align="left"><br><textarea name="descripcion" rows="5" cols="37"></textarea></td>
	</tr>
	<tr>
		<td align="left"><br>Activo:</td>
		<td align="left"><br>
			<select name="activo">
				<option value="Y" selected>Sí</option>
				<option value="N">No</option>				
			</select>
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2">
			<br><br>
			<input type="submit" name="Submit" value="Dar de Alta">
		</td>
	</tr>
</table>
</form>
