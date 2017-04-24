<?php
	//Obtener el estado de la insercion para saber si desplegamos mensaje
	$inserted = $_REQUEST['t'];
	
	if(inserted == "1")
		echo "El testimonio fue dado de alta correctamente";
	else if(inserted == "0")
		echo "Hubo un error al dar de alta el testimonio, por favor, intente más tarde.";
?>
	<div align="center" style="width:90%; text-align:right" class="content">
		<img src="../imagenes/alta.jpg" /><a href="index.php?p=atestimonio">Dar de alta un testimonio</a>
		<br>
	</div>

	<table align="center">
		<tr><td class="title">Testimonios<br><br></td></tr>
	</table>

	<table class="table" align="center" width="850px">
		<tr>
			<td align="center" width="70px" class="trheader">Fecha</td>
			<td align="center" width="100px;" class="trheader">Alumno</td>
			<td align="center" width="150px" class="trheader">Foto/Video</td>
			<td align="center" width="450px" class="trheader">Descripción</td>
			<td width="100px" class="trheader">&nbsp;</td>
		</tr>
<?
	//Abriendo conexion con la base de datos
	$idiomas = getConection();
	
	//Obteniendo todos los registros de la base de datos
	$query_testimonios = $idiomas->query("SELECT * FROM tbl_videos ORDER BY id DESC");
	//Cerramos la conexion
	closeConection($idiomas);
	
	//Por cada video en la base de datos, desplegaremos 
	while($testimonio = $query_testimonios->fetch_assoc()) {
	
	//Darle formato a la fecha
	$exploded_fecha = explode('-', $testimonio['fecha']); 
	$fecha = $exploded_fecha[2] ."/" . $exploded_fecha[1] ."/" .$exploded_fecha[0];
	
	?>
		
		<tr>
			<td align="center" class="trBottonBorder"><? echo $fecha; ?></td>
			<td class="trBottonBorder"><? echo $testimonio['autor']; ?></td>
			<? if($testimonio['tipo'] == "foto") { ?>
				<td align="center" class="trBottonBorder"><img src="testimonios/<? echo $testimonio['archivo']; ?>"  /></td>
			<? } else { ?>
				<td align="center" class="trBottonBorder">
					<object id="MediaPlayer1" width="180" height="200" classid="CLSID:22D6F312-B0F6-11D0-94AB-0080C74C7E95"
						codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701"
						standby="Loading Microsoft Windows Media Player components..."
						type="application/x-oleobject" align="middle">
						<param name="FileName" value="testimonios/<? echo $testimonio['archivo']; ?>">
						<param name="ShowStatusBar" value="True">
						<param name="autostart" value="false">
						<embed type="application/x-mplayer2" pluginspage = "http://www.microsoft.com/Windows/MediaPlayer/"
						src="testimonios/<? echo $testimonio['archivo']; ?>"
						autostart="false"
						align="middle"
						width="176"
						height="144"
						defaultframe="rightFrame"
						showstatusbar="true">
						</embed>
					</object>
				</td>
			<? } ?>
			<td class="trBottonBorder"><? echo $testimonio['descripcion'];?>&nbsp;</td>
			<td align="center" class="trBottonBorder">
				<a href="index.php?cs=<? echo $testimonio['id']; ?>&p=etestimonio">Editar</a>
				&nbsp;&nbsp;&nbsp;
				<a href="index.php?cs=<? echo $testimonio['id']; ?>&p=pbtestimonio" onClick="return confirmarBaja();">Borrar</a>
			</td>
		</tr>
	<?
	}

?>
</table>
<script>
	function confirmarBaja() {
		var ok = confirm("¿Deseas eliminar el testimonio seleccionado?");
		if(ok) {
			return true;
		}
		return false;
	}
</script>