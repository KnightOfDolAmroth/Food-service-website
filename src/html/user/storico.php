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
				<div class="col-sm-2 ord-info">
					<button class="btn btn-info bottone_dettagli" type="button" name="button" value="'.$row["codice_ordine"].'">Dettagli</button>
				</div>
				<div class="col-sm-2 ord-info">
					<span class="d-h">'.$row["data"].'</span>
				</div>
				<div class="col-sm-3 ord-info">
					<span class="address">
					<p>'.$row["indirizzo_recapito"].'</p>
					<p>'.$row["nome_campanello"].'</p></span>
				</div>
				<div class="col-sm-2 ord-info">
					<span class="consegna">
					<p>'.$row["consegna"].'</p></span>
				</div>
				<div class="col-sm-3 ord-info">
					<div class="form-inline" id="dropdowns">
						<div class="form-group">
							<p>'.$row["stato"].'</p>
						</div>
					</div>
				</div>
			</div>';
	echo $output;
?>