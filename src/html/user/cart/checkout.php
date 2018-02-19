<?php
	$servername="localhost";
	$username ="root";
	$password ="";
	$database = "food_service";

	$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " .$conn->connect_error);
	}

	session_start();

	$user = $_SESSION["username"];
	$sql = " SELECT *
		FROM dettaglio_ordine
		WHERE codice_ordine IN(
			SELECT codice_ordine
			FROM ordine
			WHERE username = '$user'
			AND stato = 'in creazione'
		)";
	$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
	if ($result->num_rows < 1) {
		header('Location: carrello.php');
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="../../../css/checkout.css" rel="stylesheet" type="text/css"/>
  <link href="../../../css/pay.css" rel="stylesheet" type="text/css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<script>
	$(document).ready(function(){
		$('.sconto').change(function(){
			var sconto = $(this).val();
			$.ajax({
				url:"sconto.php",
				method:"post",
				data:{sconto:sconto},
				success:function(data){
					console.log(sconto);
				}
			});
			setTimeout(function () { location.reload(true); }, 100);
		});
	});
</script>

<body>

	<?php include '../navbar/carrello.html'; ?>

	<div class="container wrapper">
		<div class="row cart-head">
			<div class="container step-container">
				<div class="row steps">
					<a href="carrello.php"> <img class="img img-responsive arrow" src="../../../../img/Arrows/blue-cart-arrow.png" alt="carrello"></a>
					<img class="img img-responsive arrow" src="../../../../img/Arrows/blue-check-arrow.png" alt="checkout">
					<img class="img img-responsive arrow" src="../../../../img/Arrows/white-thank-arrow.png" alt="grazie">
				</div>
			</div>
		</div>
		<div class="row cart-body">
			<form class="form-horizontal" method="post" action="paga.php">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<!--riepilogo-->
				<div class="panel panel-info riep-panel">
					<div class="card-header panel-heading" id="p-head">
						<div class="mb-0">
							<div class="btn btn-link collapsed"  id="titolo" data-toggle="collapse" data-target="#p-col" aria-expanded="false" aria-controls="p-col">
								Riepilogo ordine <span><i class="glyphicon glyphicon-chevron-down" ></i></span>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div id="p-col" class="collapse" aria-labelledby="p-head">
							<div class="p-body">

								<?php
									//CARICO I DETTAGLI
									if ($result->num_rows > 0) {
										while($row = $result->fetch_assoc()) {
											include 'riepilogo.php';
										}

										$sql = "SELECT codice_ordine
											FROM ordine
											WHERE username = '$user'
											AND stato = 'in creazione'";
										$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
										$row = $result->fetch_assoc();
										$codice_ordine = $row["codice_ordine"];
									}

									//GESTIONE PUNTI
									$sql = "SELECT punti
										FROM utente
										WHERE username = '$user'";
									$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
									$row = $result->fetch_assoc();
									if (floor($_SESSION["totale"]/2) < $row["punti"]) {
										$punti_massimi = floor($_SESSION["totale"]/2);
									} else {
										$punti_massimi = $row["punti"];
									}

								?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12 total-row">
								<strong class="totale">Totale</strong>
								<div class="pull-right"><span class="euro">€</span><span><?php echo number_format((float)$_SESSION["totale"], 2, ',', ''); ?></span></div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12"><strong>Indirizzo di recapito:</strong></div>
							<div class="col-md-12"><input required type="text" class="form-control" name="indirizzo" value="" /></div>
						</div>
						<div class="form-group">
							<div class="col-md-12"><strong>Nome campanello:</strong></div>
							<div class="col-md-12"><input required type="text" class="form-control" name="campanello" value=""/></div>
						</div>
						<div class="form-group">
							<div class="col-md-12"><strong>Data e ora consegna:</strong></div>
							<div class="col-md-12"><input required type="datetime-local" class="form-control" name="consegna" value="anno-mese-giorno ora:minuti:secondi"/></div>
						</div>
						<div class="form-group">
							<div class="col-md-12"><strong>Punti bonus:</strong></div>
							<div class="col-md-12"><input required type="number" class="form-control sconto" name="sconto"
								min="0" max="<?php echo $punti_massimi; ?>"
								value="<?php if(isset($_SESSION["sconto"])){echo $_SESSION["sconto"];} else {echo '0';}?>"/>
							</div>
						</div>
					</div>
				</div>
				<!--fine riepilogo-->
			</div>


			<div class="col-lg-6 col-md-6 col-sm-12">
				<!--pagamento-->
				<div class="panel panel-info pay-panel">
					<div class="card-header panel-heading" id="p-head2">
						<div class="mb-0">
							<div class="btn btn-link"  id="titolo">
								Pagamento <span><i class="glyphicon glyphicon-lock" ></i></span>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="paymentWrap">
							<div class="btn-group paymentBtnGroup btn-group-justified" data-toggle="buttons">
								<label class="btn paymentMethod active">
								<div class="method visa"></div>
								<input type="radio" name="options" checked>
								</label>
								<label class="btn paymentMethod">
								<div class="method master-card"></div>
								<input type="radio" name="options">
								</label>
								<label class="btn paymentMethod">
								<div class="method vpay"></div>
								<input type="radio" name="options">
								</label>
								<label class="btn paymentMethod">
								<div class="method pp"></div>
								<input type="radio" name="options">
								</label>
								<label class="btn paymentMethod">
								<div class="method maestro"></div>
								<input type="radio" name="options">
								</label>
							</div>
						</div>
						<div id="p-col2" class="collapse" aria-labelledby="p-head2">
							<div class="p-body">
								<div class="form-group">
									<div class="col-md-12"><strong>Numero carta:</strong></div>
									<div class="col-md-12"><input type="text" class="form-control" name="car_number" value="" /></div>
								</div>
								<div class="form-group">
									<div class="col-md-12"><strong>CVV:</strong></div>
									<div class="col-md-12"><input type="text" class="form-control" name="car_code" value="" /></div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<strong>Data di scadenza</strong>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<select class="form-control" name="">
										<option value="">Mese</option>
										<option value="01">01</option>
										<option value="02">02</option>
										<option value="03">03</option>
										<option value="04">04</option>
										<option value="05">05</option>
										<option value="06">06</option>
										<option value="07">07</option>
										<option value="08">08</option>
										<option value="09">09</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										</select>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<select class="form-control" name="">
										<option value="">Anno</option>
										<option value="2018">2018</option>
										<option value="2019">2019</option>
										<option value="2020">2020</option>
										<option value="2021">2021</option>
										<option value="2022">2022</option>
										<option value="2023">2023</option>
										<option value="2024">2024</option>
										<option value="2025">2025</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<button class="btn btn-default pol-butt pay-butt collapsed" data-toggle="collapse" data-target="#p-col2" aria-expanded="false" aria-controls="p-col2"
						type="button" name="button" onclick="alert('Servizio al momento non disponibile');">Paga online</button>
						<button class="btn btn-default pay-butt" type="submit" name="codice_ordine" value="<?php echo $codice_ordine; ?>">Paga alla consegna</button>
					</div>
					<!--fine pagamento-->
				</div>
			</form>
			</div>
		</div>
	</div>
</body>
</html>
