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
	header('Location: ./empty.html');
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
  <link href="../../../css/empty-cart.css" rel="stylesheet" type="text/css"/>
    <link href="../../../css/cart.css" rel="stylesheet" type="text/css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<script>
	$(document).ready(function(){
		$('.glyphicon-trash').click(function(){
			var id_dettaglio = $(this).attr("value");
			$.ajax({
				url:"elimina.php",
				method:"post",
				data:{id_dettaglio:id_dettaglio},
				success:function(data){
					console.log(id_dettaglio);
				}
			});
			setTimeout(function () { location.reload(true); }, 100);
		});
	});
</script>

<body>
  <!--navbar in cima-->
  <nav class="navbar fixed-top navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../../homepage/home.html">La Malaghiotta</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="../home.php"><span class="glyphicon glyphicon-home"></span> Homepage</a></li>
          <li><a href="#"><span class="glyphicon glyphicon-envelope"></span> Messaggi</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
      </div>
    </div>
  </nav> <!--fine navbar in cima-->


	<div class="container wrapper">
		<div class="row cart-head">
			<div class="container step-container">
				<div class="row steps">
					<img class="img img-responsive arrow" src="../../../../img/Arrows/blue-cart-arrow.png" alt="carrello">
					<a href="checkout.php"> <img class="img img-responsive arrow" src="../../../../img/Arrows/white-check-arrow.png" alt="checkout"></a>
					<img class="img img-responsive arrow" src="../../../../img/Arrows/white-thank-arrow.png" alt="grazie">
				</div>
			</div>
		</div>
		<div class="row cart-body">
			<div class="col-sm-12">
				<!--riepilogo-->
				<div class="panel panel-info riep-panel">
					<div class="card-header panel-heading" id="p-head">
						<div class="mb-0">
							<div class="btn btn-link collapsed"  id="titolo" data-toggle="collapse" data-target="#p-col" aria-expanded="false" aria-controls="p-col">
								Carrello <span><i class="glyphicon glyphicon-shopping-cart" ></i></span>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="" id="cart-body">
							<div class="cart">
								<div class="row titles">
									<div class="col-sm-2"></div>
									<div class="col-sm-2">Ingredienti</div>
									<div class="col-sm-2">Aggiunte</div>
									<div class="col-sm-1">Quantità</div>
									<div class="col-sm-2">Impasto</div>
									<div class="col-sm-2">Importo</div>
									<div class="col-sm-1"></div>
								</div>

								<?php
									$totale = 0;
									if ($result->num_rows > 0) {
										while($row = $result->fetch_assoc()) {
											include 'dettagli.php';
										}
									}
									$_SESSION["totale"] = $totale;
								?>
								<div class="row" id="cart-tot">
									<div class="cart-footer col-sm-push-4">
										<div class="part1">
											<div id="tot-label">Totale</div>
											<div id="tot">€ <?php echo $totale; ?></div>
										</div>

										<div class="part2">
											<button class="btn btn-primary btn-lg"type="button" name="button" onclick="window.location.href = 'checkout.php'">Procedi all'acquisto</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--fine riepilogo-->
			</div>
		</div>
	</div>
</body>
</html>
