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
	if(isset($_REQUEST["id_prodotto"])){
		/*SE È GIÀ TRA I PREFERITI LO ELIMINO DA ESSI*/
		$usr = $_SESSION["username"];
		$id_pr = $_REQUEST["id_prodotto"];
		$sql0 = "SELECT *
				FROM preferisce
				WHERE id_prodotto = '$id_pr'
				AND username = '$usr'";
		$result = $conn->query($sql0) or trigger_error($conn->error."[$sql0]");
		if ($result->num_rows>0) {
			$sql2 = "DELETE FROM preferisce
					WHERE id_prodotto = '$id_pr'
					AND username = '$usr'";
		$result = $conn->query($sql2) or trigger_error($conn->error."[$sql2]");
		header('Location: ./menu.php');
		} else {		
			/*ASSOCIAZIONE PRODOTTO - INGREDIENTE*/
			$usr = $_SESSION["username"];
			$id_pr = $_REQUEST["id_prodotto"];
			$sql1 = "INSERT INTO preferisce(id_prodotto, username)
					VALUES ('$id_pr','$usr')";
			$result = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
			unset($_REQUEST['id_prodotto']);
			header('Location: ./menu.php');
		}
	}
?>