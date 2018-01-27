<?php 
	$servername="localhost";
	$username ="root";
	$password ="";
	$database = "food_service";

	$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " .$conn->connect_error);
	}
	$id_ordine = $row["codice_ordine"];
	$output = '';
	$output .= '
			<div class="row order">
				<div class="col-sm-1 user">
					<img class="media-object" src="http://lorempixel.com/460/250/" style="width: 72px; height: 72px;">
					<span id="username">'.$row["username"].'</span>
				</div>
				<div class="col-sm-2 ord-info">
					<span class="ord-det"><p>'.$row["codice_ordine"].'</p></span>
					<button class="btn btn-info det" type="button" name="button">Dettagli</button>
				</div>
				<div class="col-sm-2 ord-info">
					<span class="d-h">'.$row["data"].'</span>
				</div>
				<div class="col-sm-2 ord-info">
					<span class="address">
					<p>'.$row["indirizzo_recapito"].'</p>
					<p>'.$row["nome_campanello"].'</p></span>
				</div>
				<div class="col-sm-2 ord-info">
					<span class="'.$row["consegna"].'">
					<p>data consegna</p></span>
				</div>
				<div class="col-sm-1 ord-info">';
					$sql2 = "SELECT SUM(qta) AS sum_qta
						FROM dettaglio_ordine
						WHERE codice_ordine = '$id_ordine'";

					$result1 = $conn->query($sql2) or trigger_error($conn->error."[$sql2]");
					$qta = $result1->fetch_assoc();
					$output .= '<p>'.$qta["sum_qta"].'</p>
				</div>
				<div class="col-sm-2 ord-info">
					<div class="form-inline" id="dropdowns">
						<div class="form-group">
							<label hidden for="status">Stato:</label>
							<select class="selectpicker" id="status">
							<option selected="selected" value="inattivo">inattivo</option>
							<option value="preparazione">in spedizione</option>
							<option value="partito">pagato</option></select>
						</div>
					</div>
				</div>
			</div>';
	echo $output;
?>