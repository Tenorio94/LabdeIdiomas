<?php ?>
<div class="title">Reservaciones</div>
<br>
<table width="800" align="center" class="content">
	<tbody>
		<tr>
			<td width="10%" style="vertical-align:top; ">
				<br><img src="imagenes/secure.jpg" />
			</td>
			<td width="90%">
				<div align="justify" style="font-weight:bold; color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px;">
					<p>
						<? if( $_SESSION['user'] == null ) {  ?>
							<br>�Lo sentimos! Para acceder al sistema de reservaci�n, necesitas iniciar una sesi�n.

<br>1.	Oprime en la parte superior derecha de la pantalla en el espacio donde dice Entrar.<br>
2.	El usuario y la contrase�a son tu n�mero de matr�cula (sin la A ni los ceros) 
<br>Los usuarios inscritos en los cursos de extensi�n deben usar como usuario y contrase�a, el c�digo de acceso que se les asigna.<br>
							<br><br>
						<? } else { ?>
							<br>Lo sentimos, para acceder a esta p�gina necesitas cambiar tu contrase�a, recuerda que cuando entras por 
							primera vez al sistema es necesario cambiar la contrase�a e introducir un correo electr�nico.
							<br>(En la parte superior derecha puedes dar clic en tu matricula para modificar tus datos)
						<? } ?>
					</p>
					<p>&nbsp;</p>
				</div>
			</td>
		</tr>
	</tbody>
</table>