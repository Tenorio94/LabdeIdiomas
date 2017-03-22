<?php

//Abrir conexion
$idiomas = getConection();

//Obteniendo todos los "testimonios" de la base de datos.
//$query_testimonios = mysqli_query("SELECT * FROM tbl_videos ORDER BY id DESC LIMIT 0,5 ", $idiomas);
$query_testimonios = $idiomas->query("SELECT * FROM tbl_videos ORDER BY id DESC LIMIT 0,5 ");
//$count_testimonios = mysqli_num_rows($query_testimonios);


//Obteniendo todos avisos de la base de datos.
//$query_avisos = mysqli_query("SELECT * FROM tbl_avisos WHERE activo = 'Y'", $idiomas);
$query_avisos = $idiomas->query("SELECT * FROM tbl_avisos WHERE activo = 'Y'");

//Se cierra la conexion
closeConection($idiomas);
?>

<table width="940px" align="center" cellpadding="15px">
	<tbody>
		<tr>
			<td colspan="2" align="center" class="title-multilingual">mensaje_bienvenida</td>
		</tr>
		<tr>
		<!-- Aqui se imprimen los testimonios -->
			<td width="400px" style="border-right-color:#666666; border-right-style:dotted; border-right-width:1px; ">
				<? if($query_testimonios->num_rows > 0 ) {  ?>
				<div class="leftTitle"><img src="imagenes/comentarios.jpg"  style="vertical-align:middle; "/>&nbsp;COMENTARIOS:</div>
				<table class="content">
					<tbody>
						<?
						//Por cada video en la base de datos, desplegaremos 
						while($testimonio = $query_testimonios->fetch_assoc()) {
						
						//Darle formato a la fecha
						$exploded_fecha = explode('-', $testimonio['fecha']); 
						$fecha = $exploded_fecha[2] ."/" . $exploded_fecha[1] ."/" .$exploded_fecha[0];
						
						?>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td><? echo $testimonio['autor']; ?></td>
								<td>( <? echo $fecha; ?> )</td>
							</tr>
							<? if($testimonio['tipo'] == "foto") { ?>
								<tr>
									<td><img src="admon/testimonios/<? echo $testimonio['archivo']; ?>"  /></td>
									<td align="left"><? echo $testimonio['descripcion'];?></td>
								</tr>
							<? } else { ?>
							
								<tr>
									<td colspan="2">
									<object id="MediaPlayer1" width="180" height="200" classid="CLSID:22D6F312-B0F6-11D0-94AB-0080C74C7E95"
										codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701"
										standby="Loading Microsoft� Windows� Media Player components..."
										type="application/x-oleobject" align="middle">
										<param name="FileName" value="admon/testimonios/<? echo $testimonio['archivo']; ?>">
										<param name="ShowStatusBar" value="True">
										<param name="autostart" value="false">
										<embed type="application/x-mplayer2" pluginspage = "http://www.microsoft.com/Windows/MediaPlayer/"
										src="admon/testimonios/<? echo $testimonio['archivo']; ?>"
										autostart="false"
										align="middle"
										width="176"
										height="144"
										defaultframe="rightFrame"
										showstatusbar="true">
										</embed>
									</object>
									</td>
								</tr>
							<? } ?>
							<tr>
								<td colspan="2" align="center" style=" border-bottom-color:#666666; border-bottom-style:dotted; border-bottom-width:1px; ">&nbsp;
								   
								</td>
							</tr>
						<?
						}
					
					?>
					</tbody>
				</table>
				<? } ?>
			</td>
		
		<!-- Aqui se imprimen los avisos -->
			<td width="540px" style="vertical-align:top;">
				<div class="leftTitle"><img src="imagenes/informacion.jpg" style="vertical-align:middle; " />&nbsp;AVISOS:</div>
				<div class="content" style="text-align:left ">
					<? while($aviso = $query_avisos->fetch_assoc()) { ?>
						<br />
						<p style="color:#FF0000; font-size:16px;"><? echo $aviso['descripcion'];?></p>
					<? } ?>
				</div>
			</td>
		</tr>
	</tbody>
</table>
