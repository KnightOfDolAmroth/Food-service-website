<?php
	$output = '';
	$output .= '
		<div class="form-group">
			<div class="col-sm-3 col-xs-3">
				<img class="img-responsive img-thumbnail" src="../'.$row["id_prodotto"].'" alt="immagine prodotto">
			</div>
			<div class="col-sm-6 col-xs-6">';
			
				/*INZIO QUERY*/
				$id_prod = $row["id_prodotto"];
				$sql = "SELECT *
					FROM prodotto
					WHERE id_prodotto = '$id_prod'";
				$prodotto = $conn->query($sql) or trigger_error($conn->error."[$sql]");
				$row1 = $prodotto->fetch_assoc();
				
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
					while ($row2 = $aggiunte->fetch_assoc()) {
						$costo_aggiunte += $row2["prezzo_aggiunta"];
					}
				}
					
				$id_imp = $row['id_impasto'];
				$sql = "SELECT *
					FROM impasto
					WHERE id_impasto = '$id_imp'";
				$impasto = $conn->query($sql) or trigger_error($conn->error."[$sql]");
				$row3 = $impasto->fetch_assoc();
					
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
					$row4 = $prodotto->fetch_assoc();
				
				$base = $row4['prezzo_base'];
				$impasto = $row3['prezzo'];
				
				$spesa = $quantità*($base + $impasto + $costo_aggiunte);
				
				/*FINE QUERY*/
				$output .= '
				<div class="col-xs-12 prod-name">'.$row1["nome_prodotto"].'</div>
				<div class="col-xs-12 qta-cont"><small>Quantità:<span class="qta">'.$row["qta"].'</span></small></div>
			</div>
			<div class="col-sm-3 col-xs-3 text-right">
				<h3><span class="euro">€</span>'.$spesa.'</h3>
			</div>
		</div>';
			
	echo $output;
?>