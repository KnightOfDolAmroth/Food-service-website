<?php
	$output = '';

	$output .= '
	<div class="col-sm-6 col-md-4 col-lg-3">
		<div class="card-container">
			<div class="card">
				<img class="card-img img-rounded" alt="immagine prodotto" src="'.$row["id_prodotto"].'">
				<div class="card-body">
					<h2 class="card-title">'.$row["nome_prodotto"].'</h2>
					<p class="card-text"></p>
				</div>
				<div class="checkout-details">
					<div class="price">€ '.number_format((float)$row['prezzo_base'], 2, ',', '').'
					</div>
					<div class="btn-container">
						<button type="button" name="id_prodotto" id="'.$row['id_prodotto'].'" ';
						$username = $_SESSION["username"];
						$id_prodotto = $row['id_prodotto'];
						$sql = "SELECT id_prodotto
								FROM preferisce
								WHERE username = '$username'
								AND id_prodotto = '$id_prodotto'";
						$result1 = $conn->query($sql) or trigger_error($conn->error."[$sql]");
						if ($result1->num_rows > 0) {
							$output .= 'style="background-color: orange"';
						}
						$output .= '
						class="btn btn-default btn-circle glyphicon glyphicon-edit"></button>
						<button type="button" name="id_prodotto" id="'.$row['id_prodotto'].'"
						class="btn btn-default btn-circle glyphicon glyphicon-trash"></button>
					</div>
				</div>
			</div>
		</div>
	</div>';
	echo $output;
?>
