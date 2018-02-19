<?php
	session_start();
	if(isset($_REQUEST["id_prodotto"])){
		$servername="localhost";
		$username ="root";
		$password ="";
		$database = "food_service";

		$conn = new mysqli($servername, $username, $password, $database);
		if ($conn->connect_error) {
			die("Connection failed: " .$conn->connect_error);
		}
		
		$id_prodotto = $_REQUEST["id_prodotto"];
		
		$sql = "SELECT *
			FROM prodotto
			WHERE visibile = '1'
			AND id_prodotto = '$id_prodotto'";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		if ($result->num_rows>0) {
			//NASCONDO IL PRODOTTO
			$sql = "UPDATE prodotto
				SET visibile = '0'
				WHERE id_prodotto = '$id_prodotto'";
			$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		} else {
			//MOSTRO IL PRODOTTO
			$sql = "UPDATE prodotto
				SET visibile = '1'
				WHERE id_prodotto = '$id_prodotto'";
			$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		}
		exit;
	}
 ?>
