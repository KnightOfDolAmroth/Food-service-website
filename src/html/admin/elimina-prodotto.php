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
		$usr = $_SESSION["username"];
		$id_pr = $_REQUEST["id_prodotto"];
		$sql2 = "DELETE FROM prodotto
					WHERE id_prodotto = '$id_pr'";
		$result = $conn->query($sql2) or trigger_error($conn->error."[$sql2]");
		//header('Location: ./menu.php');

	}
?>
