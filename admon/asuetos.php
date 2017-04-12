<?php

require_once('../php/connections.php');
require_once('../php/functions.php');


//Abrimos conexion con la base de datos
$idiomas = getConection();

if (isset($_POST['dates'])){
		
	$asuetos = $_POST['dates'];


	echo json_encode(getDateRange("2017-01-01", "2017-12-31", "+1 day", "d/m/Y", $asuetos));

	//echo json_encode(date_range("2014-01-01", "2014-01-20", "+1 day", "m/d/Y"));

	/*foreach ($asuetos as $asueto) {
		echo($asueto);
		$idiomas->query("INSERT INTO tbl_asuetos (asueto) VALUES ('$asueto')");
	}*/

}
 
 return;

?>