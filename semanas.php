<?php
$idiomas = getConection();

function getSemanaHrefLink($day)
{
	global $idiomas;
	//Si la conexion no existe, abrirla
	if($idiomas == NULL) {
		$idiomas = getConection();
	}
	//mysql_select_db($database_idiomas, $idiomas);
    $semana_query = $idiomas->query("SELECT * FROM tbl_semanas WHERE id = '$day'");
	$semana = $semana_query->fetch_assoc();
	
	//Por default $result = Asueto
	$result = "Asueto";
	
	if($semana['asueto'] == 0) {
		$htmlLink = "index.php?p=salon&d=" . $semana['dia'] . "&m=" . $semana['mes'] ."&s=" .  $semana['semana']."&ds=" .  $semana['diasem'];
		$result = '<a href="'.$htmlLink.'" id="' . $semana['dia'] . '"> '. $semana['dia'] . ' </a>';
	}
	return $result;
}

function getSemanaHrefLinkSabado($day)
{
	global $idiomas;
	//Si la conexion no existe, abrirla
	if($idiomas == NULL) {
		$idiomas = getConection();
	}
	//mysql_select_db($database_idiomas, $idiomas);
    $semana_query = $idiomas->query("SELECT * FROM tbl_semanas WHERE id = '$day'");
	$semana = $semana_query->fetch_assoc();
	
	//Por default $result = Asueto
	$result = "Asueto";
	
	if($semana['asueto'] == 0) {
		$htmlLink = "index.php?p=salon424s&d=" . $semana['dia'] . "&m=" . $semana['mes'] ."&s=" .  $semana['semana']."&ds=" .  $semana['diasem'];
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
			$htmlLink = "index.php?p=salon&d=" . $semana['dia'] . "&m=" . $semana['mes'] ."&s=" .  $semana['semana']."&ds=" .  $semana['diasem'];
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
			<td class="multilingual">reservaciones</td>
		</tr>
	</table>
  <table width="200" border="1" align="center" cellpadding="4px">
      <tr bgcolor="#336699"> 
        <td align="center" class="diasSemana-multilingual">lunes</td>
        <td align="center" class="diasSemana-multilingual">martes</td>
        <td align="center" class="diasSemana-multilingual">mier</td>
        <td align="center" class="diasSemana-multilingual">jueves</td>
        <td align="center" class="diasSemana-multilingual">viernes</td>
		<td align="center" class="diasSemana-multilingual">sabado</td>
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
closeConection($idiomas); 
?>