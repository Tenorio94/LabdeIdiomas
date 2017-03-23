<?php session_start(); ?>
<?php require_once('../php/connections.php'); 

$idiomas = getConection();

$query_consultauser = sprintf("SELECT * FROM tbl_admon WHERE user = '%s' AND password = '%s'", $u_consultauser,$p_consultauser);
$consultauser = $idiomas->query($query_consultauser);
$row_consultauser = $consultauser->fetch_assoc();
$totalRows_consultauser = mysql_num_rows($consultauser);
?>
<?php 
		$user = $_REQUEST["TxUsername"];
		$pass = $_REQUEST["TxPassword"];

		
		if($consultauser->num_rows == 1)		
		{
			$_SESSION["usuario"] = $user;
		}
mysql_free_result($consultauser);
closeConection($idiomas);
		echo "<script type=\"text/javascript\">location.href='index.php';</script>";
		
?>
