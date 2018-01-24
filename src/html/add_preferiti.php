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
	if(isset($_SESSION["id_prodotto"])){
		/*ASSOCIAZIONE PRODOTTO - INGREDIENTE*/
		$usr = $_SESSION["username"];
		$id_pr = $_SESSION["id_prodotto"];
		$sql1 = "INSERT INTO preferisce(id_prodotto, username)
				VALUES ('$id_pr','$usr')";
		$result = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
		unset($_SESSION['id_prodotto']);
		$usr = $_SESSION["username"];
		$id_pr = $_SESSION["id_prodotto"];
		echo $usr;
		echo $id_pr;
		
		//header('Location: ./menu.php');
	} else {
		echo "NON VA";
		$usr = $_SESSION["username"];
		$id_pr = $_SESSION["id_prodotto"];
		echo $usr;
		echo $id_pr;
	}
?>