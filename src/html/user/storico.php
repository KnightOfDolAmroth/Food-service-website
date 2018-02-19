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

				<div id="date" class="col-sm-2 ord-info c1">
					<span class="d-h">'.$row["data"].'</span>
				</div>
				<div id="rec" class="col-sm-3 ord-info c2">
					<span class="address">
					<p>'.$row["indirizzo_recapito"].'</p>
					<p>'.$row["nome_campanello"].'</p></span>
				</div>
				<div id="cons" class="col-sm-2 ord-info c3">
					<span class="consegna">
					<p>'.$row["consegna"].'</p></span>
				</div>
				<div id="stat" class="col-sm-3 ord-info c4">
					<div class="form-inline" id="dropdowns">
						<div class="form-group">
							<p>'.$row["stato"].'</p>
						</div>
					</div>
				</div>
				<div id="det" class="col-sm-2 ord-info c5">
					<button class="btn btn-info btn_dettagli" type="button" name="button" value="'.$row["codice_ordine"].'">Dettagli</button>
				</div>
			</div>';
	echo $output;
?>
