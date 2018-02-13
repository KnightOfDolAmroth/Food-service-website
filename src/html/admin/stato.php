<?php 
	$servername="localhost";
	$username ="root";
	$password ="";
	$database = "food_service";

	$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " .$conn->connect_error);
	}
	
	if (isset($_REQUEST["stato"]) && isset($_REQUEST["procedi"])) {
		
		//CAMBIO STATO
		$stato = $_REQUEST["stato"];
		$codice_ordine = $_REQUEST["procedi"];
		$sql = "UPDATE ordine
				SET stato = '$stato'
				WHERE codice_ordine = '$codice_ordine'";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		
		//NOTIFICA DI CAMBIO STATO
		//---CALCOLO L'ID MESSAGGIO
		$sql = "SELECT id_messaggio
				FROM messaggio
				ORDER BY id_messaggio DESC";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		if ($result->num_rows>0) {
			$row = $result->fetch_assoc();
			$id_messaggio = $row["id_messaggio"];
			++$id_messaggio;
		} else {
			$id_messaggio = "1";
		}
		//---SETTO L'OGGETTO
		$oggetto = "Avanzamento ordine";
		//---PRENDO L'USERNAME DELL'UTENTE
		$sql = "SELECT username
				FROM ordine
				WHERE codice_ordine = '$codice_ordine'";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		$row = $result->fetch_assoc();
		$user = $row["username"];
		//---SETTO IL TESTO DEL MESSAGGIO
		$testo = "Il tuo ordine (cod:".$codice_ordine.") è ".$stato.".";
		
		$sql = "INSERT INTO messaggio (id_messaggio, username, oggetto, testo)
				VALUES ('$id_messaggio', '$user', '$oggetto', '$testo')";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
	}
?>