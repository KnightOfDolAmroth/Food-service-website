<?php
	if(isset($_REQUEST["id_messaggio"])) {
		$servername="localhost";
		$username ="root";
		$password ="";
		$database = "food_service";

		$conn = new mysqli($servername, $username, $password, $database);
		if ($conn->connect_error) {
			die("Connection failed: " .$conn->connect_error);
		}
		$id_messaggio = $_REQUEST["id_messaggio"];
		
		$sql = "DELETE
				FROM messaggio
				WHERE id_messaggio = '$id_messaggio'";
		$conn->query($sql) or trigger_error($conn->error."[$sql]");
	}
?>