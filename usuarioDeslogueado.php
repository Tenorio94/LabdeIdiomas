<?php ?>
<div class="title-multilingual">reservaciones</div>
<br>
<table width="800" align="center" class="content">
	<tbody>
		<tr>
			<td width="10%" style="vertical-align:top; ">
				<br><img src="imagenes/secure.jpg" />
			</td>
			<td width="90%">
				<div align="justify" style="font-weight:bold; color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px;">
					<p class="multilingual">
						<? if( $_SESSION['user'] == null ) {  ?> 
							reservacion_inicio_sesion
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