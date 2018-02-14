<?php
	$output = '';
	$output .= '
		<div class="row cart-item">
			<div class="col-sm-2 item-detail">
				<img class="card-img img-rounded" src="../'.$row["id_prodotto"].'" alt="immagine prodotto">';
				
				$id_prod = $row["id_prodotto"];
				$sql = "SELECT *
				FROM prodotto
				WHERE id_prodotto = '$id_prod'";
				$prodotto = $conn->query($sql) or trigger_error($conn->error."[$sql]");
				$row1 = $prodotto->fetch_assoc();
				
				$output .= '
				<p class="card-title">'.$row1["nome_prodotto"].'</p>
			</div>
			<div class="col-sm-3 item-detail">
				<div class="card-body">
					<p class="card-text">';
					
					$sql = "SELECT *
						FROM ingrediente
						WHERE id_ingrediente IN (
							SELECT id_ingrediente
							FROM ingredienti_pietanza
							WHERE id_prodotto = '$id_prod'
							ORDER BY id_ingrediente
						)";
					$ingredienti = $conn->query($sql) or trigger_error($conn->error."[$sql]");
					while ($row2 = $ingredienti->fetch_assoc()) {
						$output .= $row2["nome_ingrediente"].'<br>';
                    }
					
					$output .= '
					</p>
				</div>
			</div>
			<div class="col-sm-2 item-detail">
				<p>';
				
				$id_dettaglio = $row['id_dettaglio'];
				$sql = "SELECT *
					FROM ingrediente
					WHERE id_ingrediente IN (
						SELECT id_ingrediente
						FROM aggiunta_ordine
						WHERE id_dettaglio = '$id_dettaglio'
					)";

				$costo_aggiunte = 0;
					
				$aggiunte = $conn->query($sql) or trigger_error($conn->error."[$sql]");
				if ($aggiunte->num_rows>0) {
					while ($row3 = $aggiunte->fetch_assoc()) {
						$costo_aggiunte += $row3["prezzo_aggiunta"];
						$output .= 
						$row3["nome_ingrediente"].'<br>';
					}
				}
				
				$output .= '
				</p>
			</div>
			<div class="col-sm-1 item-detail">
				<div class="form-group">
					<p>'.$row["qta"].'</p>
				</div>
			</div>
			<div class="col-sm-2 item-detail">
				<div class="form-group">
					<p>';
					
					$id_imp = $row['id_impasto'];
					$sql = "SELECT *
						FROM impasto
						WHERE id_impasto = '$id_imp'";
					$impasto = $conn->query($sql) or trigger_error($conn->error."[$sql]");
					if ($impasto->num_rows>0) {
						$row4 = $impasto->fetch_assoc();
						$output .=
						$row4["nome_impasto"];
					}
					
					$output .= '
					</p>
				</div>
			</div>
			<div class="col-sm-1 item-detail">
				<p>€ ';
				
				/*
				* SPESA DEL SINGOLO DETTAGLIO ORDINE = q(b+I+A) = q(b+I+Σ(aj)) j:1->m
				* q = QUANTITÀ
				* b = PREZZO BASE
				* I = PREZZO IMPASTO
				* A = PREZZO AGGIUNTE
				*/
				$quantità = $row['qta'];
				
				$sql = "SELECT *
						FROM prodotto
						WHERE id_prodotto = '$id_prod'";
					$prodotto = $conn->query($sql) or trigger_error($conn->error."[$sql]");
					$row5 = $prodotto->fetch_assoc();
				
				$base = $row5['prezzo_base'];
				$impasto = $row4['prezzo'];
				
				$spesa = $quantità*($base + $impasto + $costo_aggiunte);
				$totale += $spesa;
				
				$output .= 
				$spesa
				.'</p>
			</div>
			<div class="col-sm-1 item-detail">
				<button type="button" class="btn btn-link btn-lg">
				<span class="glyphicon glyphicon-trash" aria-hidden="true" value="'.$id_dettaglio.'"></span>
				</button>
			</div>
		</div>';
	echo $output;
?>