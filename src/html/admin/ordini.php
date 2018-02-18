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
				<div class="col-sm-2 col-md-1 user">
					<span id="username">'.$row["username"].'</span>
				</div>
				<div class="hidden-xs hidden-sm col-md-1 ord-info">
					<span class="ord-det"><p>'.$row["codice_ordine"].'</p></span>
				</div>
				<div class="hidden-sm col-md-2 ord-info">
					<span class="d-h">'.$row["data"].'</span>
				</div>
				<div class="col-sm-3 col-md-2 ord-info">
					<span class="address">
					<p>'.$row["indirizzo_recapito"].'</p>
					<p>'.$row["nome_campanello"].'</p></span>
				</div>
				<div class="col-sm-3 col-md-2 ord-info">
					<span class="consegna">
					<p>'.$row["consegna"].'</p></span>
				</div>
				<div class="col-sm-2 ord-info">
					<button class="btn btn-info bottone_dettagli" type="button" name="button" value="'.$row["codice_ordine"].'">Dettagli</button>
				</div>
				<div class="col-sm-2 ord-info">
					<div class="form-inline" id="dropdowns">
						<div class="form-group">
							<label hidden for="status">Stato:</label>
							<select class="selectpicker" id="status">
								<option ';
								if ($row["stato"] === "inattivo") {
									$output .= 'selected="selected" ';
									}
								$output .= 'value="inattivo">inattivo</option>
								<option ';
								if ($row["stato"] === "in spedizione") {
									$output .= 'selected="selected" ';
									}
								$output .= 'value="in spedizione">in spedizione</option>
								<option ';
								if ($row["stato"] === "pagato") {
									$output .= 'selected="selected" ';
									}
								$output .= 'value="pagato">pagato</option>
							</select>
							<p></p>
							<input type="hidden" id="stato" value="non settato"/>
							<button class="btn btn-info bottone_stato" type="button"
							name="button" value="'.$row["codice_ordine"].'">Cambia stato</button>
						</div>
					</div>
				</div>
			</div>';
	echo $output;
?>