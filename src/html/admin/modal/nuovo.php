<?php
	session_start();
	if(isset($_FILES["userfile"]) && isset($_REQUEST["nome_prodotto"]) && isset($_REQUEST["tipo"]) /*&& isset($_REQUEST["ing"])*/ && isset($_REQUEST["prz"])){
		$servername="localhost";
		$username ="root";
		$password ="";
		$database = "food_service";

		$conn = new mysqli($servername, $username, $password, $database);
		if ($conn->connect_error) {
			die("Connection failed: " .$conn->connect_error);
		}
		echo $_FILES["userfile"]["error"];
		$nome_prodotto = $_REQUEST["nome_prodotto"];
		$id = "../../../img/".$nome_prodotto.".jpg";
		$tipo = $_REQUEST["tipo"];
		$prz = $_REQUEST["prz"];
		
		//INSERIMENTO DEL PRODOTTO
		if (move_uploaded_file($_FILES["userfile"]["tmp_name"], "../".$id)) {
			echo "passo1";
			$sql = "INSERT INTO prodotto(id_prodotto,nome_prodotto,prezzo_base,tipo)
				VALUES ('$id', '$nome_prodotto', '$prz', '$tipo')";
			$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		}
		
		//INSERIMENTO DEGLI EVENTUALI INGREDIENTI
		header("Location: ../menu");
		exit;
	}
 ?>
