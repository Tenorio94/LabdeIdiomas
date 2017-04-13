<?php

$idiomas = getConection();

function getSemanaHrefLink($day)
{
	global $idiomas;
    $semana_query = $idiomas->query("SELECT * FROM tbl_semanas WHERE id = $day");
	$semana = $semana_query->fetch_assoc();
	
	//Por default $result = Asueto
	$result = "Asueto";
	
	if($semana['asueto'] == 0) {
		$htmlLink = "index.php?p=selsalon&d=" . $semana['dia'] . "&m=" . $semana['mes'] ."&s=" .  $semana['semana']."&ds=" .  $semana['diasem'];
		$result = '<a href="'.$htmlLink.'" id="' . $semana['dia'] . '"> '. $semana['dia'] . ' </a>';
	}
	return $result;
}

function getSemanaHrefLinkSabado($day)
{

	global $idiomas;

    $semana_query = $idiomas->query("SELECT * FROM tbl_semanas WHERE id = $day");
	$semana = $semana_query->fetch_assoc();
	
	//Por default $result = Asueto
	$result = "Asueto";
	
	if($semana['asueto'] == 0) {
		$htmlLink = "index.php?p=salon424s&d=" . $semana['dia'] . "&m=" . $semana['mes'] ."&s=" .  $semana['semana']."&s=" .  $semana['diasem'];
		$result = '<a href="'.$htmlLink.'" id="' . $semana['dia'] . '"> '. $semana['dia'] . ' </a>';
	}
	return $result;
}

function getSemanaCompletaHrefLink($week) {
	global $idiomas;
	$currentHTML = "";

	if($idiomas == NULL) {
		$idiomas = getConection();
	}

	$semana_query = $idiomas->query("SELECT * FROM tbl_semanas WHERE semana = '$week'");
	
	while($semana = $semana_query->fetch_assoc()) {

		if($semana["diasem"] != "sabado")
			$htmlLink = "index.php?p=selsalon&d=" . $semana['dia'] . "&m=" . $semana['mes'] ."&s=" .  $semana['semana']."&ds=" .  $semana['diasem'];
		else
			$htmlLink = "index.php?p=salon424s&d=" . $semana['dia'] . "&m=" . $semana['mes'] ."&s=" .  $semana['semana']."&ds=" .  $semana['diasem'];


		if((int)$semana["asueto"] == 0) {
			$result = '<a href="'.$htmlLink.'" id="' . $semana['dia'] . '"> '. $semana['dia'] . ' </a>';
		}
		else {
			$result = "Asueto";
		}

		$currentHTML = $currentHTML . '<td align="center" class="ligasSemana">';
			$currentHTML = $currentHTML . $result;
		$currentHTML = $currentHTML .'</td>';
		$result = "";
	}

	return $currentHTML;
}
?>

	<table align="center" class="title">
		<tr>
			<td>Reservaciones</td>
		</tr>
	</table>
  <table width="200" border="1" align="center" cellpadding="4px">
      <tr bgcolor="#336699"> 
        <td align="center" class="diasSemana">Lunes</td>
        <td align="center" class="diasSemana">Martes</td>
        <td align="center" class="diasSemana">Mi�rcoles</td>
        <td align="center" class="diasSemana">Jueves</td>
        <td align="center" class="diasSemana">Viernes</td>
		<td align="center" class="diasSemana">S&aacute;bado</td>
      </tr>
      <tr> 
	  	<? echo getSemanaCompletaHrefLink(date("W")); ?>
	  </tr>
	  <tr> 
	  	<? echo getSemanaCompletaHrefLink((int)date("W") + 1); ?>
      </tr>
  </table>
<? 
//Cerrando conexion a la base de datos
global $idiomas;
closeConection($idiomas); 
?>