<?php
$idiomas = getConection();
$user1 = $_POST["usuario"];
$pass = $_POST["password"];

//$u_consultauser = "1";
// if (isset($user1)) {
// 	echo $user1;
//   $u_consultauser = (get_magic_quotes_gpc()) ? $user1 : addslashes($user1);
// }
// $p_consultauser = "1";
// if (isset($pass)) {
//   $p_consultauser = (get_magic_quotes_gpc()) ? $pass : addslashes($pass);
// }

//Obteniendo la informacion del usuario
$consulta_mat = $idiomas->query("SELECT * FROM tbl_matriculas WHERE matricula = '$user1'");

//Si la matricula esta en la base de datos
if($consulta_mat->num_rows == 1) {

	$consultauser = $idiomas->query("SELECT * FROM tbl_matriculas WHERE matricula = '$user1' AND password = '$pass'");
	$usuario = $consultauser->fetch_assoc();
	
	if($consultauser->num_rows == 1)		
	{
		$_SESSION["user"] = $user1;
		
		//Si no ha cambiado su password mandar a perfil de usuario.
		if($usuario["flagPassword"] == 0) { ?>
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
