<?php
$idiomas = getConection();
$user1 = $_POST["usuario"];
$pass = $_POST["password"];

$u_consultauser = "1";
if (isset($user1)) {
  $u_consultauser = (get_magic_quotes_gpc()) ? $user1 : addslashes($user1);
}
$p_consultauser = "1";
if (isset($pass)) {
  $p_consultauser = (get_magic_quotes_gpc()) ? $pass : addslashes($pass);
}

//Obteniendo la informacion del usuario
$query_mat = sprintf("SELECT * FROM tbl_matriculas WHERE matricula = '%s'", $u_consultauser);
$consulta_mat = mysql_query($query_mat, $idiomas) or die(mysql_error());
$rows_mat = mysql_num_rows($consulta_mat);

//Si la matricula esta en la base de datos
if($rows_mat == 1) {

	$query_consultauser = sprintf("SELECT * FROM tbl_matriculas WHERE matricula = '%s' AND password = '%s'", $u_consultauser,$p_consultauser);
	$consultauser = mysql_query($query_consultauser, $idiomas) or die(mysql_error());
	$usuario = mysql_fetch_array($consultauser);
	$totalRows_consultauser = mysql_num_rows($consultauser);
	
	if($totalRows_consultauser == 1)		
	{
		$_SESSION["user"] = $user1;
		
		//Si no ha cambiado su password mandar a perfil de usuario.
		if($usuario[8] == 0) { ?>
			<script>
				location.href='index.php?p=eperfil';
			</script>
		<? }
	}
	else {
			//Mandar a pagina de mensaje de que no existe en la base de datos. ?>
			<script>
				location.href='index.php?p=UoCI';
			</script>
			<?
		}
} else {
	//Mandar a pagina de mensaje de que no existe en la base de datos. ?>
	<script>
		location.href='index.php?p=uNR';
	</script>
	<?
}
closeConection($idiomas);

?>
<script>
location.href='index.php';
</script>
