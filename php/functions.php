<?php

//----------------- Index Php Functions ---------------//
function validLoguedUserToInclude($page) {
	if($_SESSION['user'] != null && $_SESSION['user'] != '') {
		include($page);
	} else {
		include('usuarioDeslogueado.php');
	}
}

function hasChangedPassword () {
	$idiomas = getConection();
	$consulta_mat = $idiomas->query("SELECT * FROM tbl_matriculas WHERE matricula = " . $_SESSION['user'] ."");
	$matricula = $consulta_mat->fetch_assoc();
	if($matricula['flagPassword'] == 1) {
		return true;
	}
	return false;
	closeConection($idiomas);
}
//----------------------------------------------------//


// -------------------------- cancelacion.php ------------------------------ //
function valida1horas($day, $month, $hora) {
	$current_hour = date('G');
	$current_month = date('m');
	$current_day = date('d');
	
	$res_date = date('Y') . "-". getMonthNumber($month) ."-" . $day; 
	$todays_date = date("Y-m-d"); 
	
	$today = strtotime($todays_date); 
	$reservacion_date = strtotime($res_date); 
	
	/*echo "$reservacion_date: " . $reservacion_date  . "<br>" . "$today: " .$today ."<br>" ;
	echo "$current_month: " . $current_month  . "<br>" . "getMonthNumber($month): " .getMonthNumber($month) ."<br>" ;
	echo "$current_day: " . $current_day  . "<br>" . "$day : " .$day  ."<br>" ;
	echo "$current_hour: " . $current_hour . "<br>" . " $current_hour  : " .$hora  ."<br>" ;
	exit();*/
	
	if ($reservacion_date > $today || ($current_month == getMonthNumber($month) && $current_day == $day && $current_hour < ($hora - 1))) 
	{ 
		return true;
	} 
	else { 
		return false;
	} 
}

function esReservacionAFuturo($day, $month, $hora) {
	$current_hour = date('G');
	$current_month = date('m');
	$current_day = date('d');
	
	$res_date = date('Y') . "-". getMonthNumber($month) ."-" . $day; 
	$todays_date = date("Y-m-d"); 
	
	$today = strtotime($todays_date); 
	$reservacion_date = strtotime($res_date); 
	
	/*echo "$reservacion_date: " . $reservacion_date  . "<br>" . "$today: " .$today ."<br>" ;
	echo "$current_month: " . $current_month  . "<br>" . "getMonthNumber($month): " .getMonthNumber($month) ."<br>" ;
	echo "$current_day: " . $current_day  . "<br>" . "$day : " .$day  ."<br>" ;
	echo "$current_hour: " . $current_hour . "<br>" . " $current_hour  : " .$hora  ."<br>" ;
	exit();*/
	
	if ($reservacion_date > $today || ($current_month == getMonthNumber($month) && $current_day == $day && $current_hour < $hora)) 
	{ 
		return true;
	} 
	else { 
		return false;
	} 
}

function getWeekDay($week) {
	switch($week) {
		case "1" : return "lunes"; break;
		case "2" : return "martes"; break;
		case "3" : return "miercoles"; break;
		case "4" : return "jueves"; break;
		case "5" : return "viernes"; break;
		case "6" : return "sabado"; break;
	}
}



function getMonthText($month) {
	switch($month) {
		case "01" : return "enero"; break;
		case "02" : return "febrero"; break;
		case "03" : return "marzo"; break;
		case "04" : return "abril"; break;
		case "05" : return "mayo"; break;
		case "06" : return "junio"; break;
		case "07" : return "julio"; break;
		case "08" : return "agosto"; break;
		case "09" : return "septiembre"; break;
		case "10" : return "octubre"; break;
		case "11" : return "noviembre"; break;
		case "12" : return "diciembre"; break;
	}
}


function getMonthNumber($month) {
	switch($month) {
		case "enero" : return "01"; break;
		case "febrero" : return "02"; break;
		case "marzo" : return "03"; break;
		case "abril" : return "04"; break;
		case "mayo" : return "05"; break;
		case "junio" : return "06"; break;
		case "julio" : return "07"; break;
		case "agosto" : return "08"; break;
		case "septiembre" : return "09"; break;
		case "octubre" : return "10"; break;
		case "noviembre" : return "11"; break;
		case "diciembre" : return "12"; break;
	}
}



//---------------------------------------------------------------------------//

// -------------------------- enviarMail ------------------------------ //
function enviarEmail($to, $subject, $message){
	//Armar los headers
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: Laboratorio de Idiomas <crai.mty@servicios.itesm.mx>\r\n";
	
	$mensajeFinal = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
				<html>	
					<head>
						<title>LABDEI ::</title>
						<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
					</head>
					<body bgcolor="#CCCCCC" style="text-align:center" leftmargin="0px" rightmargin="0px" topmargin="0px" margin-bottom="0px">
					<center>
					<div style="width:700px;font-family: Arial;color:#333333;">
						<div style="background-color:#003366; height:25px; color:#FFFFFF;">
								<div style="font-size:10px;margin-left:10px; text-align:left; margin-top:4px;">
									TECNOLOGICO DE MONTERREY  &nbsp;&nbsp;|&nbsp; &nbsp; Lenguas Modernas
								</div>
							</div>
							<div style="height: 100px; text-align: left; color:#FFFFFF; padding-bottom: 0px; background-image: url(imagenes/headerMail.jpg); clear:both;">
								<table align="center" width="100%">
									<tbody>
									<tr>
										<td align="left" width="70%">
											<div style="font-size:40px;margin-left:20px; letter-spacing:2px; font-weight:bold; margin-top:15px;">LABDEI</div>
											<div style="font-size:12px; font-family:Arial;margin-left:23px; letter-spacing:1px;">Laboratorio de Idiomas</div>
										</td>
										<td align="right" width="30%" style="">&nbsp;</td>
									</tr>
									</tbody>
								</table>
							</div>
				
							<div style="background-image:url(imagenes/menu.jpg); width:700px;">
								&nbsp;
							</div>
				
							<div style="background-color: rgb(255, 255, 255); clear:both;">
							<br><br>
								<div style=\'text-align:left\'>' . $message .'</div>
								<br><br>
							</div>
							<div style="height:20px;background-color:#003366; ">
								&nbsp;
							</div>
							<div style="height:30px;background-color:#FFFFFF; font-size:10px; font-weight:bold;">
								Instituto Tecnológico y de Estudios Superiores de Monterrey  - Laboratorio de Idiomas <br>
								&copy; Derechos Reservados.
							</div>
						</div>
						</center>
					</body>
				</html>';
	mail($to, $subject, $mensajeFinal, $headers);

}
//----------------------------------------------------//


// -------------------------- horas.php ------------------------------ //
function getIdioma($idioma) { //Regresa el idioma del que se trata. Son 2 digitos, el primero es el idioma y el segundo la cantidad de veces que lleva un idioma
	switch (($idioma-($idioma%10))/10) {
		case 0:
			return "Inglés americano";
		break;
		case 1:
			return "Alemán";
		break;
		case 2:
			return "Italiano";
		break;
		case 3:
			return "Español";
		break;
		case 4:
			return "Francés";
		break;
	}
}


function getDateRange($first, $last, $step = '+1 day', $output_format = 'd/m/Y', $asuetos) {

    $dates = array();
	$day = "";
	$month = "";
	$year = "";
	$weekNumber = "";
	$weekDay = "";
	$asuetoBol = 0;
    $current = strtotime($first);
    $last = strtotime($last);

	for ($asueto = 0; $asueto < sizeof($asuetos); $asueto += 1) {
		$asuetos[$asueto] =  strtotime($asuetos[$asueto]);
	}

    while( $current <= $last ) {

		if(date("w", $current) != 0){

			for ($asueto = 0; $asueto < sizeof($asuetos); $asueto += 1){
				if ($asuetos[$asueto] == $current) {
					$asuetoBol = 1;
				}
			}

			$day = date("j", $current);
			$month = getMonthText(date("m", $current));
			$year = date("Y", $current);
			$weekNumber = date("W", $current);
			$weekDay = getWeekDay(date("w", $current));

			$currentDate = array("dia" => $day, "mes" => $month, "ano" => $year, "semana" => $weekNumber, "diasem" => $weekDay, "asueto" => $asuetoBol);
			$dates[] = $currentDate;
			$asuetoBol = 0;
		}
		$current = strtotime($step, $current);
    }

    return $dates;
}
?>