<?php
	session_start();
	echo "passo 0";
	if(isset($_SESSION["username"]) && isset($_SESSION["id_prodotto"]) /*&& isset($_REQUEST["imp"]) && isset($_REQUEST["qta"])*/) {
		$servername="localhost";
		$username ="root";
		$password ="";
		$database = "food_service";

		$conn = new mysqli($servername, $username, $password, $database);
		if ($conn->connect_error) {
			die("Connection failed: " .$conn->connect_error);
		}
			echo "passo 1";
			/*CONTROLLO SE L'UTENTE HA UN ORDINE IN CREAZIONE*/
			$usr = $_SESSION['username'];
			$sql0 = "SELECT stato, codice_ordine
					FROM ordine
					WHERE username = '$usr'
					AND stato = 'creazione'";
			/*SE NON CE L'HA CREO UN NUOVO ORDINE*/
			$result = $conn->query($sql0) or trigger_error($conn->error."[$sql0]");
			if($result->num_rows === 0) {
				echo "passo 2";
				/*SELEZIONO IL CODICE ORDINE PIÚ RECENTE*/
				$sql3 = "SELECT codice_ordine
						FROM ordine
						ORDER BY codice_ordine DESC";
				/*SE ESISTE LO INCREMENTO DI 1, ALTRIMENTI SETTO A 1*/
				$result = $conn->query($sql3) or trigger_error($conn->error."[$sql3]");
				if($result->num_rows > 0) {
					echo "passo 3";
					$row3 = $result->fetch_assoc();
					$id_ordine = ++$row3["codice_ordine"];
				} else {
					echo "passo 4";
					$id_ordine = 1;
				}
				
				/*INSERIMENTO NUOVO ORDINE*/
				$data = "Da specificare";
				$indirizzo = "Da specificare";
				$campanello = "Da specificare";
				$stato = "creazione";
				$usr = $_SESSION["username"];
				$sql4 = "INSERT INTO ordine(codice_ordine, data, indirizzo_recapito, nome_campanello, stato, username)
						VALUES ('$id_ordine', '$data', '$indirizzo', '$campanello', '$stato', '$usr')";
				$result = $conn->query($sql4) or trigger_error($conn->error."[$sql4]");
			} else {
				$row0 = $result->fetch_assoc();
				$id_ordine = $row0["codice_ordine"];
			}
			echo "passo 5";
			/*PRENDO L'ID DELL'ULTIMO DETTAGLIO*/
				$sql1 = "SELECT id_dettaglio
						FROM dettaglio_ordine
						ORDER BY id_dettaglio DESC";
				/*SE ESISTE INCREMENTO, ALTRIMENTI SETTO A 1*/
				$result = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
				var_dump($result->num_rows);
				if($result->num_rows > 0) {
					echo "passo 6";
					$row1 = $result->fetch_assoc();
					$id_dettaglio = $row1["id_dettaglio"];
					++$id_dettaglio;
				} else {
					echo "passo 7";
					$id_dettaglio = 1;
				}
				
				/*INSERISCO IL DETTAGLIO ORDINE*/
				echo "passo 8";
				$qta = "1"/*$_REQUEST["qta"]*/;
				$id_prod = $_SESSION["id_prodotto"];
				$id_imp = "1"/*$_REQUEST["imp"]*/;
				$sql2 = "INSERT INTO dettaglio_ordine(id_dettaglio,qta,codice_ordine,id_prodotto,id_impasto)
						VALUES ('$id_dettaglio','$qta','$id_ordine','$id_prod','$id_imp')";
				$result = $conn->query($sql2) or trigger_error($conn->error."[$sql2]");
				
				/*BISOGNA FARE LE AGGIUNTE*/
				
				/*RITORNO A CASA*/
				//header('Location: ./menu.php');
	}
?>