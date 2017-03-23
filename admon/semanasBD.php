<?php
//Abriendo conexion con la base de datos
$idiomas = getConection();

//Obteniendo informacion de las semanas
$semanas_query = $idiomas->query("SELECT semana FROM tbl_semanas WHERE id = 12");
$semana = $semanas_query->fetch_assoc();

//Borrando la primer semana de la base de datos
$delete_query = $idiomas->query("DELETE FROM tbl_semanas WHERE id < 7");

//Ahora la segunda semana debe convertirse en la primer semana
$cambio_semana_query = $idiomas->query("UPDATE tbl_semanas SET id = (id - 6)");

//Obteniendo la informacion de la forma
$lunes = $_POST["lunes"];
$lunesm = $_POST["lunesm"];
$lunes_asueto = $_POST["lunes_asueto"];
if($lunes_asueto == "") $lunes_asueto = 0;
$martes = $_POST["martes"];
$martesm = $_POST["martesm"];
$martes_asueto = $_POST["martes_asueto"];
if($martes_asueto == "") $martes_asueto = 0;
$miercoles = $_POST["miercoles"];
$miercolesm = $_POST["miercolesm"];
$miercoles_asueto = $_POST["miercoles_asueto"];
if($miercoles_asueto == "") $miercoles_asueto = 0;
$jueves = $_POST["jueves"];
$juevesm = $_POST["juevesm"];
$jueves_asueto = $_POST["jueves_asueto"];
if($jueves_asueto == "") $jueves_asueto = 0;
$viernes = $_POST["viernes"];
$viernesm = $_POST["viernesm"];
$viernes_asueto = $_POST["viernes_asueto"];
if($viernes_asueto == "") $viernes_asueto = 0;
$sabado = $_POST["sabado"];
$sabadom = $_POST["sabadom"];
$sabado_asueto = $_POST["sabado_asueto"];
if($sabado_asueto == "") $sabado_asueto = 0;

//Obteniendo el nuevo numero de semana
$semana1 = $semana["semana"];
$semana_nueva = $semana1 + 1;

//Insertar los registros de la nueva semana
$in1 = "INSERT INTO tbl_semanas (id, dia, mes, semana, diasem, asueto) VALUES (7, $lunes, '$lunesm', $semana_nueva, 'lunes', $lunes_asueto)";
$qin1 = $idiomas->query($in1);
$in2 = "INSERT INTO tbl_semanas (id, dia, mes, semana, diasem, asueto) VALUES (8, $martes, '$martesm', $semana_nueva, 'martes', $martes_asueto)";
$qin2 = $idiomas->query($in2);
$in3 = "INSERT INTO tbl_semanas (id, dia, mes, semana, diasem, asueto) VALUES (9, $miercoles, '$miercolesm', $semana_nueva , 'miercoles', $miercoles_asueto)";
$qin3 = $idiomas->query($in3);
$in4 = "INSERT INTO tbl_semanas (id, dia, mes, semana, diasem, asueto) VALUES (10, $jueves , '$juevesm', $semana_nueva , 'jueves', $jueves_asueto)";
$qin4 = $idiomas->query($in4);
$in5 = "INSERT INTO tbl_semanas (id, dia, mes, semana, diasem, asueto) VALUES (11, $viernes, '$viernesm', $semana_nueva, 'viernes', $viernes_asueto)";
$qin5 = $idiomas->query($in5);
$in6 = "INSERT INTO tbl_semanas (id, dia, mes, semana, diasem, asueto) VALUES (12, $sabado, '$sabadom', $semana_nueva, 'sabado', $sabado_asueto)";
$qin6 = $idiomas->query($in6);

//Cerrando conexion
closeConection($idiomas);
?>

 <p align="center" class="titulo">Cambio de semana exitoso.</p>



