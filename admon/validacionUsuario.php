<?php require_once('../php/connections.php'); 

$idiomas = getConection();
$u_consultauser = "1";
if (isset($_REQUEST["TxUsername"])) {
  $u_consultauser = (get_magic_quotes_gpc()) ? $_REQUEST["TxUsername"] : addslashes($_REQUEST["TxUsername"]);
}
$p_consultauser = "1";
if (isset($_REQUEST["TxPassword"])) {
  $p_consultauser = (get_magic_quotes_gpc()) ? $_REQUEST["TxPassword"] : addslashes($_REQUEST["TxPassword"]);
}
mysql_select_db($database_idiomas, $idiomas);
$query_consultauser = sprintf("SELECT * FROM tbl_admon WHERE user = '%s' AND password = '%s'", $u_consultauser,$p_consultauser);
$consultauser = mysql_query($query_consultauser, $idiomas) or die(mysql_error());
$row_consultauser = mysql_fetch_assoc($consultauser);
$totalRows_consultauser = mysql_num_rows($consultauser);
?>
<?php 
		$user = $_REQUEST["TxUsername"];
		$pass = $_REQUEST["TxPassword"];

		
		if($totalRows_consultauser == 1)		
		{
			$_SESSION["usuario"] = $user;
		}
mysql_free_result($consultauser);
closeConection($idiomas);
		echo "<script type=\"text/javascript\">location.href='index.php';</script>";
		
?>
