<?php
	$servername = "localhost";
	$username = "wlmuser1";
	$password = "landpeac";
	$dbname = "wlmreservacion";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}


	$op = isset($_GET['op']) ? $_GET['op'] : die ("No operation specified");
	$id = isset($_GET['id']) ? $_GET['id'] : '';
	$name = isset($_GET['name']) ? $_GET['name'] : null;
	$level = isset($_GET['level']) ? $_GET['level'] : null;
	$pid = isset($_GET['pid']) ? $_GET['pid'] : null;
	$rid = isset($_GET['rid']) ? $_GET['rid'] : null;

	switch ($op) {
		case "createNode":
			createNode($rid, $pid, $name);
			break;
		case "updateNode":
			updateNode($id, $name);
			break;
		case "deleteNode":
			deleteNode($id);
			break;
		case "createRecommendation":
			createRecommendation($rid, $pid, $name);
			break;
		case "updateRecName":
			updateRecName($id, $name);
			break;
		case "createRecommendationLevel":
			createRecommendationLevel($id, $level, $name);
			break;
		default:
			die ("Invalid operation");
			break;
	}
	
	$conn->close();
	
	function getLast ($stmt) {
		$encode = array();
		$encode[] = array("id" => $stmt->insert_id);
		echo json_encode($encode);	
	}
	
	function updateRecName($id, $name) {
		$query = "UPDATE tbl_recomendaciones SET name=? WHERE id=?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("si", $name, $id);
			$stmt->execute();
			$stmt->close();
		}
	}
	
	function updateNode($id, $name) {
		$query = "UPDATE tbl_recomendaciones_elementos SET name=? WHERE id=?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("si", $name, $id);
			$stmt->execute();
			$stmt->close();
		}
	}
	
	function deleteNode($id) {
		$query = "DELETE FROM tbl_recomendaciones_elementos WHERE id=?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$stmt->close();
		}
	}
	
	function createRecommendationLevel($id, $level, $name) {
		$query = "INSERT INTO tbl_recomendaciones_nivel (id, nivel, name) VALUES (?,?,?) ON DUPLICATE KEY UPDATE tbl_recomendaciones_nivel.name = ?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("iiss", $rid, $pid,$name, $name);
			$stmt->execute();
			getLast($stmt);
			$stmt->close();
		}
	}
	
	function createNode($rid, $pid, $name) {
		$query = "INSERT INTO tbl_recomendaciones_elementos (id_recomendacion, id_parent, name) VALUES (?,?,?)";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("iis", $rid, $pid,$name);
			$stmt->execute();
			getLast($stmt);
			$stmt->close();
		}
	}
?>