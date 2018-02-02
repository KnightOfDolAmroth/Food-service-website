<?php
	if(isset($_REQUEST["username"])) {
		$servername="localhost";
		$username ="root";
		$password ="";
		$database = "food_service";

		$conn = new mysqli($servername, $username, $password, $database);
		if ($conn->connect_error) {
			die("Connection failed: " .$conn->connect_error);
		}
		$usr = $_REQUEST["username"];
		
		$sql = "SELECT *
				FROM messaggio
				WHERE username = '$usr'";	
		$output = '';
		$output .= '
			<legend>Messaggi utente</legend>';
				$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
				if ($result->num_rows>0) {
					$output .= '
						<div class="row col-titles">
							<div class="col-sm-2 field-title">Oggetto</div>
							<div class="col-sm-8 field-title">Testo del messaggio</div>
							<div class="col-sm-2 field-title"></div>
						</div>
						<div class="ord-body">';
					while ($row = $result->fetch_assoc()) {															
						$output .= '
							<div class="row order">
								<div class="col-sm-2 oggetto">
									<span class="text-center"><p>'.$row["oggetto"].'</p></span>
								</div>
								<div class="col-sm-8 testo">
									<span class="ord-id text-center"><p>'.$row["testo"].'</p></span>
								</div>
								<div class="col-sm-2 elimina">
									<button class="btn btn-info bottone_elimina" type="button" name="button" value="'.$row["id_messaggio"].'">Elimina</button>
								</div>';
					}
				} else {
					$output .= '
							<div class="row order">
								<div class="col-sm-12 oggetto">
									<span class="text-center"><p>La cartella è vuota</p></span>
								</div>
							</div>';
				}
				$output .= '
			</div>';
		echo $output;
	}
?>