<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php 
require_once('../php/connections.php'); 
//pagina que desea acceder el usuario
if(!isset($_REQUEST['p'])) {
	$_REQUEST['p']=null;
}
$pagina = $_REQUEST['p'];

//Usuario logueado, contiene la Matricula/Numero de Tarjeta
if(!isset($_SESSION['usuario'])) {
	$_SESSION['usuario']=null;
}
$user = $_SESSION['usuario'];
?> 
<html>
	<head>
		<title>LABDEI :: <?php echo date('Y'); ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="../recursos/css/template.css" rel="stylesheet" type="text/css" />
		<link href="../recursos/js/labdei.js" type="text/javascript" />
	</head>
	
	<body bgcolor="#CCCCCC" style="text-align:center" leftmargin="0px" rightmargin="0px" topmargin="0px" margin-bottom="0px">
	<center>
		<div class="bigContainer">
			<div class="smallHeader" style="width:1000; text-align:left; ">
				<table width="1000" align="center">
					<tbody>
					<tr>
						<td width="950px">
						<div style="width:100%;font-size:12px;margin-left:10px; text-align:left; margin-top:4px; letter-spacing:2px;">
							TECNOLOGICO DE MONTERREY  &nbsp;&nbsp;|&nbsp; &nbsp; Lenguas Modernas
						</div>
						</td>
						<td width="50px">
						<? if($user != null ) { ?> 
						<div style="width:100%;font-size:12px;"><a onclick="location.href='index.php?p=salir'" style="cursor:pointer;">Salir</a></div>
						<? } ?>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
			<div class="bigTitle" style="height: 135px; text-align: left; padding-bottom: 0px; background-image: url(../imagenes/header.jpg); clear:both;">
				<table align="center" width="100%">
				<tbody>
					<tr>
						<td align="left" width="100%">
							<div style="font-size:52px;margin-left:20px; letter-spacing:4px; font-weight:bold; margin-top:30px;">LABDEI</div>
							<div style="font-size:17px; font-family:Arial;margin-left:23px; letter-spacing:2px;">Laboratorio de Idiomas</div>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
			<div style="background-image:url(../imagenes/menu.jpg);">
				<table width="1000px">
					<tbody><tr><td>
								<ul id='menu2' style="width:1000px ">
									<li><a href='index.php?p=reservaciones' style="margin-left:0px; width:100px;">Reservaciones</a></li>
									<li><a href='index.php?p=amatriculas' style="width:100px;">Alta Matriculas</a></li>
									<li><a href='index.php?p=semanas' style="width:60px;">Semanas</a></li>
									<li><a href='index.php?p=salones' style="width:60px;">Salones</a></li>
									<li><a href='index.php?p=busqueda' style="width:60px;">Búsqueda</a></li>
									<li><a href='index.php?p=testimonios' style="width:100px;">Testimonios</a></li>
									<li><a href='index.php?p=avisos' style="width:60px;">Avisos</a></li>
									<li><a href='index.php?p=varios' style="width:60px;">Varios</a></li>
									<li><a href='index.php?p=horas' style="width:50px;">Sesiones</a></li>
									<li><a href='index.php?p=recomendaciones' style="width:100px;">Recomendaciones</a></li>
								</ul>
					</td></tr></tbody>
				</table>
			</div>
			
			
			<div style="background-color:#FFFFFF">
			<br>
<? 
			if($user != null) {
				switch ($pagina) {
			//--------- Inician paginas de RECOMENDACIONES -----//
					case "recomendaciones":
						include('recomendaciones.php');
						break;
					case "createCustomRecomendation":
						include('createCustomRecomendation.php');
						break;
					case "deleteCustomRecomendation":
						include('deleteCustomRecomendation.php');
						break;
					case "editRecommendation":
						include('editRecommendation.php');
						break;
			//--------- Inician paginas de RESERVACIONES -----//
					case "reservaciones":
						include('reservaciones.php');
						break;
					case "preservaciones":
						include('reservacionesBD.php');
						break;							
					case "selsalon":
						include('seleccionSalon.php');
						break;		
					case "salon423":
						include('salon423.php');
						break;				
					case "salon424":
						include('salon424.php');
						break;	
					case "salon424s":
						include('salon424s.php');
						break;																					
			//--------- Inician paginas de ALTA MATRICULAS -----//	
					case "amatriculas":
						include('altaMatriculas.php');
						break;
					case "pamatriculasind":
						include('altaMatriculasIndBD.php');
						break;			
					case "pamatriculasgpo":
						include('altaMatriculasGpoBD.php');
						break;											
			//--------- Inician paginas de SEMANAS -----//						
					case "semanas":
						include('semanas.php');
						break;
					case "semanasBD":
						include('semanasBD.php');
						break;
			//--------- Inician paginas de SALONES -----//						
					case "salones":
						include('salones.php');
						break;
					case "salonesBD":
						include('salonesBD.php');
						break;				
			//--------- Inician paginas de BUSQUEDA de alumnos -----//						
					case "busqueda":
						include('busquedaAlumno.php');
						break;
					case "pbreservacion":
						include('bajaReservacionAlumno.php');
						break;
					case "ealumno":
						include('edicionAlumno.php');
						break;
					case "pealumno":
						include('edicionAlumnoBD.php');
						break;
			//--------- Inician paginas de TESTIMONIOS  ----------//					
					case "testimonios":
						include('testimonios.php');
						break;	
					case "atestimonio":
						include('altaTestimonio.php');
						break;	
					case "patestimonio":
						include('altaTestimonioBD.php');
						break;		
					case "pbtestimonio":
						include('bajaTestimonioBD.php');
						break;		
					case "etestimonio":
						include('edicionTestimonio.php');
						break;	
					case "petestimonio":
						include('edicionTestimonioBD.php');
						break;
			//--------- Inician paginas de AVISOS  --------------//
					case "avisos":
						include('avisos.php');
						break;	
					case "aaviso":
						include('altaAviso.php');
						break;	
					case "paaviso":
						include('altaAvisoBD.php');
						break;		
					case "pbaviso":
						include('bajaAvisoBD.php');
						break;		
					case "eaviso":
						include('edicionAviso.php');
						break;	
					case "peaviso":
						include('edicionAvisoBD.php');
						break;		
			//--------- Inician paginas de VARIOS  --------------//
					case "varios":
						include('varios.php');
						break;		
					case "bregistros":
						include('bajaRegistros.php');
						break;					
					case "bcomentarios":
						include('bajaComentarios.php');
						break;							
			//--------- Pagina para Horas  --------------//									
					case "horas":
						include('horas.php');
						break;	
					case "acthoras":
						include('actualizarHoras.php');
						break;							
			//--------- Pagina para desloguearse  --------------//									
					case "salir":
						include('salir.php');
						break;		
			//--------- PAGINA PRINCIPAL  --------------//																							
					default: 
						include('principal.php');
						break;				
				}
			} else {
				include('login.php');
			}

?>
			<br><br>
			</div>
			<div style="height:20px;background-color:#003366; ">
				&nbsp;
			</div>
			<div style="height:30px;background-color:#FFFFFF; font-size:10px; font-weight:bold;">
				Instituto Tecnológico y de Estudios Superiores de Monterrey  - Laboratorio de Idiomas <br>
				&copy; <?php echo date('Y'); ?>, Derechos Reservados.
			</div>
		</div>
	</body>
</html>

<script>
function showLoginDiv(value) {
	if(value)
		document.getElementById('loginDiv').style.display = '';
	else
		document.getElementById('loginDiv').style.display = 'none';
}
	
</script>
