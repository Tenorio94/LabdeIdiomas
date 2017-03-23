<?php session_start(); ?>

<?php require_once('../php/connections.php'); 

$idiomas = getConection();

$usernameR = $_REQUEST["TxUsername"];
$passwordR = $_REQUEST["TxPassword"];

$query_consultauser = "SELECT * FROM tbl_admon WHERE user = '$usernameR' AND password = '$passwordR'" ;
$consultauser = $idiomas->query($query_consultauser);
$row_consultauser = $consultauser->fetch_assoc();

?>
<?php 
		$user = $_REQUEST["TxUsername"];
		$pass = $_REQUEST["TxPassword"];

		
		if($consultauser->num_rows == 1)		
		{
			$_SESSION["usuario"] = $user;
		}

closeConection($idiomas);
		echo "<script type=\"text/javascript\">location.href='index.php';</script>";
		
?>
