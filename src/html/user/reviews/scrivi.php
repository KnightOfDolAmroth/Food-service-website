<?php 
	$servername="localhost";
	$username ="root";
	$password ="";
	$database = "food_service";

	$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " .$conn->connect_error);
	}
	
	if (isset($_REQUEST["username"]) && isset($_REQUEST["id_prodotto"]) && isset($_REQUEST["stelle"]) && isset($_REQUEST["recensione"])) {
		
		//CONTROLLO SE ESISTE GIÀ UNA RECENSIONE DELL'UTENTE SU QUESTO PRODOTTO
		$user = $_REQUEST["username"];
		$id_prodotto = $_REQUEST["id_prodotto"];
		$stelle = $_REQUEST["stelle"];
		$recensione = $_REQUEST["recensione"];
		
		$sql = "SELECT *
			FROM recensione
			WHERE id_prodotto = '$id_prodotto'
			AND username = '$user'";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		
		//SE ESISTE ESEGUO L'UPDATE
		if ($result->num_rows > 0) {
			$sql = "UPDATE recensione
				SET stelle = '$stelle', testo = '$recensione'
				WHERE id_prodotto = '$id_prodotto'
				AND username = '$user'";
			$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		} else {
			$sql = "INSERT INTO recensione (username, id_prodotto, stelle, testo)
				VALUES ('$user', '$id_prodotto', '$stelle', '$recensione')";
			$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		}
		
		//NOTIFICA RECENSIONE
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
		$oggetto = "Recensione prodotto";
		//---PRENDO L'USERNAME DELL'UTENTE
		$sql = "SELECT username
				FROM ordine
				WHERE codice_ordine = '$codice_ordine'";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		$row = $result->fetch_assoc();
		//---SETTO IL TESTO DEL MESSAGGIO
		$testo = "Grazie averci fornito la tua opinione.";
		
		$sql = "INSERT INTO messaggio (id_messaggio, username, oggetto, testo)
				VALUES ('$id_messaggio', '$user', '$oggetto', '$testo')";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		
		//INVIO EMAIL DI NOTIFICA
		$headers = "From: prova@unibo.it";
		$sql = "SELECT email
				FROM utente
				WHERE username = '$user'";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		$row = $result->fetch_assoc();
		$email = $row["email"];
		mail($email, $oggetto, $testo, $headers);
		exit;
	}
?>