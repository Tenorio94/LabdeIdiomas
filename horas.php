<?php
$idiomas = getConection();
	//Para sacar las horas acreditadas, se obtienen las horas acumuladas de todas las materias.
	$query_horas = "SELECT * FROM tbl_horas WHERE matricula = ".$_SESSION['user'];
	$horas_matriz = $idiomas->query($query_horas);
	
	// Para sacar la �ltima fecha de actualizaci�n.
	$query_fecha = "SELECT DATE_FORMAT(fecha, '%e, %M %Y a las %H:%i:%s') FROM tbl_fecha
 ORDER BY fecha DESC
LIMIT 1;";
	$fecha_matriz = $idiomas->query($query_fecha);
	$fecha = $fecha_matriz->fetch_assoc();
	
$periodo_output = array("Primer", "Segundo", "Tercer", "Cuarto", "Quinto", "Sexto", "Septimo", "Octavo", "Noveno", "Decimo");
?>

<div class="title">Sesiones Acreditadas</div>

<table width="800" align="center" class="content">
	<tbody>
		<tr>
			<td>
				<div align="justify">
				<? 
				$lastIdioma="ninguno";
				$lastSeg=0;
				
				while($horas_totales = $horas_matriz->fetch_assoc()) { //Se empieza a mostrar las horas
						
						$periodo = $horas_totales['periodo'];
				
						//Se inicia la conversion a sesiones
						$hora=strtok($horas_totales['horas'], ":")*3600;
						$minuto=strtok(":")*60;
						$seg=strtok(":")+$minuto+$hora;
						
						if($horas_totales['idioma']==$lastIdioma) {
							$seg-=$lastSeg;
							$lastSeg+=$seg;
							if($seg<0) $seg=0;
							$stemp=$seg%60;
							if($stemp<10) $stemp="0".$stemp;
							$htemp=floor($seg/3600);
							if($htemp<10) $htemp="0".$htemp;
							$mtemp=floor(($seg-$htemp*3600)/60);
							if($mtemp<10) $mtemp="0".$mtemp;
							$horas_totales['horas']=$htemp.":".$mtemp.":".$stemp;
						}
						else {
							$lastSeg=$seg;
						}
						$lastIdioma=$horas_totales['idioma'];
						
						//Se obtienen las horas, ya considerando que 40 minutos=1 hora.
						$horas=((3*($seg)/2)/3600);
						$horas= number_format( $horas, $decimals = 1 );
						?>
					�  <? echo $periodo_output[$horas_totales['periodo']] ?> periodo <? echo  getIdioma($horas_totales['idioma']) ?>: <? echo  $horas_totales['horas'] ?>, equivalente a <b><? echo  $horas ?></b>	sesiones.			  <br />
			    <br /> <?
				}
				?>
				
					� La �ltima fecha de actualizaci�n fue el <? $string = join(',', $fecha); echo  $string; ?>. 
				</div>
		  </td>
		</tr>
	</tbody>
</table>
