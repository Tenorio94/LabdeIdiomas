<?php
//CUALQUIER CAMBIO QUE SE DESEE HACER AQUI VERIFICAR QUE TAMBIEN SE ADAPTO "autoestudio.php"
$elegir= array(
"A"=>"Leer textos academicos eficientemente",
"B"=>"Comprender conferencias",
"C"=>"Comunicarse oralmente",
"D"=>"Redactar reportes de investigacion",
"E"=>"Redactar documentos personales",
"F"=>"Comunicarse a traves del correo electronico, participar en foros de discusion y blogs",
"G"=>"Realizar estudios profesionales y/o de postgrado en el extranjero",
"H"=>"Presentar ponencias en el extranjero",
"I"=>"Acreditar su nivel de dominio del idioma a traves de una prueba estandarizada (TOEFL, IELTS, DELF, etc.)");

//Se definen las recomendaciones a cada opcion.
$recomendaciones= array(
"A"=>"- Para leer textos académicos eficientemente, recomendamos los materiales específicos que están en la sección de 'Reading', como 'Get Ready to Read' y 'Read and Think'.",
"B"=>"- Para comprender conferencias recomendamos los materiales específicos que están dentro de la sección de 'Listening', como 'Contemporary Topics' , 'Fifty-Fifty a Speaking and Listening Course', 'Real Talk' y 'Speaking Of Values'.",
"C"=>"- Para la comunicación oral, recomendamos trabajar con el software 'Tell Me More' y las series 'Fifty-Fifty' y 'Speaking and Listening Course'.",
"D"=>"- Para redactar reportes de investigación, tenemos algunos materiales específicos como la serie 'Write Ahead' y 'Ready to Write More From Paragraph To Essay', 'The Essentials of English: A Writer's Handbook', 'Writing to Communicate: Paragraphs and Essays 2'.",
"E"=>"- Para redactar documentos personales, recomendamos las series 'Writing to Communicate' y 'Get Ready to Write'.",
"F"=>"- Para comunicarse a través del correo electrónico  participar en foros de discusión y blogs,  recomendamos la serie 'Writing to Communicate'.",
"G"=> "- Para prepararse para realizar estudios de postgrado en el extranjero tenemos algunos materiales específicos como la serie 'Contemporary Topics', Academic Listening and Note-Taking Skills y otros de inglés por área de especialidad que pueden resultar muy útiles.",
"H"=>"- Para presentar ponencias en el extranjero, recomendamos las series: 'Writing to Communicate' 'Real Talk' y 'Speaking of Values'.",
"I"=>"- Para acreditar su nivel de dominio en el TOEFL, sugerimos trabajar en cada una de las secciones (Listening, Structure and Written Expression, and Reading) en el software de preparación para el TOEFL: Longman Student CD-ROM for theTOEFL® Test: The Paper Test.",
"J"=>"- OPCION INVALIDA");

$enviar=$_POST['nombre']."<br>".$_POST['matricula']."<br>".$_POST['correo']."<br><br>";
if(isset($_POST['puntajeTOEFL'])) {
	$enviar.="Puntaje TOEFL: ".$_POST['puntajeTOEFL']."<br>";
	$enviar.="Listening: ".$_POST['puntajeListening']."<br>";
	$enviar.="Structure and Written Expression: ".$_POST['puntajeWritten']."<br>";
	$enviar.="Reading: ".$_POST['puntajeReading']."<br><br>";
}
else {
	$enviar.="Resultado en Examen de Habilidad: ".$_POST['puntajeAlcanzado']."<br><br>";
}
$contador=0;
for($i=1; $i<=15; $i++) { //Si se cambia la cantidad de preguntas se debe cambiar este numero.
	$contador+=$_POST['respuesta'.$i];
}
if($contador>=50) {
	$enviar.="Después de analizar los resultados de la encuesta nos complace informarle que es apto para participar en este proyecto de aprendizaje autorregulado.<br>";
	echo "Despu&eacutes de analizar los resultados de la encuesta nos complace informarle que es apto para participar en este proyecto de aprendizaje autorregulado.";
	$enviar.="Entre las metas prioritarias para usted están: ".$elegir[$_POST['opcion1']].", ".$elegir[$_POST['opcion2']]." y ".$elegir[$_POST['opcion3']].".<br>";
}
else {
	$enviar.="Lo sentimos, desafortunadamente no cuentas aun con las habilidades necesarias para participar en este proyecto de aprendizaje autorregulado.<br>";
	echo "Lo sentimos, desafortunadamente no cuentas aun con las habilidades necesarias para participar en este proyecto de aprendizaje autorregulado.";
	$enviar.="Te sugerimos tomar el curso de preparacion para el aprendizaje autorregulado de idiomas<br>";
}

$enviar.="<br><br>Sugerencias para alcanzar sus metas de aprendizaje:<br><br>";
for($i=1; $i<=3; $i++) { //Se debe cambiar aqui si se desea que se elijan mas o menos opciones
	$enviar.=$recomendaciones[$_POST['opcion'.$i]]."<br>";
}

//echo $enviar //Para verificar que se envio la informacion adecuadamente


//SEND MAIL
enviarEmail($_POST['correo'], "Resultado auto diagnóstico", $enviar);
enviarEmail("crai.mty@servicios.itesm.mx", "Resultado auto diagnóstico", $enviar);

echo "<br>La informacion ha sido enviada exitosamente.";
?>