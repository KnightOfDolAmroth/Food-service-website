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
	/*PRENDO L'ID DELL'ULTIMO INGREDIENTE*/
	$sql0 = "SELECT TOP 1 id_ingrediente
			FROM ingrediente
			ORDER BY id_ingrediente DESC";
	$result = $conn->query($sql0) or trigger_error($conn->error."[$sql0]");
	
	/*SE ESISTE INCREMENTO DI 1, ALTRIMENTI SETTO A 1*/
	if(!($row0 = $result->fetch_assoc())) {
		$id_ingre = $row0["id_ingrediente"] + 1;
	} else {
		$id_ingre = 1;
	}
	
	/*INSERISCO L'INGREDIENTE*/
	$nome_ingre = $_REQUEST["nome_ingre"];
	$note_ingre = $_REQUEST["note_ingre"];
	$prezzo_aggiunta = $_REQUEST["prezzo_aggiunta"];
	$vegeta = $_REQUEST["vegeta"];
	$vegan = $_REQUEST["vegan"];
	$halal = $_REQUEST["halal"];
	$gluten = $_REQUEST["gluten"];
	$sql1 = "INSERT INTO ingrediente(id_ingrediente, nome_ingrediente, note_ingrediente, prezzo_aggiunta, vegetariano, vegano, halal, gluten_free)
			VALUES ('$id_ingre','$nome_ingre', '$note_ingre', '$prezzo_aggiunta','$vegeta','$vegan', '$halal','$gluten')";
	$result = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
?>

<?php
	/*PRENDO L'ID DELL'ULTIMO IMPASTO*/
	$sql0 = "SELECT TOP 1 id_impasto
			FROM impasto
			ORDER BY id_impasto DESC";
	$result = $conn->query($sql0) or trigger_error($conn->error."[$sql0]");
	
	/*SE ESISTE INCREMENTO DI 1, ALTRIMENTI SETTO A 1*/
	if(!($row0 = $result->fetch_assoc())) {
		$id_imp = $row0["id_impasto"] + 1;
	} else {
		$id_imp = 1;
	}
	
	/*INSERISCO L'IMPASTO*/
	$nome_imp = $_REQUEST["nome_ingre"];
	$prezzo = $_REQUEST["prezzo"];
	$sql1 = "INSERT INTO impasto(id_impasto, nome_imp, prezzo)
			VALUES ('$id_imp','$nome_imp', '$prezzo')";
	$result = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
?>

<?php	
	/*INSERISCO IL PRODOTTO*/
	$id_pr = $_REQUEST["id_pr"];
	$nome_pr = $_REQUEST["nome_pr"];
	$prezzo_base = $_REQUEST["prezzo_base"];
	$tipo = $_REQUEST["tipo"];
	$sql1 = "INSERT INTO prodotto(id_prodotto, nome_prodotto, prezzo_base, tipo)
			VALUES ('$id_pr','$nome_pr', '$prezzo_base', '$tipo')";
	$result = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
?>

<?php
	/*ASSOCIAZIONE PRODOTTO - INGREDIENTE*/
	$id_ingr = $_REQUEST["id_ingr"];
	$id_pr = $_REQUEST["id_pr"];
	$sql1 = "INSERT INTO ingredienti_pietanza(id_ingrediente, id_prodotto)
			VALUES ('$id_ingr','$id_pr')";
	$result = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
?>