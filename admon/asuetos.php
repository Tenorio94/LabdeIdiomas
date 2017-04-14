<?php

require_once('../php/connections.php');
require_once('../php/functions.php');


//Abrimos conexion con la base de datos
$idiomas = getConection();

if (isset($_POST['dates'])){
		
	$asuetos = $_POST['dates'];


	$yearDates = getDateRange("2017-01-01", "2017-12-31", "+1 day", "d/m/Y", $asuetos);

	//echo json_encode($yearDates[0]["dia"]);
	//echo json_encode($yearDates);
	$idiomas->query("TRUNCATE TABLE tbl_semanas;");
	for ($fecha = 0; $fecha < sizeof($yearDates); $fecha += 1){
		$day = (int)$yearDates[$fecha]["dia"];
		$month = $yearDates[$fecha]["mes"];
		$year = $yearDates[$fecha]["ano"];
		$weekNumber = (int)$yearDates[$fecha]["semana"];
		$weekDay = $yearDates[$fecha]["diasem"];
		$asuetoBol = (int)$yearDates[$fecha]["asueto"];


		$idiomas->query("INSERT INTO tbl_semanas(`dia`, `mes`, `semana`, `diasem`, `asueto`)VALUES('$day', '$month', '$weekNumber', '$weekDay', '$asuetoBol')");
	}
}

 return;

?>	