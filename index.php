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
		<link href="recursos/css/template.css" rel="stylesheet" type="text/css" />
		<link href="recursos/js/labdei.js" type="text/javascript" />
		<script src="recursos/js/i18next.min.js"></script>
		<script src="recursos/js/javascript_functions.js"></script>
		<script src="recursos/js/jquery-3.1.1.min.js"></script>
		<script>window.sessionStorage.setItem('lang', 'es');</script>

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
						<div>
							<span class="flag-container">
								<span>
									<input type="image" id="united-kingdom-button" src="imagenes/banderas/gb.png" style="width:30px; height: 19px;" onclick="changeLanguage(this.id)" />
								</span>
								<span>
									<input type="image" id="spain-button" src="imagenes/banderas/es.png" onclick="changeLanguage(this.id)"/>
								</span>
								<span>
									<input type="image" id="france-button" src="imagenes/banderas/fr.png" onclick="changeLanguage(this.id)"/>
								</span>
								<span>
									<input type="image" id="germany-button" src="imagenes/banderas/de.png" onclick="changeLanguage(this.id)"/>
								</span>
								<span>
									<input type="image" id="korea-button" src="imagenes/banderas/kr.png" onclick="changeLanguage(this.id)"/>
								</span>
								
							</span>
						<span style="width:100%;font-size:12px;margin-right:10px; text-align:right; margin-top:4px; letter-spacing:2px;">
							<a onclick="location.href='index.php?p=eperfil'" style="cursor:pointer;"><? echo $_SESSION['user']; ?></a>
								&nbsp; &nbsp; | &nbsp; &nbsp;
							<? if($user == null ) { ?>
							<a onclick="showLoginDiv(true);" style="cursor:pointer;" class="multilingual">entrar</a>
								<? } else { ?>
							<a onclick="location.href='index.php?p=salir'" style="cursor:pointer;" class="multilingual">salir</a>
								<? }  ?>
								&nbsp; &nbsp; &nbsp; &nbsp;
						</span>
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
									<tr><td class="multilingual">usuario</td><td> <input type="text" name="usuario" /></td></tr>
									<tr><td class="multilingual">pass</td><td> <input type="password" name="password" /></td></tr>
									<tr><td colspan="2" align="center">
										<a onclick="return validaOlvidoContra();" style="color:#FFFFFF;font-size:12px;cursor:pointer;" class="multilingual">olvidaste_tu_contra</a>
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
						<li><a class="multilingual" href='index.php' style="margin-left:20px; width:90px;">principal</a></li>
						<li><a class="multilingual" href='index.php?p=quienesSomos' style="width:100px;">quienes_somos</a></li>
						<li><a class="multilingual" href='index.php?p=objetivos' style="width:90px;">objetivos</a></li>
						<li><a class="multilingual" href='index.php?p=reservaciones' style="width:90px;">reservaciones</a></li>
						<li><a class="multilingual" href='index.php?p=tutoriales' style="width:90px;">tutoriales</a></li>
						<li><a class="multilingual" href='index.php?p=tests' style="width:90px;">aprendizaje_autoregulado</a></li>
						<li><a class="multilingual" href='index.php?p=buscarRecursos' style="width:90px;">buscar_recursos</a></li>
						<? if($user != null ) { ?>
						<li><a class="multilingual" href='index.php?p=horas' style="width:90px;">sesiones</a></li>
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
		<script>
			if(window.sessionStorage.getItem('lang') == 'null'){
				document.documentElement.lang = 'es';
			}else{
				document.documentElement.lang = window.sessionStorage.getItem('lang');
			}
			window.sessionStorage.setItem('lang', document.documentElement.lang);
		</script>
		<script src="recursos/js/i18init.js"></script>
		<script>
			Utils.applyMultilingualLabels('.bigContainer', '.multilingual');
			Utils.applyMultilingualLabels('.bigContainer', '.title-multilingual');
			Utils.applyMultilingualLabels('.bigContainer', '.leftTitle-multilingual');
			
		</script>

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

function changeLanguage(lang){
	/*if (typeof(Storage) !== "undefined") {
	    alert("localstorage support")
	} else {
	    // Sorry! No Web Storage support..
	}*/
	switch(lang) {
		case 'united-kingdom-button':
			window.sessionStorage.setItem('lang', 'en');
			if (document.documentElement.lang !== 'en')
			{
				location.reload();
			}
			break;
		case 'spain-button':
			window.sessionStorage.setItem('lang', 'es');
			if (document.documentElement.lang !== "es")
			{
				location.reload();
			}
			break;
		case 'germany-button':
			document.documentElement.lang = 'de';
			break;
		case 'france-button':
			document.documentElement.lang = 'en';
			break;
		case 'korea-button':
			document.documentElement.lang = 'en';
			break;
		default : 
			window.sessionStorage.setItem('lang', 'es');
			break;
	}
}

</script>
