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
        <td align="center" class="ligasSemana">
			<? echo getSemanaHrefLink(1); ?>
		</td>
        <td align="center" class="ligasSemana">
			<? echo getSemanaHrefLink(2); ?>
		</td>
        <td align="center" class="ligasSemana">
			<? echo getSemanaHrefLink(3); ?>
		</td>
        <td align="center" class="ligasSemana">
			<? echo getSemanaHrefLink(4); ?>	
		</td>
        <td align="center" class="ligasSemana">
			<? echo getSemanaHrefLink(5); ?>
		</td>
        <td align="center" class="ligasSemana">
			<? echo getSemanaHrefLinkSabado(6); ?>
		</td>   
	  </tr>
	  <tr> 
        <td align="center" class="ligasSemana">
			<? echo getSemanaHrefLink(7); ?>
		</td>
        <td align="center" class="ligasSemana">
			<? echo getSemanaHrefLink(8); ?>
		</td>
        <td align="center" class="ligasSemana">
			<? echo getSemanaHrefLink(9); ?>
		</td>
        <td align="center" class="ligasSemana">
			<? echo getSemanaHrefLink(10); ?>
		</td>
        <td align="center" class="ligasSemana">
			<? echo getSemanaHrefLink(11); ?>
		</td>
        <td align="center" class="ligasSemana">
			<? echo getSemanaHrefLinkSabado(12); ?>
		</td>
      </tr>
  </table>
<? 
//Cerrando conexion a la base de datos
closeConection($idiomas); 
?>