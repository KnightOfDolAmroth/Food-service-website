<?php
	if(isset($_REQUEST["id_prodotto"])) {
		$servername="localhost";
		$username ="root";
		$password ="";
		$database = "food_service";

		$_SESSION["id_prodotto"] = $_REQUEST["id_prodotto"];

		$conn = new mysqli($servername, $username, $password, $database);
		if ($conn->connect_error) {
			die("Connection failed: " .$conn->connect_error);
		}
		$id_pr = $_REQUEST['id_prodotto'];

		$sql = "SELECT *
				FROM prodotto
				WHERE id_prodotto = '$id_pr'";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		$dati_prodotto = $result->fetch_assoc();

		$sql = "SELECT *
				FROM ingrediente
				WHERE id_ingrediente IN (SELECT id_ingrediente
					FROM ingredienti_pietanza
					WHERE id_prodotto = '$id_pr'
					ORDER BY id_ingrediente)";
		$dati_ingredienti = $conn->query($sql) or trigger_error($conn->error."[$sql]");

		$output = '';
		$output .= '
			<input type="hidden" id="id_prodotto" value="'.$_REQUEST["id_prodotto"].'"/>
			<div class="mod-card-container container">
				<div class="mod-card">
					<img class="mod-card-img img-rounded" src="'.$_REQUEST["id_prodotto"].'" alt="immagine prodotto">
					<div class="mod-card-body">
						<h2 contenteditable="true" class="mod-card-title">'.$dati_prodotto["nome_prodotto"].'</h2>';
						if ($dati_prodotto["tipo"]!=="Bibite") {
							$output .= '
							<p class="card-text">Ingredienti: ';
							$first = 0;
							while ($row = $dati_ingredienti->fetch_assoc()) {
								if($first != 0){
									$output .= ', '.$row["nome_ingrediente"];
								} else {
										$output .= $row["nome_ingrediente"];
										$first=1;
									}
							}
							$output .= '</p>';
						}
					$output .= '

					</div> <!--end product-->
				</div>
				<div id="img-loading-area">
					<label for="img-load">Carica immagine </label>
					<input id="img-load" type="file" accept="image/*">
				</div>
				<legend class="details">Dettagli</legend>
				<div class="supplements">
					<div class="row" id="dropdowns">
						<div class="form-group col-sm-6">';
							if ($dati_prodotto["tipo"]!=="Bibite") {
								$output .= '
									<label for="tipo">Tipologia:</label>
									<select class="selectpicker" name="tipologia" id="tipologia">';
									$sql1 = "SELECT tipo
										FROM tipologia";
										$result = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
										while ($row = $result->fetch_assoc()) {
											if($row["tipo"] == $dati_prodotto["tipo"]){
												$output .= '<option selected>'.$row["tipo"].'</option>';
											} else {
												$output .= '<option>'.$row["tipo"].'</option>';
											}

										}
								$output .= '
									</select>';
							}
							$output .= '
						</div>
						<div class="form-group col-sm-6">
							<label for="prz">Prezzo </label>
							<input id="prz" type="number" min="1" max="30" step=".01" value="'.$dati_prodotto["prezzo_base"].'">

						</div>
					</div>';

					if ($dati_prodotto["tipo"]!=="Bibite") {
						$id_prod = $dati_prodotto["id_prodotto"];
						$output .= '
							<button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapse-supp" aria-expanded="false" aria-controls="collapse-supp">
							Ingredienti
							</button>
							<div class="collapse" id="collapse-supp">
								<div class="well">
									<div class="supp-container"></div>
									<form class="supplements-list">
									<div class="row">';
										$sql2 = "SELECT nome_ingrediente
												FROM ingrediente
												WHERE id_ingrediente IN ( SELECT id_ingrediente
													FROM ingredienti_pietanza
													WHERE id_prodotto = '$id_prod'
												) ";
										$result = $conn->query($sql2) or trigger_error($conn->error."[$sql2]");
										while ($row = $result->fetch_assoc()) {
												$output .= '
													<div class="col-sm-4">
														<div class="form-check">
															<label class="supp-label">
															<input checked= "checked" type="checkbox" class="check" value='.$row["nome_ingrediente"].'>
															<span class="label-text">'.$row["nome_ingrediente"].'</span></label>
														</div>
													</div>';
											}


											$sql2bis = "SELECT nome_ingrediente
													FROM ingrediente
													WHERE id_ingrediente NOT IN ( SELECT id_ingrediente
														FROM ingredienti_pietanza
														WHERE id_prodotto = '$id_prod'
													) ";
											$result = $conn->query($sql2bis) or trigger_error($conn->error."[$sql2bis]");
											while ($row = $result->fetch_assoc()) {
													$output .= '
														<div class="col-sm-4">
															<div class="form-check">
																<label class="supp-label">
																<input  type="checkbox" class="check" value='.$row["nome_ingrediente"].'>
																<span class="label-text">'.$row["nome_ingrediente"].'</span></label>
															</div>
														</div>';
												} /**/
									$output .= '
									</div>
								</div>
							</div>';
						}
						$output .= '
				</div>
			</div>';
		echo $output;
	}
?>
