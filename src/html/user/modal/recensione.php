<?php

	if(isset($_REQUEST["id_prodotto"])) {
		session_start();
		
		$servername="localhost";
		$username ="root";
		$password ="";
		$database = "food_service";

		$conn = new mysqli($servername, $username, $password, $database);
		if ($conn->connect_error) {
			die("Connection failed: " .$conn->connect_error);
		}
		
		$user = $_SESSION["username"];
		$id_prodotto = $_REQUEST["id_prodotto"];
		$sql = "SELECT *
			FROM prodotto
			WHERE id_prodotto = '$id_prodotto'";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		$dati_prodotto = $result->fetch_assoc();
		
		$sql = "SELECT *
				FROM ingrediente
				WHERE id_ingrediente IN (SELECT id_ingrediente
					FROM ingredienti_pietanza
					WHERE id_prodotto = '$id_prodotto'
					ORDER BY id_ingrediente)";
		$dati_ingredienti = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		
		$output = '';
		$output .= '
			<link href="../../css/revModal.css" rel="stylesheet" type="text/css"/>
			<link href="../../css/stars.css" rel="stylesheet" type="text/css"/>
			<script src="../../js/stars.js" type="text/javascript"></script>
		
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 img-cont">
					<img class="img-responsive img-thumbnail" src="'.$id_prodotto.'" alt="">
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 details">
					<div class="product-ing">
						<p class="product-name">'.$dati_prodotto["nome_prodotto"].'</p>
						<small style="font-size: 16px;">';
						
						while ($row = $dati_ingredienti->fetch_assoc()) {
							$output .= $row["nome_ingrediente"].' ';
						}
						
						$output .= '
						</small><br>
					</div>
					<div>
						<p class="price">'.$dati_prodotto["prezzo_base"].'</p>
					</div>
					<div style="clear: both"></div>
				</div>

			</div>
			<div class="row" style="margin-bottom: 15px; margin-top: 15px;">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 valut-container">
					<div class="title-rating-star">Valutazione*</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 valut-container">
					<div class="">
						<div class="row lead">
							<div id="stars-existing" class="starrr" data-rating="3"></div>
						</div>
					</div>
				</div>
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<ul class="votes">
						<li class="vote-text vote-1" data-valuestar="1">Pessimo</li>
						<li class="vote-text vote-2" data-valuestar="2">Scarso</li>
						<li class="vote-text vote-3" data-valuestar="3">Nella media</li>
						<li class="vote-text vote-4" data-valuestar="4">Molto buono</li>
						<li class="vote-text vote-5" data-valuestar="5">Eccellente</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					Scrivi qui la tua recensione*
					<div class="form-group">
						<textarea placeholder="Hai a disposizione 250 caratteri" maxlength="250" class="form-control" id="Content" name="Content"></textarea>
					</div>
				</div>
				<div>
					<p>* I campi contrassegnati con l`asterisco sono obbligatori</p>
				</div>
				<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12"><div id="review-message"></div></div>
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<input class="btn bottone-invio" id="'.$user.'" value="Iniva" name="'.$id_prodotto.'" type="button">
				</div>
			</div>
			
			<script>
				
				$(document).ready(function(){
						$(".bottone-invio").click(function(){
						var username = $(this).attr("id");
						var id_prodotto = $(this).attr("name");
						var stelle = $(".glyphicon-star").length;
						var recensione = $("#Content").val();					
						$.ajax({
							url:"reviews/scrivi.php",
							method:"post",
							data:{username:username, id_prodotto:id_prodotto, stelle:stelle, recensione:recensione},
							success:function(data){
								console.log(username);
								console.log(id_prodotto);
								console.log(stelle);
								console.log(recensione);
								$("#modal-recensione").modal("hide");
							}
						});
						$("#modal-recensione").modal("hide");
					});
				});
			</script>';
		echo $output;
	}
?>
