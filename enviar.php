<?php?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
</head>
<body>
<?php

$con=mysqli_connect("localhost","wlmuser1","landpeac","wlmreservacion");

if(mysqli_connect_errno()){
	echo "Fallo la conexion" . mysqli_connect_errno();
}

require 'PHPMailer-master/PHPMailerAutoload.php';


$nombre = $_POST['nombre'];
$matricula = $_POST['matricula'];
$correo = $_POST['correo'];
$puntaje = $_POST['puntaje'];
$puntaje2 = $_POST['niveles'];

if($puntaje2 == null || $puntaje == ""){
	$puntaje=$puntaje2;
}

$nivel=1;//A1

if ($puntaje>440){
	$nivel=2;//A2
	if ($puntaje>470){
		$nivel=3;//B1
		if ($puntaje>537){
			$nivel=4;//B2/C1
		}

	}
}

$niveles = array(
    1    => "A1",
    2  	 => "A2",
    3    => "B1",
    4 	 => "B2/C1",
);

$mail = new PHPMailer(); // create a new object¡
$mail->Host = "itesm.mx";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "crai.mty@servicios.itesm.mx";
$mail->Password = "venajebu";
$mail->SetFrom("crai.mty@servicios.itesm.mx");
$mail->Subject = "Material para Estudiar";

$mail->Body = "Nombre: " .$nombre ."<br>Matricula: " .$matricula ."<br>Nivel TOEFL: " .$niveles[$nivel] ."<br>Correo electr&oacute;nico: " .$correo ."<br><br>";

$mail->Body = $mail->Body ."Hola " .$nombre .", <br> " ." Bas&aacute;ndonos en tu puntaje, te recomendamos los siguientes materiales que pueden serte &uacute;tiles para lograr tus metas de aprendizaje. <br><br>";


if(isset($_POST['temas'])) {

				$temas = $_POST['temas'];

				foreach ($temas as $tema){
					$result = mysqli_query($con,"SELECT * FROM recursos WHERE Tipo='".$tema ."' and Nivel='0'");
					$resultDef = mysqli_query($con,"SELECT * FROM recursos WHERE Tipo='".$tema ."' and Nivel='" .$nivel ."'");

					while($row = mysqli_fetch_array($result)) {
						$rowDef = mysqli_fetch_array($resultDef);
						if($row['Tipo'] == "ComparativesSuperlatives"){
							$mail->Body = $mail->Body ."<h1>Para el tema " ."Comparatives and Superlatives" . ":</h1><br>" . $row['Contenido'] ."<br>" 
							."De material bibiliogr&#225;fico para consulta en la Mediateca (CIAP-423):<br>" .$rowDef['Contenido'] ."<br>";
						}
						else if($row['Tipo'] == "WordChoice"){
							$mail->Body = $mail->Body ."<h1>Para el tema " ."Word Choice" . ":</h1><br>" . $row['Contenido'] ."<br>" 
							."De material bibiliogr&#225;fico para consulta en la Mediateca (CIAP-423):<br>" .$rowDef['Contenido'] ."<br>";
						}
						else if($row['Tipo'] == "SVAgreement"){
							$mail->Body = $mail->Body ."<h1>Para el tema " ."Subject-Verb Agreement" . ":</h1><br>" . $row['Contenido'] ."<br>" 
							."De material bibiliogr&#225;fico para consulta en la Mediateca (CIAP-423):<br>" .$rowDef['Contenido'] ."<br>";
						}
						else if($row['Tipo'] == "InvertedSentences"){
							$mail->Body = $mail->Body ."<h1>Para el tema " ."Inverted Sentences" . ":</h1><br>" . $row['Contenido'] ."<br>"
							."De material bibiliogr&#225;fico para consulta en la Mediateca (CIAP-423):<br>" .$rowDef['Contenido'] ."<br>";
						}
						else if($row['Tipo'] == "SimpleSentences"){
							$mail->Body = $mail->Body ."<h1>Para el tema " ."Simple Sentences" . ":</h1><br>" . $row['Contenido'] ."<br>" 
							."De material bibiliogr&#225;fico para consulta en la Mediateca (CIAP-423):<br>" .$rowDef['Contenido'] ."<br>";
						}
						else if($row['Tipo'] == "CompoundSentences"){
							$mail->Body = $mail->Body ."<h1>Para el tema " ."Compound Sentences" . ":</h1><br>" . $row['Contenido'] ."<br>" 
							."De material bibiliogr&#225;fico para consulta en la Mediateca (CIAP-423):<br>" .$rowDef['Contenido'] ."<br>";
						}
						else if($row['Tipo'] == "ComplexSentences"){
							$mail->Body = $mail->Body ."<h1>Para el tema " ."Complex Sentences" . ":</h1><br>" . $row['Contenido'] ."<br>" 
							."De material bibiliogr&#225;fico para consulta en la Mediateca (CIAP-423):<br>" .$rowDef['Contenido'] ."<br>";
						}
						else{
							$mail->Body = $mail->Body ."<h1>Para el tema " .$row['Tipo'] . ":</h1><br>" . $row['Contenido'] ."<br>" 
							."De material bibiliogr&#225;fico para consulta en la Mediateca (CIAP-423):<br>" .$rowDef['Contenido'] ."<br>";
						}
					}
				}

			}

			$mail->Body = $mail->Body ."Centro de Recursos para el Aprendizaje de Idiomas <br>Departamento de Lenguas Modernas <br>Escuela de Negocios, Ciencias Sociales y Humanidades <br>Rector&iacute;a de la Zona Metropolitana de Monterrey <br>TEC DE MONTERREY";

$mail->AddAddress($correo);
 if(!$mail->Send())
    {
    echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
    echo "Mensaje enviado:<br>" .$mail->Body;
    }

    mysqli_close($con);

    //echo "<script>window.close();</script>";

?>
</body>
</html>
