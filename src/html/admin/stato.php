<?php 
	$servername="localhost";
	$username ="root";
	$password ="";
	$database = "food_service";

	$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " .$conn->connect_error);
	}
	echo "passo 0";
	if (isset($_REQUEST["stato"]) && isset($_REQUEST["procedi"])) {
		echo "passo 1";
		$stato = $_REQUEST["stato"];
		$codice_ordine = $_REQUEST["procedi"];
		$sql = "UPDATE ordine
				SET stato = '$stato'
				WHERE codice_ordine = '$codice_ordine'";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
	}	
?>