<?php?>
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
							<br>¡Lo sentimos! Para acceder al sistema de reservación, necesitas iniciar una sesión.

<br>1.	Oprime en la parte superior derecha de la pantalla en el espacio donde dice Entrar.<br>
2.	El usuario y la contraseña son tu número de matrícula (sin la A ni los ceros) 
<br>Los usuarios inscritos en los cursos de extensión deben usar como usuario y contraseña, el código de acceso que se les asigna.<br>
							<br><br>
						<? } else { ?>
							<br>Lo sentimos, para acceder a esta página necesitas cambiar tu contraseña, recuerda que cuando entras por 
							primera vez al sistema es necesario cambiar la contraseña e introducir un correo electrónico.
							<br>(En la parte superior derecha puedes dar clic en tu matricula para modificar tus datos)
						<? } ?>
					</p>
					<p>&nbsp;</p>
				</div>
			</td>
		</tr>
	</tbody>
</table>