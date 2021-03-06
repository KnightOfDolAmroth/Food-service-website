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
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="../../../css/checkout.css" rel="stylesheet" type="text/css"/>
  <link href="../../../css/empty-cart.css" rel="stylesheet" type="text/css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

  <?php
		include '../navbar/carrello.html';
	?>

  <div class="container wrapper">

    <div class="row cart-head">
      <div class="container step-container">
        <div class="row steps">
          <img class="img img-responsive arrow" src="../../../../img/Arrows/blue-cart-arrow.png" alt="carrello">
          <img class="img img-responsive arrow" src="../../../../img/Arrows/blue-check-arrow.png" alt="checkout">
          <img class="img img-responsive arrow" src="../../../../img/Arrows/blue-thank-arrow.png" alt="grazie">
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
                  <h2>Grazie, il tuo ordine è stato accettato.<br>
					Hai ottenuto <?php echo $_SESSION["punti_aggiunti"] ?> punti bonus!</h2>
                  <div class="row cart-img-holder">
                    <img class="img-responsive" src="../../../../img/trunk.png" alt="trunk">
                  </div>
                  <a href="../menu.php"><button class="btn btn-lg btn-primary" id="torna">Torna al menu</button></a>
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
