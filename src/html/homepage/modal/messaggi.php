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
			$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
			if ($result->num_rows>0) {
				$output .= '
					<div class="row col-titles">
						<div class="col-sm-3 field-title">Oggetto</div>
						<div class="col-sm-9 field-title">Testo del messaggio</div>
					</div>
					<div class="ord-body">';
				while ($row = $result->fetch_assoc()) {															
					$output .= '
						<div class="row order">
							<div class="col-sm-3 oggetto">
								<span class="text-center"><p>'.$row["oggetto"].'</p></span>
							</div>
							<div class="col-sm-9 testo">
								<span class="ord-id text-center"><p>'.$row["testo"].'</p></span>
							</div>
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