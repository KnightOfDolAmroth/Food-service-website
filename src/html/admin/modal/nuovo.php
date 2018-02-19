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
		$visibile = '1';
		
		
		if (move_uploaded_file($_FILES["userfile"]["tmp_name"], "../".$id)) {
			//INSERIMENTO DEL PRODOTTO
			$sql = "INSERT INTO prodotto(id_prodotto,nome_prodotto,prezzo_base,tipo, visibile)
				VALUES ('$id', '$nome_prodotto', '$prz', '$tipo', '$visibile')";
			$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
			
			var_dump($_REQUEST["ing"]);
			
			//INSERIMENTO DEGLI EVENTUALI INGREDIENTI
			if (isset($_REQUEST["ing"])) {
				foreach ($_REQUEST["ing"] as $value) {
					var_dump($value);
					$sql = "SELECT *
						FROM ingrediente
						WHERE nome_ingrediente = '$value'";
					$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
					$row=$result->fetch_assoc();
					$id_ingrediente = $row["id_ingrediente"];
					$sql = "INSERT INTO ingredienti_pietanza(id_ingrediente, id_prodotto)
						VALUES ('$id_ingrediente', '$id')";
					$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
				}
			}
		}
		header("Location: ../menu.php");
		exit;
	}
 ?>
