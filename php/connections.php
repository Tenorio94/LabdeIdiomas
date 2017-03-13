<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

function getConection() {
	$hostname_idiomas = "localhost";
	$database_idiomas = "wlmreservacion";
	$username_idiomas = "wlmuser1";
	$password_idiomas = "landpeac";

    // servername, username, password, dbname
    $connection = mysqli_connect($hostname_idiomas, $username_idiomas, $password_idiomas, $database_idiomas);
    $connection->set_charset('utf8');

    # Check connection
    if ($connection->connect_error) {
        return null;
    }

    return $connection;
}

// function getConection() {
// 	$hostname_idiomas = "localhost";
// 	$database_idiomas = "wlmreservacion";
// 	$username_idiomas = "wlmuser1";
// 	$password_idiomas = "landpeac";
// 	$idiomas = mysql_pconnect($hostname_idiomas, $username_idiomas, $password_idiomas) or die(mysql_error());
// 	mysql_select_db($database_idiomas, $idiomas);
// 	date_default_timezone_set("America/Monterrey");
	
// 	return $idiomas;
// }

function closeConection($con) {
	if($con != NULL) {
		mysqli_close($con);
	}
}
?>