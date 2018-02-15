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
	
	if (isset($_REQUEST["sconto"])) {
		$_SESSION["totale"] = $_SESSION["totale_iniziale"] - $_REQUEST["sconto"];
		$_SESSION["sconto"] = $_REQUEST["sconto"];
	}
?>