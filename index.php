<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<?php
require_once('php/connections.php');
require_once('php/functions.php');
//pagina que desea acceder el usuario
if(!isset($_REQUEST['p'])) {
	$_REQUEST['p']=null;
}
$pagina = $_REQUEST['p'];

//Usuario logueado, contiene la Matricula/Numero de Tarjeta
if(!isset($_SESSION['user'])) {
	$_SESSION['user']=null;
}
$user = $_SESSION['user'];
?>
<html>
	<head>
		<title>LABDEI :: <?php echo date('y'); ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<link href="recursos/template.css" rel="stylesheet" type="text/css" />
		<link href="recursos/labdei.js" type="text/javascript" />
	</head>

	<body bgcolor="#CCCCCC" style="text-align:center" leftmargin="0px" rightmargin="0px" topmargin="0px" margin-bottom="0px">
	<center>
		<div class="bigContainer">
			<!-- INICIA SECCION DE HEADER MENOR -->
			<div class="smallHeader" style="width:1000px; text-align:left; ">
				<table width="1000" align="center">
					<tbody>
					<tr>
						<td width="500px">
						<div style="width:100%;font-size:12px;margin-left:10px; text-align:left; margin-top:4px; letter-spacing:2px;">
							TECNOLOGICO DE MONTERREY  &nbsp;&nbsp;|&nbsp; &nbsp; Lenguas Modernas
						</div>
						</td>
						<td width="500px">
						<div style="width:100%;font-size:12px;margin-right:10px; text-align:right; margin-top:4px; letter-spacing:2px;">
								<a onclick="location.href='index.php?p=eperfil'" style="cursor:pointer;"><? echo $_SESSION['user']; ?></a>
								&nbsp; &nbsp; | &nbsp; &nbsp;
								<? if($user == null ) { ?>
									<a onclick="showLoginDiv(true);" style="cursor:pointer;">Entrar</a>
								<? } else { ?>
									<a onclick="location.href='index.php?p=salir'" style="cursor:pointer;">Salir</a>
								<? }  ?>
								&nbsp; &nbsp; &nbsp; &nbsp;
						</div>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
			<!-- TERMINA SECCION DE HEADER MENOR -->

			<!-- INICIA SECCION DE HEADER MAYOR -->
			<div class="bigTitle" style="height: 135px; text-align: left; padding-bottom: 0px; background-image: url(imagenes/header.jpg); clear:both;">
				<table align="center" width="100%">
					<tbody>
					<tr>
						<td align="left" width="70%" style=" vertical-align:top; ">
							<div style="font-size:52px;margin-left:20px; letter-spacing:4px; font-weight:bold; margin-top:30px;">LABDEI</div>
							<div style="font-size:17px; font-family:Arial;margin-left:23px; letter-spacing:2px;">Laboratorio de Idiomas</div>
						</td>
						<td align="right" width="30%" style="">&nbsp;
							<div id="loginDiv" style="color:#FFFFFF; font-size:14px; font-weight:bold; margin-top:15px; margin-right:30px; display:none">
							  <form name="formLogin" method="POST" action="index.php?p=validuser" onSubmit="return validaLogin();">
								<table align="center">
									<tr><td> Usuario : </td><td> <input type="text" name="usuario" /></td></tr>
									<tr><td> Contrase&ntildea: </td><td> <input type="password" name="password" /></td></tr>
									<tr><td colspan="2" align="center">
										<a onclick="return validaOlvidoContra();" style="color:#FFFFFF;font-size:12px;cursor:pointer;">&iquestOlvidaste tu contrase&ntildea?</a>
										<input type="submit" name="btnLogin" value="Entrar >>"/>
									</td></tr>
								</table>
							  </form>
							</div>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
			<!-- TERMINA SECCION DE HEADER MAYOR -->

			<!-- INICIA SECCION DE MENU -->
			<div style="background-image:url(imagenes/menu.jpg);">
				<table width="900px">
					<tbody><tr><td>
					<ul id='menu2' style="width:1000px ">
						<li><a href='index.php' style="margin-left:20px; width:90px;">Principal</a></li>
						<li><a href='index.php?p=quienesSomos' style="width:100px;">Quienes Somos</a></li>
						<li><a href='index.php?p=objetivos' style="width:90px;">Objetivos</a></li>
						<li><a href='index.php?p=reservaciones' style="width:90px;">Reservaciones</a></li>
						<li><a href='index.php?p=tutoriales' style="width:90px;">Tutoriales</a></li>
						<li><a href='index.php?p=tests' style="width:90px;">Aprendizaje autorregulado</a></li>
						<li><a href='index.php?p=buscarRecursos' style="width:90px;">Buscar Recursos</a></li>
						<? if($user != null ) { ?>
						<li><a href='index.php?p=horas' style="width:90px;">Sesiones</a></li>
						<? } ?>
					</ul>
					</td></tr></tbody>
				</table>
			</div>
			<!-- TERMINA SECCION DE MENU -->

			<!-- INICIA SECCION DE CONTENIDO -->
			<div id="contenidoPrincipal" style="background-color: rgb(255, 255, 255); clear:both;">
				<br>
				<?php
				if($pagina != null) {
					switch ($pagina) {
				//--------- Paginas de Acceso publico  --------------//
						case "quienesSomos":
							include('quienesSomos.php');
							break;
						case "objetivos":
							include('objetivos.php');
							break;
						case "servicios":
							include('servicios.php');
							break;
						case "tutoriales":
							include('tutoriales.php');
							break;
						case "autoestudio":
							include('autoestudio.php');
							break;
						case "practicasTOEFL":
							include('practicarTOEFL.php');
							break;
						case "customRecommendation":
							include('getTreeDB.php');
							break;
						case "horas":
							include('horas.php');
							break;
						case "tests":
							include('tests.php');
							break;
						case "resultados":
							include('resultados.php');
							break;
						case "enviarSugerencias":
							include('enviarSugerencias.php');
							break;
						case "recomendaciones":
							include('recomendaciones.php');
							break;
						case "buscarRecursos":
							include('buscarRecursos.php');
						break;
						case "buscadorRec":
							include('buscadorRec.php');
						break;
						case "indice":
							include('indice.php');
						break;
			//--------- Paginas de Logueo y Deslogueo  --------------//
						case "validuser":
							include('validuser.php');
							break;
						case "salir":
							include('salir.php');
							break;
						case "uDes":
							include('usuarioDeslogueado.php');
							break;
						case "uNR":
							include('usuarioNoRegistrado.php');
							break;
						case "UoCI":
							include('usuarioOContrasenaIncorrecta.php');
							break;
			//--------- Paginas de Reservaciones  --------------//
						case "reservaciones":
							validLoguedUserToInclude('reservaciones.php');
							break;
						case "semanas":
							validLoguedUserToInclude('semanas.php');
							break;
						case "salon":
							validLoguedUserToInclude('salon.php');
							break;
						case "salon424s":
							validLoguedUserToInclude('salon424s.php');
							break;
						case "salon424":
							validLoguedUserToInclude('salon424.php');
							break;
						case "salon423":
							validLoguedUserToInclude('salon423.php');
							break;
						case "exito":
							validLoguedUserToInclude('exito.php');
							break;
						case "cancelacion":
							validLoguedUserToInclude('cancelacion.php');
							break;
			//--------- Paginas de INFORMACION ALUMNO (Perfil de Usuario/Olvido de contrase�a)  --------------//
						case "eperfil":
							validLoguedUserToInclude('perfilUsuario.php');
							break;
						case "peperfil":
							validLoguedUserToInclude('perfilUsuarioBD.php');
							break;
						case "olvcont":
							include('olvidoContrasena.php');
							break;
				//--------- PAGINA PRINCIPAL  --------------//
						default:
							include('principal.php');
							break;
					}
				} else {
					include('principal.php');
				}
				?>
				<br><br>
			</div>
			<!-- TERMINA SECCION DE CONTENIDO -->

			<!-- INICIA SECCION DE PIE DE PAGINA -->
			<div style="height:20px;background-color:#003366; ">
				&nbsp;
			</div>
			<div style="height:30px;background-color:#FFFFFF; font-size:10px; font-weight:bold;">
				Instituto Tecnol�gico y de Estudios Superiores de Monterrey  - Laboratorio de Idiomas <br>
				&copy; <?php echo date('Y'); ?>, Derechos Reservados.
			</div>
			<!-- TERMINA SECCION DE PIE DE PAGINA -->
		</div>
		</center>
	</body>
</html>

<script>
function showLoginDiv(value) {
	if(value)
		document.getElementById('loginDiv').style.display = '';
	else
		document.getElementById('loginDiv').style.display = 'none';
}

function validaLogin()
{
	var stringError = '';
	if (document.formLogin.usuario.value == '')
	{   stringError = stringError + ' \n Favor de escribir el Usuario';
		document.formLogin.usuario.focus();
	} else {
		if( !verificaMat()){
			stringError = stringError + ' \n El Usuario no es v�lido. \n S�lo se aceptan n�meros en la matr�cula (Sin espacios).';
			document.formLogin.usuario.focus();
		}
	}
	if (document.formLogin.password.value == '')
	{
		stringError = stringError + ' \n Falta de escribir la Contrase�a';
		document.formLogin.password.focus();
	}

	if(stringError != '') {
		alert(stringError);
		return false;
	}
}

function validaOlvidoContra()
{
	if (document.formLogin.usuario.value == '')
	{
		alert( ' \n Favor de escribir el Usuario para poder enviarte la contrase�a a tu correo electr�nico');
		document.formLogin.usuario.focus();
		return false;
	} else {
		if(!verificaMat()) {
			alert( ' \n El Usuario no es v�lido. \n S�lo se aceptan n�meros en la matr�cula (Sin espacios).');
			document.formLogin.usuario.focus();
			return false;
		} else {
			location.href='index.php?p=olvcont&m=' + document.formLogin.usuario.value;
			return true;
			}
	}
}

function verificaMat()
{
  strMat = document.formLogin.usuario.value;

   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;

		 for (i = 0; i < strMat.length && IsNumber == true; i++)
      {
      Char = strMat.charAt(i);
      if (ValidChars.indexOf(Char) == -1)
         {
         	IsNumber = false;
         }
      }
	  return IsNumber;
}
</script>
