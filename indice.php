<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
</head>
<body>

<?php
// Create connection
$con=mysqli_connect("localhost","wlmuser1","landpeac","wlmreservacion");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$recurso = $_GET['id'];

$result = $con->query("SELECT * FROM content WHERE resourceId= '".$recurso ."'");
while($capitulo = $result->fetch_assoc()) {
  echo $capitulo['content'] ."<br>";
 }
?>
</body>
</html>