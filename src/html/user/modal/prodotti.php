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
			<div class="card-container">
				<div class="card">
				  <img class="card-img img-rounded" src="'.$_REQUEST["id_prodotto"].'" alt="immagine prodotto">
				  <div class="card-body">
				  <h2 class="card-title">'.$dati_prodotto["nome_prodotto"].'</h2>';
				  if ($dati_prodotto["tipo"]!=="Bibite") {
						$output .= '
						<p class="card-text">Ingredienti: ';
						while ($row = $dati_ingredienti->fetch_assoc()) {
							$output .= $row["nome_ingrediente"].' ';
                        }
						$output .= '</p>';
					}
				$output .= '  
					</div> <!--end product-->
					</div>
					<legend class="details">Dettagli aggiuntivi</legend>
					<div class="supplements">
					<div class="form-inline" id="dropdowns">
					<div class="form-group">';
					if ($dati_prodotto["tipo"]!=="Bibite") {
						$output .= '
								<label for="imp">Impasto:</label>
								<select class="selectpicker" name="impasto" id="impasto">';
								$sql1 = "SELECT nome_impasto
									FROM impasto
									WHERE nome_impasto <> 'nessuno'";
									$result = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
									while ($row = $result->fetch_assoc()) {
									  $output .= '<option>'.$row["nome_impasto"].'</option>';
									}
						$output .= '
							</select>
							</div>';
					}
              
                    $output .= '    
					<div class="form-group">
                    <label for="qta">Quantità </label>
                    <input id="qta" type="number" min="1" max="10" value="1">
                    </select>
                  </div>
                </div>';
				
				if ($dati_prodotto["tipo"]!=="Bibite") {
					$output .= '
						<button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapse-supp" aria-expanded="false" aria-controls="collapse-supp">
						Aggiunte (0,50€)
						</button>
						<div class="collapse" id="collapse-supp">
						  <div class="well">
							<div class="supp-container"></div>
							<form class="supplements-list">
							  <div class="row">';
								$sql2 = "SELECT nome_ingrediente
										FROM ingrediente";
								$result = $conn->query($sql2) or trigger_error($conn->error."[$sql2]");
								while ($row = $result->fetch_assoc()) {
										$output .= '
											<div class="col-sm-4 col-md-3">
											<div class="form-check">
											<label class="supp-label">
											<input type="checkbox" class="check" value='.$row["nome_ingrediente"].'>
											<span class="label-text">'.$row["nome_ingrediente"].'</span></label></div></div>';
								  }
						$output .= '
							</div>
						  </div>
						</div>';
				}
				$output .= '
							</div>
						</div>
					</div>
				</div>
			</div>
         </div>';
		 echo $output;
	}?>