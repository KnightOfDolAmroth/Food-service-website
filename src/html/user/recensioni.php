<?php
	session_start();
	$servername="localhost";
	$username ="root";
	$password ="";
	$database = "food_service";

	$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " .$conn->connect_error);
	}
	
	if(isset($_REQUEST["id_prodotto"])){
		$id_prodotto = $_REQUEST["id_prodotto"];
	} else {
		header('Location: menu.php');
		exit;
	}
	
	$sql = "SELECT AVG(stelle) AS media
		FROM recensione
		WHERE id_prodotto = '$id_prodotto'";
	$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
	if ($result->num_rows>0) {
		$row = $result->fetch_assoc();
		$media = number_format((float)$row["media"], 2, ',', '');
		$medianum = $media;
		if ($media < 1) {
			$media = "non è stato espresso ancora alcun voto.";
			$medianum = 3;
		}
	}
	
	$sql = "SELECT *
		FROM prodotto
		WHERE id_prodotto = '$id_prodotto'";
	$result = $conn->query($sql) or trigger_error($conn->error."[$sql0]");
	$row = $result->fetch_assoc();		
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="../../css/admin_home.css" rel="stylesheet" type="text/css"/>
    <link href="../../css/checkout.css" rel="stylesheet" type="text/css"/>
    <link href="../../css/empty-cart.css" rel="stylesheet" type="text/css"/>
    <link href="../../css/cart.css" rel="stylesheet" type="text/css"/>
    <link href="../../css/product-details.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <?php include 'navbar/generica.php'; ?>

	<script>
		$(document).ready(function(){
			$('.messaggi').click(function(){
				var username = $(this).attr("id");
				$.ajax({
					url:"modal/messaggi.php",
					method:"post",
					data:{username:username},
					success:function(data){
						console.log(username);
						$('#dettagli_messaggi').html(data);
						$('#data_modal').modal("show");
					}
				});
			});
		});
	</script>
	
	<body>
		<div class="container wrapper">
			<div class="row prodotto">
				<div class="col-sm-6 col-lg-4 prod-img-holder">
					<img class="prod-img img img-rounded img-responsive img-thumbnail" src="<?php echo $row["id_prodotto"];?>" alt="immagine prodotto">
				</div>
				<div class="col-sm-6 col-lg-4 ingredienti">
					<h2><?php echo$row["nome_prodotto"];?></h2>
					<p>
					<?php
						$sql = "SELECT *
							FROM ingrediente
							WHERE id_ingrediente IN (SELECT id_ingrediente
								FROM ingredienti_pietanza
								WHERE id_prodotto = '$id_prodotto'
								ORDER BY id_ingrediente)";
						$dati_ingredienti = $conn->query($sql) or trigger_error($conn->error."[$sql]");
						$first = 0;
						if ($dati_ingredienti->num_rows > 0) {
							while ($row1 = $dati_ingredienti->fetch_assoc()) {
								if($first != 0){
									echo ', '.$row1["nome_ingrediente"];
								} else {
									echo $row1["nome_ingrediente"];
									$first=1;
								}
							}
						}
					?>
					</p>
				</div>
				<div class="col-lg-4 col-sm-6">
					<div class="aside">
						<label for="price-cont">Prezzo base:</label>
						<div id="price-cont">
							<span class="euro">€</span>
							<span class="price"><?php echo number_format((float)$row['prezzo_base'], 2, ',', '');?></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-25 col-md-25 col-xs-25">
				<div id="product-schedule">
					<div id="product-schedule-desktop" class="">
						<div class="schedule-content">
							<div class="schedule-section" id="user-reviews" style="display: block;">
								<div class="review-graph row">
									<div class="avg-rank col-md-6 col-sm-12">
										<p>Media recensioni: <?php echo $media; ?></p>
										<div class="rank">
											<?php
											for ($i = 0; $i < $medianum; $i++) {
												echo '<span class="glyphicon .glyphicon-star glyphicon-star"></span>';
											}
											for (; $i < 5; $i++) {
												echo '<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>';
											}
											?>
										</div>
									</div>
									<!-- EVENTUALI STATISTICHE PER SINGOLE STELLE -->
								</div>								
								<div class="reviews-header">
									<p class="title">Recensioni dei clienti</p>
								</div>
								<ul class="review-list">
								<?php

									$sql0 = " SELECT *
											FROM recensione
											WHERE id_prodotto = '$id_prodotto'
											ORDER BY data DESC";
									$result = $conn->query($sql0) or trigger_error($conn->error."[$sql0]");
									if ($result->num_rows>0) {
										while ($row = $result->fetch_assoc()) {
											include 'leggi.php';
										}
									}
								?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
