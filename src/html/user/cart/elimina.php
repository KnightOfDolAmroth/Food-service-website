<?php 
	$servername="localhost";
	$username ="root";
	$password ="";
	$database = "food_service";

	$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " .$conn->connect_error);
	}
	
	if(isset($_REQUEST["id_dettaglio"])) {
		$id = $_REQUEST["id_dettaglio"];
		
		/*ELIMINAZIONE DETTAGLIO*/
		$sql = "DELETE FROM dettaglio_ordine
			WHERE id_dettaglio = '$id'";
		$conn->query($sql) or trigger_error($conn->error."[$sql]");
		
		/*ELIMINAZIONE RIFERIMENTO ALLE AGGIUNTE*/
		$sql = "DELETE FROM aggiunta_ordine
			WHERE id_dettaglio = '$id'";
		$conn->query($sql) or trigger_error($conn->error."[$sql]");		
	}
?>