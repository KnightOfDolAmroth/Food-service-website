<?php 
	$servername="localhost";
	$username ="root";
	$password ="";
	$database = "food_service";

	$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " .$conn->connect_error);
	}
	
	session_start();
	if (isset($_REQUEST["codice_ordine"]) && isset($_REQUEST["indirizzo"]) && isset($_REQUEST["campanello"])
		&& isset($_REQUEST["consegna"]) && isset($_REQUEST["sconto"])) {
			
		//CONTROLLO PER IMPEDIRE A QUELLI SVEGLI DI AVERE PUNTI INFINITI
		if ($_SESSION["codice_ordine"] === $_REQUEST["codice_ordine"]) {
			header('Location: grazie.php');
			exit;
		}
		
		//CAMBIO STATO
		$codice_ordine = $_REQUEST["codice_ordine"];
		$indirizzo = $_REQUEST["indirizzo"];
		$campanello = $_REQUEST["campanello"];
		$consegna = $_REQUEST["consegna"];
		$sql = "UPDATE ordine
				SET stato = 'inattivo', indirizzo_recapito = '$indirizzo', nome_campanello = '$campanello', consegna = '$consegna'
				WHERE codice_ordine = '$codice_ordine'";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		$_SESSION["codice_ordine"] = $_REQUEST["codice_ordine"];
		
		//CALCOLO PUNTI BONUS
		$punti_aggiunti = floor($_SESSION["totale"]/5);
		$punti_tolti = $_REQUEST["sconto"];
		$_SESSION["punti_aggiunti"] = $punti_aggiunti;
		$user = $_SESSION["username"];
		$sql = "UPDATE utente
				SET punti = punti + '$punti_aggiunti' -'$punti_tolti'
				WHERE username = '$user'";
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
		$oggetto = "Nuovo ordine";
		//---PRENDO L'USERNAME DELL'UTENTE
		$sql = "SELECT username
				FROM ordine
				WHERE codice_ordine = '$codice_ordine'";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		$row = $result->fetch_assoc();
		$user = $_SESSION["username"];
		//---SETTO IL TESTO DEL MESSAGGIO
		$testo = "Il tuo ordine (cod:".$codice_ordine.") è stato accolto";
		
		$sql = "INSERT INTO messaggio (id_messaggio, username, oggetto, testo)
				VALUES ('$id_messaggio', '$user', '$oggetto', '$testo')";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		
		//INVIO EMAIL DI NOTIFICA USER
		$headers = "From: prova@unibo.it";
		$sql = "SELECT email
				FROM utente
				WHERE username = '$user'";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		$row = $result->fetch_assoc();
		$email = $row["email"];
		mail($email, $oggetto, $testo, $headers);
		
		//INVIO EMAIL DI NOTIFICA ADMIN
		$headers = "From: prova@unibo.it";
		$sql = "SELECT email
				FROM utente
				WHERE username = 'admin'";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		$row = $result->fetch_assoc();
		$email = $row["email"];
		$testo = "In arrivo un nuvo ordine (cod:".$codice_ordine.") da parte di ".$user.".";
		mail($email, $oggetto, $testo, $headers);
		header('Location: grazie.php');
		exit;
	}
?>