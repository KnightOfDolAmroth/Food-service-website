<?php
	$servername="localhost";
	$username ="root";
	$password ="";
	$database = "food_service";

	$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " .$conn->connect_error);
	}

	/*prendo l'immagine utente*/
	$uname=$row["username"];
	$query0 = " SELECT immagine
			FROM utente
			WHERE username = '$uname'";
	$risultato = $conn->query($query0) or trigger_error($conn->error."[$query0]");
	if ($risultato->num_rows>0) {
		$riga=$risultato->fetch_assoc();
	}
	$id_ordine = $row["codice_ordine"];
	$output = '';
	$output .= '
			<div class="row order">
				<div class="col-sm-2 col-md-2 user ord-info" id="utente">
					<span><img id="usr-img" class="img img-responsive img-circle" src="'.$riga["immagine"].'" alt="user img"></span>
					<span id="username">'.$row["username"].'</span>
				</div>
				<div class="col-sm-2 col-md-2 ord-info" id="codice">
				<button class="btn btn-info bottone_dettagli" type="button" name="button" value="'.$row["codice_ordine"].'">'.$row["codice_ordine"].'</button>

				</div>
				<div class=" col-sm-2 col-md-2 ord-info" id="data">
					<label for="info-data">data ordine:</label>
					<span id="info-data" class="d-h">'.$row["data"].'</span>
				</div>
				<div class="col-sm-2 col-md-2 ord-info" id="recapito">
					<label for="info-recapito">recapito:</label>
					<span class="address" id="info-recapito">
					<span>'.$row["indirizzo_recapito"].'</span>
					<p>'.$row["nome_campanello"].'</p></span>
				</div>
				<div class="col-sm-2 col-md-2 ord-info" id="consegna">
					<label for="info-consegna">consegna:</label>
					<span id="info-consegna" class="consegna">
					<p>'.$row["consegna"].'</p></span>
				</div>

				<div class="col-sm-2 col-md-2 ord-info" id="stato">
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
