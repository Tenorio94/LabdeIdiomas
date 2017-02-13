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
	$description = isset($_GET['description']) ? $_GET['description'] : null;
	$parent = isset($_GET['parent']) ? $_GET['parent'] : null;
	$cid = isset($_GET['cid']) ? $_GET['cid'] : null;
	$oid = isset($_GET['oid']) ? $_GET['oid'] : null;
	$url = isset($_GET['url']) ? $_GET['url'] : null;
	$pass = isset($_GET['pass']) ? $_GET['pass'] : null;

	switch ($op) {
		case "login":
			login($id, $pass);
			break;
		case "getCourses":	
			getCourses();
			break;
		case "getCourseDescription":	
			getCourseDescription($id);
			break;
		case "getCoursesFromStudent":
			getCoursesFromStudent($id);
			break;
		case "getInteraction":
			getInteraction($id);
			break;
		case "getDomain":
			getDomain($id);
			break;
		case "getEvaluation":
			getEvaluation($id);
			break;
		case "getResource":
			getResource($id);
			break;
		case "getCompetence":
			getCompetence($id);
			break;
		case "getCompetenceFromId":
			getCompetenceFromId($id);
			break;
		case "getInteractionsFromCompetence":
			getInteractionsFromCompetence($id);
			break;
		case "getDomainsFromCompetence":
			getDomainsFromCompetence($id);
			break;
		case "getEvaluationsFromCompetence":
			getEvaluationsFromCompetence($id);
			break;
		case "getResourcesFromCompetence":
			getResourcesFromCompetence($id);
			break;
		case "getCompetenceFromInteraction":
			getCompetenceFromInteraction($id);
			break;
		case "getCompetenceFromDomain":
			getCompetenceFromDomain($id);
			break;
		case "getCompetenceFromEvaluation":
			getCompetenceFromEvaluation($id);
			break;
		case "getCompetenceFromResource":
			getCompetenceFromResource($id);
			break;
		case "createCourse":
			createCourse($name, $description);
			break;
		case "createCompetence":
			createCompetence($name, $parent, $cid);
			break;
		case "createDomain":
			createDomain($name, $description, $cid);
			break;
		case "createEvaluation":
			createEvaluation($name, $description, $url, $cid);
			break;
		case "createResource":
			createResource($name, $description, $url, $cid);
			break;
		case "createInteraction":
			createInteraction($name, $description, $cid);
			break;
		case "createInteractionsFromCompetence":
			createInteractionsFromCompetence($cid, $oid);
			break;
		case "createDomainsFromCompetence":
			createDomainsFromCompetence($cid, $oid);
			break;
		case "createEvaluationsFromCompetence":
			createEvaluationsFromCompetence($cid, $oid);
			break;
		case "createResourcesFromCompetence":
			createResourcesFromCompetence($cid, $oid);
			break;
		case "updateCourse":
			updateCourse($name, $description, $id);
			break;
		case "updateCompetence":
			updateCompetence($name, $parent, $cid, $id);
			break;
		case "updateDomain":
			updateDomain($name, $description, $cid, $id);
			break;
		case "updateEvaluation":
			updateEvaluation($name, $description, $url, $cid, $id);
			break;
		case "updateResource":
			updateResource($name, $description, $url, $cid, $id);
			break;
		case "updateInteraction":
			updateInteraction($name, $description, $cid, $id);
			break;
		case "deleteCourse":	
			deleteCourse($id);
			break;
		case "deleteCompetence":
			deleteCompetence($id);
			break;
		case "deleteInteraction":
			deleteInteraction($id);
			break;
		case "deleteDomain":
			deleteDomain($id);
			break;
		case "deleteEvaluation":
			deleteEvaluation($id);
			break;
		case "deleteResource":
			deleteResource($id);
			break;
		case "deleteInteractionsFromCompetence":
			deleteInteractionsFromCompetence($cid, $oid);
			break;
		case "deleteDomainsFromCompetence":
			deleteDomainsFromCompetence($cid, $oid);
			break;
		case "deleteEvaluationsFromCompetence":
			deleteEvaluationsFromCompetence($cid, $oid);
			break;
		case "deleteResourcesFromCompetence":
			deleteResourcesFromCompetence($cid, $oid);
			break;
		default:
			die ("Invalid operation");
			break;
	}


	$conn->close();

	function getJSON ($stmt) {
		echo json_encode(fetch($stmt));	
	}

	function getLast ($stmt) {
		$encode = array();
		$encode[] = array("id" => $stmt->insert_id);
		echo json_encode($encode);	
	}
	
	function fetch ($result) {    
		
		$array = array();

		if ($result instanceof mysqli_stmt){
			
			$result->store_result();
			$variables = array();
			$data = array();
			$meta = $result->result_metadata();

			while ($field = $meta->fetch_field()) {
				$variables[] = &$data[$field->name];
			}

			call_user_func_array(array($result, 'bind_result'), $variables);

			$i = 0;
			while ($result->fetch()) {
				$array[$i] = array();
				foreach($data as $k=>$v) {
					$array[$i][$k] = $v;
				}
				$i++;
			}
		} elseif ($result instanceof mysqli_result) {
			while($row = $result->fetch_assoc()) {
				$array[] = $row;
			}
		}

		return $array;
	}
	
	function login ($id, $pass) {
		
		$query = "SELECT pass=? FROM ML_Professor WHERE id=?";

		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("ss", $pass, $id);
			$stmt->execute();
			getJSON($stmt);
			$stmt->close();
		}
	}
	
	function getCourses() {

		$query = "SELECT * FROM ML_Course";

		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->execute();
			getJSON($stmt);
			$stmt->close();
		}
	}

	function getCourseDescription ($id) {

		$query = "SELECT * FROM ML_Course WHERE id=?";

		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			getJSON($stmt);
			$stmt->close();
		}
	}

	function getCoursesFromStudent($id) {

		$query = "SELECT ML_Course.id, ML_Course.name, ML_Course.description FROM ML_Course INNER JOIN ML_CourseToStudent ON ML_Course.id = ML_CourseToStudent.cid WHERE ML_CourseToStudent.sid=?";

		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("s", $id);
			$stmt->execute();
			getJSON($stmt);
			$stmt->close();
		}
	}

	function getInteraction($id) {

		$query = "SELECT * FROM ML_Interaction WHERE cid=?";

		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			getJSON($stmt);
			$stmt->close();
		}
	}

	function getDomain($id) {

		$query = "SELECT * FROM ML_Domain WHERE cid=?";

		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			getJSON($stmt);
			$stmt->close();
		}
	}

	function getEvaluation($id) {

		$query = "SELECT * FROM ML_Evaluation WHERE cid=?";

		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			getJSON($stmt);
			$stmt->close();
		}
	}
	
	function getResource($id) {

		$query = "SELECT * FROM ML_Resource WHERE cid=?";

		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			getJSON($stmt);
			$stmt->close();
		}
	}

	function getCompetence($id) {

		$query = "SELECT * FROM ML_Competence WHERE cid=?";

		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			getJSON($stmt);
			$stmt->close();
		}
	}
	
	function getCompetenceFromId($id) {

		$query = "SELECT * FROM ML_Competence WHERE id=?";

		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			getJSON($stmt);
			$stmt->close();
		}
	}

	function getInteractionsFromCompetence ($id) {

		$query = "SELECT ML_Interaction.id, ML_Interaction.name, ML_Interaction.description FROM ML_Interaction INNER JOIN ML_CompetenceToInteraction ON ML_Interaction.id = ML_CompetenceToInteraction.iid WHERE ML_CompetenceToInteraction.cid=?";

		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			getJSON($stmt);
			$stmt->close();
		}
	}
		
	function getDomainsFromCompetence ($id) {

		$query = "SELECT ML_Domain.id, ML_Domain.name, ML_Domain.description FROM ML_Domain INNER JOIN ML_CompetenceToDomain ON ML_Domain.id = ML_CompetenceToDomain.did WHERE ML_CompetenceToDomain.cid=?";

		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			getJSON($stmt);
			$stmt->close();
		}
	}

	function getEvaluationsFromCompetence ($id) {

		$query = "SELECT ML_Evaluation.id, ML_Evaluation.name, ML_Evaluation.description, ML_Evaluation.url  FROM ML_Evaluation INNER JOIN ML_CompetenceToEvaluation ON ML_Evaluation.id = ML_CompetenceToEvaluation.eid WHERE ML_CompetenceToEvaluation.cid=?";

		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			getJSON($stmt);
			$stmt->close();
		}
	}

	function getResourcesFromCompetence ($id) {

		$query = "SELECT ML_Resource.id, ML_Resource.name, ML_Resource.description, ML_Resource.url FROM ML_Resource INNER JOIN ML_CompetenceToResource ON ML_Resource.id = ML_CompetenceToResource.rid WHERE ML_CompetenceToResource.cid=?";

		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			getJSON($stmt);
			$stmt->close();
		}
	}

	// Inverse
	function getCompetenceFromInteraction ($id) {

		$query = "SELECT ML_Competence.id, ML_CompetenceToInteraction.iid FROM ML_Competence INNER JOIN ML_CompetenceToInteraction ON ML_Competence.id = ML_CompetenceToInteraction.cid WHERE ML_CompetenceToInteraction.iid =?";

		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			getJSON($stmt);
			$stmt->close();
		}
	}
		
	function getCompetenceFromDomain ($id) {
		
		$query = "SELECT ML_Competence.id, ML_CompetencetoDomain.did FROM ML_Competence INNER JOIN ML_CompetencetoDomain ON ML_Competence.id = ML_CompetencetoDomain.cid WHERE ML_CompetencetoDomain.did =?";

		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			getJSON($stmt);
			$stmt->close();
		}
	}

	function getCompetenceFromEvaluation ($id) {
		
		$query = "SELECT ML_Competence.id, ML_CompetencetoEvaluation.eid FROM ML_Competence INNER JOIN ML_CompetencetoEvaluation ON ML_Competence.id = ML_CompetencetoEvaluation.cid WHERE ML_CompetencetoEvaluation.eid =?";

		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			getJSON($stmt);
			$stmt->close();
		}
	}

	function getCompetenceFromResource ($id) {
		
		$query = "SELECT ML_Competence.id, ML_CompetencetoResource.rid FROM ML_Competence INNER JOIN ML_CompetencetoResource ON ML_Competence.id = ML_CompetencetoResource.cid WHERE ML_CompetencetoResource.rid =?";

		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			getJSON($stmt);
			$stmt->close();
		}
	}

	// Insert
	function createCourse ($name, $description) {

		$query = "INSERT INTO ML_Course (name, description) VALUES (?, ?)";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("ss", $name, $description);
			$stmt->execute();
			getLast($stmt);
			$stmt->close();
		}
	}
	
	function createCompetence ($name, $parent, $cid) {

		$query = "INSERT INTO ML_Competence (name, parent, cid) VALUES (?, ?, ?)";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("sii", $name, $parent, $cid);
			$stmt->execute();
			getLast($stmt);
			$stmt->close();
		}
	}

	function createDomain ($name, $description, $cid) {

		$query = "INSERT INTO ML_Domain (name, description, cid) VALUES (?, ?, ?)";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("ssi", $name, $description, $cid);
			$stmt->execute();
			getLast($stmt);
			$stmt->close();
		}
	}

	function createEvaluation ($name, $description, $url, $cid) {

		$query = "INSERT INTO ML_Evaluation (name, description, url, cid) VALUES (?, ?, ?, ?)";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("sssi", $name, $description, $url, $cid);
			$stmt->execute();
			getLast($stmt);
			$stmt->close();
		}
	}
	
	function createResource ($name, $description, $url, $cid) {

		$query = "INSERT INTO ML_Resource (name, description, url, cid) VALUES (?, ?, ?, ?)";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("sssi", $name, $description, $url, $cid);
			$stmt->execute();
			getLast($stmt);
			$stmt->close();
		}
	}

	function createInteraction($name, $description, $cid) {

		$query = "INSERT INTO ML_Interaction (name, description, cid) VALUES (?, ?, ?)";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("ssi", $name, $description, $cid);
			$stmt->execute();
			getLast($stmt);
			$stmt->close();
		}
	}

	// Create N:N
	function createInteractionsFromCompetence ($cid, $oid) {

		$query = "INSERT INTO Ml_CompetenceToInteraction (cid, iid) VALUES (?, ?)";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("ii", $cid, $oid);
			$stmt->execute();
			getLast($stmt);
			$stmt->close();
		}
	}
		
	function createDomainsFromCompetence ($cid, $oid) {

		$query = "INSERT INTO Ml_CompetenceToDomain (cid, did) VALUES (?, ?)";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("ii", $cid, $oid);
			$stmt->execute();
			getLast($stmt);
			$stmt->close();
		}
	}

	function createEvaluationsFromCompetence ($cid, $oid) {

		$query = "INSERT INTO Ml_CompetenceToEvaluation (cid, eid) VALUES (?, ?)";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("ii", $cid, $oid);
			$stmt->execute();
			getLast($stmt);
			$stmt->close();
		}
	}

	function createResourcesFromCompetence ($cid, $oid) {

		$query = "INSERT INTO Ml_CompetenceToResource (cid, rid) VALUES (?, ?)";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("ii", $cid, $oid);
			$stmt->execute();
			getLast($stmt);
			$stmt->close();
		}
	}

	// Update
	function updateCourse ($name, $description, $id) {

		$query = "UPDATE ML_Course SET name=?, description=? WHERE id=?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("ssi", $name, $description, $id);
			$stmt->execute();
			$stmt->close();
		}
	}
	
	function updateCompetence ($name, $parent, $cid, $id) {

		$query = "UPDATE ML_Competence SET name=?, parent=?, cid=? WHERE id=?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("ssii", $name, $parent, $cid, $id);
			$stmt->execute();
			$stmt->close();
		}
	}

	function updateDomain ($name, $description, $cid, $id) {

		$query = "UPDATE ML_Domain SET name=?, description=?, cid=? WHERE id=?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("ssii", $name, $description, $cid, $id);
			$stmt->execute();
			$stmt->close();
		}
	}

	function updateEvaluation ($name, $description, $url, $cid, $id) {

		$query = "UPDATE ML_Evaluation SET name=?, description=?, url=?, cid=? WHERE id=?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("sssii", $name, $description, $url, $cid, $id);
			$stmt->execute();
			$stmt->close();
		}
	}
	
	function updateResource ($name, $description, $url, $cid, $id) {

		$query = "UPDATE ML_Resource SET name=?, description=?, url=?, cid=? WHERE id=?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("sssii", $name, $description, $url, $cid, $id);
			$stmt->execute();
			$stmt->close();
		}
	}

	function updateInteraction ($name, $description, $cid, $id) {

		$query = "UPDATE ML_Interaction SET name=?, description=?, cid=? WHERE id=?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("ssii", $name, $description, $cid, $id);
			$stmt->execute();
			$stmt->close();
		}
	}

	// Delete
	function deleteCourse ($id) {

		$query = "DELETE FROM ML_Course WHERE id=?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$stmt->close();
		}
	}

	function deleteCompetence ($id) {

		$query = "DELETE FROM ML_Competence WHERE id=?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$stmt->close();
		}
	}

	function deleteInteraction ($id) {

		$query = "DELETE FROM ML_Interaction WHERE id=?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$stmt->close();
		}
	}

	function deleteDomain ($id) {

		$query = "DELETE FROM ML_Domain WHERE id=?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$stmt->close();
		}
	}

	function deleteEvaluation ($id) {

		$query = "DELETE FROM ML_Evaluation WHERE id=?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$stmt->close();
		}
	}

	function deleteResource ($id) {

		$query = "DELETE FROM ML_Resource WHERE id=?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$stmt->close();
		}
	}

	// Delete N:N
	function deleteInteractionsFromCompetence ($cid, $oid) {

		$query = "DELETE FROM Ml_CompetenceToInteraction WHERE cid=? AND iid=?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("ii", $cid, $oid);
			$stmt->execute();
			$stmt->close();
		}
	}
		
	function deleteDomainsFromCompetence ($cid, $oid) {

		$query = "DELETE FROM Ml_CompetenceToDomain WHERE cid=? AND did=?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("ii", $cid, $oid);
			$stmt->execute();
			$stmt->close();
		}
	}

	function deleteEvaluationsFromCompetence ($cid, $oid) {

		$query = "DELETE FROM Ml_CompetenceToEvaluation WHERE cid=? AND eid=?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("ii", $cid, $oid);
			$stmt->execute();
			$stmt->close();
		}
	}

	function deleteResourcesFromCompetence ($cid, $oid) {

		$query = "DELETE FROM Ml_CompetenceToResource WHERE cid=? AND rid=?";
		if ($stmt = $GLOBALS['conn']->prepare($query)) {
			$stmt->bind_param("ii", $cid, $oid);
			$stmt->execute();
			$stmt->close();
		}
	}
?>