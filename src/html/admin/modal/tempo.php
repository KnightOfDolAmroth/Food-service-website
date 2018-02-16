<?php 
	$servername="localhost";
	$username ="root";
	$password ="";
	$database = "food_service";

	$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " .$conn->connect_error);
	}
	
	if (isset($_REQUEST["giorno"]) && isset($_REQUEST["apertura_mattina"]) && isset($_REQUEST["chiusura_mattina"])
		&& isset($_REQUEST["apertura_pomeriggio"]) && isset($_REQUEST["chiusura_pomeriggio"])) {
		
		$giorno = $_REQUEST["giorno"];
		$apertura_mattina = $_REQUEST["apertura_mattina"];
		$chiusura_mattina = $_REQUEST["chiusura_mattina"];
		$apertura_pomeriggio = $_REQUEST["apertura_pomeriggio"];
		$chiusura_pomeriggio = $_REQUEST["chiusura_pomeriggio"];
		$sql = "UPDATE orari
			SET apertura_mattina = '$apertura_mattina', chiusura_mattina = '$chiusura_mattina', apertura_pomeriggio = '$apertura_pomeriggio', chiusura_pomeriggio = '$chiusura_pomeriggio'
			WHERE giorno = '$giorno'";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		
		
		//NOTIFICA CAMBIO ORARI
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
		$oggetto = "Orari chiosco";
		//---SETTO IL TESTO DEL MESSAGGIO
		$testo = "Di recente gli orari della Malaghiotta sono stati aggiornati.";
		$user = 'admin';
		$sql = "INSERT INTO messaggio (id_messaggio, username, oggetto, testo)
				VALUES ('$id_messaggio', '$user', '$oggetto', '$testo')";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		exit;
	}
?>