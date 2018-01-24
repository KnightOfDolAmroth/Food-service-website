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
?>

<?php
	/*CONTROLLO SE L'UTENTE HA UN ORDINE IN CREAZIONE*/
	$sql0 = "SELECT stato, codice_ordine
			FROM ordine
			WHERE username = $_SESSION['username']
			AND stato = creazione";
	$result = $conn->query($sql0) or trigger_error($conn->error."[$sql0]");
	/*SE NON CE L'HA CREO UN NUOVO ORDINE*/
	if(!($row0 = $result->fetch_assoc())) {
		{
		/*SELEZIONO IL CODICE ORDINE PIÚ RECENTE*/
		$sql3 = "SELECT TOP 1 codice_ordine
				FROM ordine
				ORDER BY codice_ordine DESC";
		$result = $conn->query($sql3) or trigger_error($conn->error."[$sql3]");
		
		/*SE ESISTE LO INCREMENTO DI 1, ALTRIMENTI SETTO A 1*/
		if($row3 = $result->fetch_assoc()) {
			$id_ordine = $row3["codice_ordine"] + 1;
		} else {
			$id_ordine = 1;
		}
		
		/*INSERIMENTO NUOVO ORDINE*/
		$data = time();
		$indirizzo = "Da specificare";
		$campanello = "Da specificare";
		$stato = "creazione";
		$usr = $_SESSION["username"];
		$sql4 = "INSERT INTO ordine(codice_ordine, data, indirizzo_recapito, nome_campanello, stato, username)
				VALUES ('$id_ordine', '$data', '$indirizzo', '$campanello', '$stato', '$usr')";
		$result = $conn->query($sql4) or trigger_error($conn->error."[$sql4]");
	}
	
	/*PRENDO L'ID DELL'ULTIMO DETTAGLIO*/
		$sql1 = "SELECT TOP 1 id_dettaglio
				FROM dettaglio_ordine
				ORDER BY id_dettaglio DESC";
		$result = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
		
		/*SE ESISTE INCREMENTO, ALTRIMENTI SETTO A 1*/
		if($row1 = $result->fetch_assoc()) {
			$id_dettaglio = $row1["id_dettaglio"] + 1;
		} else {
			$id_dettaglio = 1;
		}
		
		/*INSERISCO IL DETTAGLIO ORDINE*/
		$qta = $_REQUEST["qta"];
		$cod_ord = $row0["codice_ordine"];
		$id_prod = $_REQUEST["id_prodotto"];
		$id_imp = $_REQUEST["id_impasto"];
		$sql2 = "INSERT INTO dettaglio_ordine(id_dettaglio,qta,codice_ordine,id_prodotto,id_impasto)
				VALUES ('id_dettaglio','$qta','$cod_ord','$id_prod','$id_imp')";
		$result = $conn->query($sql2) or trigger_error($conn->error."[$sql2]");
		
		/*BISOGNA FARE LE AGGIUNTE*/
?>