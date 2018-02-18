<?php 
	$servername="localhost";
	$username ="root";
	$password ="";
	$database = "food_service";

	$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " .$conn->connect_error);
	}
	$cod_ordine = $_REQUEST["codice_ordine"];
	$sql = "SELECT id_prodotto
			FROM dettaglio_ordine
			WHERE codice_ordine = '$cod_ordine'";
	$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
	$row = $result->fetch_assoc();
	$id_pr = $row["id_prodotto"]; 
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
				<legend>Gestione ordini</legend>
				<div class="row col-titles">
					<div class="col-sm-2 field-title"></div>
					<div class="col-sm-2 field-title">quantità</div>
					<div class="col-sm-3 field-title">nome prodotto</div>
					<div class="col-sm-2 field-title">impasto</div>
					<div class="col-sm-3 field-title">aggiunte</div>
				</div>
				<div class="ord-body">.';
					$sql = "SELECT *
							FROM dettaglio_ordine
							WHERE codice_ordine = '$cod_ordine'";
					$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
					if ($result->num_rows>0) {
						while ($row = $result->fetch_assoc()) {
							$img = $row["id_prodotto"];
							$id_dettaglio = $row["id_dettaglio"];
							
							$sql1 = "SELECT nome_prodotto
									FROM prodotto
									WHERE id_prodotto = '$img'";
							$result1 = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
							$row1 = $result1->fetch_assoc();
																	
							$output .= '
								<div class="row order">
									<div class="col-sm-2 image">
										<a href="../user/recensioni.php?id_prodotto='.$row["id_prodotto"].'">
										<span class="text-center"><img class="media-object" src="'.$img.'"alt="immagine prodotto" style="width: 72px; height: 72px;"></span></a>
									</div>
									<div class="col-sm-2 quantità">
										<span class="quantità text-center"><p>'.$row["qta"].'</p></span>
									</div>
									<div class="col-sm-3 nome-prodotto">
										<a href="../user/recensioni.php?id_prodotto='.$row["id_prodotto"].'">
										<span class="nome-prodotto text-center"><p>'.$row1["nome_prodotto"].'</p></span></a>
									</div>
									<div class="col-sm-2 impasto">';
										
										$id_impasto = $row["id_impasto"];
										$sql3 = " SELECT nome_impasto
												FROM impasto
												WHERE id_impasto = '$id_impasto'";
										$result3 = $conn->query($sql3) or trigger_error($conn->error."[$sql3]");
										$row3 = $result3->fetch_assoc();
										$output .= '
										<span class="consegna text-center"><p>'.$row3["nome_impasto"].'</p></span>
									</div>
									<div class="col-sm-3 aggiunte">
									<span class="aggiunte text-center">';
									
										$sql2 = "SELECT nome_ingrediente
												FROM ingrediente
												WHERE id_ingrediente IN (SELECT id_ingrediente
																		FROM aggiunta_ordine
																		WHERE id_dettaglio = '$id_dettaglio')";

										$result2 = $conn->query($sql2) or trigger_error($conn->error."[$sql2]");
										if ($result2->num_rows>0) {
											while ($row2 = $result2->fetch_assoc()) {
												$output .= '
													<p>'.$row2["nome_ingrediente"].'</p>';
											}
										}
										
										$output .= '
										</span>
									</div>
								</div>';
						}
					}
					$output .= '
				</div>';
			echo $output;
?>