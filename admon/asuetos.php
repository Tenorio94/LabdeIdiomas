<?php

require_once('../php/connections.php');

//Abrimos conexion con la base de datos
$idiomas = getConection();

$asuetos = isset($_POST['dates']) ? $_POST['dates'] : null;

foreach ($asuetos as $asueto) {
	echo($asueto);
	$idiomas->query("INSERT INTO tbl_asuetos (asueto) VALUES (". $asueto .")");
}
 

?>