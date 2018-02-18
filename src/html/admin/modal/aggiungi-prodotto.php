<?php

		$servername="localhost";
		$username ="root";
		$password ="";
		$database = "food_service";

		$conn = new mysqli($servername, $username, $password, $database);
		if ($conn->connect_error) {
			die("Connection failed: " .$conn->connect_error);
		}


		$output = '';
		$output .= '
			<input type="hidden" id="id_prodotto" value=""/>
			<div class="mod-card-container container">
				<div class="mod-card">
					<img class="mod-card-img img-rounded" src="../../../img/placeholder.jpg" alt="immagine prodotto">
					<div class="mod-card-body">
						<input class="mod-card-title" id="name" type="text"/>';

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

								$output .= '
									<label for="tipo">Tipologia:</label>
									<select class="selectpicker" name="tipologia" id="tipologia">';
									$sql1 = "SELECT tipo
										FROM tipologia";
										$result = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
										while ($row = $result->fetch_assoc()) {

												$output .= '<option>'.$row["tipo"].'</option>';
											}


								$output .= '
									</select>';

							$output .= '
						</div>
						<div class="form-group col-sm-6">
							<label for="prz">Prezzo </label>
							<input id="prz" type="number" min="1" max="30" step=".01" value="0">

						</div>
					</div>';

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
												";
										$result = $conn->query($sql2) or trigger_error($conn->error."[$sql2]");
										while ($row = $result->fetch_assoc()) {
												$output .= '
													<div class="col-sm-4">
														<div class="form-check">
															<label class="supp-label">
															<input type="checkbox" class="check" value='.$row["nome_ingrediente"].'>
															<span class="label-text">'.$row["nome_ingrediente"].'</span></label>
														</div>
													</div>';
											}



									$output .= '
									</div>
								</div>
							</div>';

						$output .= '
				</div>
			</div>';
		echo $output;

?>
