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
$_SESSION['username']=$_SESSION['username'];
//include 'add_preferiti.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="../css/menu.css" rel="stylesheet" type="text/css"/>
	<!--<link href="../css/modal.css" rel="stylesheet" type="text/css"/>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  </head>


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
          <a class="navbar-brand" href="./homepage.html">La Malaghiotta</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Dati utente</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-envelope"></span> Messaggi</a></li>
          </ul>
          <form class="navbar-form navbar-left" action="/action_page.php">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search">
              <div class="input-group-btn">
                <button class="btn btn-default" type="submit">
                  <i class="glyphicon glyphicon-search"></i>
                </button>
              </div>
            </div>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="./logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          </ul>
        </div>
      </div>
    </nav> <!--fine navbar in cima-->

<div class="bkg">
  <img class="img-responsive" src="../../img/piadona.jpeg" alt="background piada">
</div>
  <!--tabs-->

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist" id="tablist">

      <li role="presentation" class="active">
        <a  href="#tutto" aria-controls="tutto" role="tab" data-toggle="tab">
            <img class="img-responsive img-circle tab-img" src="../../img/logo.jpg" alt="tutti i prodotti">
        </a>

      </li>

      <li role="presentation">
        <a href="#piadine" aria-controls="piadine" role="tab" data-toggle="tab">
          <img class="img-responsive img-circle tab-img" src="../../img/piadine.jpg" alt="piadine">
        </a>
      </li>

      <li role="presentation">
        <a href="#crescioni" aria-controls="crescioni" role="tab" data-toggle="tab">
          <img class="img-responsive img-circle tab-img" src="../../img/crescione.jpg" alt="crescioni">
        </a>
      </li>

      <li role="presentation">
        <a href="#rotoli" aria-controls="rotoli" role="tab" data-toggle="tab">
          <img class="img-responsive img-circle tab-img" src="../../img/rotoli.jpg" alt="rotoli">
        </a>
      </li>

      <li role="presentation">
        <a href="#altro" aria-controls="altro" role="tab" data-toggle="tab">
          <img class="img-responsive img-circle tab-img" src="../../img/altro.jpg" alt="altro">
        </a>
      </li>


      <li role="presentation">
        <a href="#bibite" aria-controls="bibite" role="tab" data-toggle="tab">
          <img class="img-responsive img-circle tab-img" src="../../img/bibite.jpg" alt="bibite">
        </a>
      </li>

			<li role="presentation">
				<a href="#preferiti" aria-controls="preferiti" role="tab" data-toggle="tab">
					<img class="img-responsive img-circle tab-img" src="../../img/preferiti.png" alt="preferiti">
				</a>
			</li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">

      <div role="tabpanel" class="tab-pane active" id="tutto">
          <div class="tab-elements">
            <div class="title-element">
              <h1>Tutti i nostri prodotti</h1>
            </div>

            <div class="container" id=prod-container>
                  <div class="row">

				  <?php

					$sql0 = " SELECT *
							FROM prodotto";
					$result = $conn->query($sql0) or trigger_error($conn->error."[$sql0]");

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							include 'caricamento_prodotti.php';
						}
					}
				  ?>
                  </div>
            </div>
          </div>
      </div>

      <div role="tabpanel" class="tab-pane " id="piadine">
        <div class="tab-elements">
          <div class="title-element">
            <h1>Le nostre piadine</h1>

			<?php
				$sql1 = " SELECT *
						FROM prodotto
						WHERE tipo='Piadina'";
				$result = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						include 'caricamento_prodotti.php';
					}
				}
				?>

          </div>
        </div>
      </div>

      <div role="tabpanel" class="tab-pane" id="crescioni">
        <div class="tab-elements">
          <div class="title-element">
            <h1>I nostri crescioni</h1>
			<?php
				$sql2 = " SELECT *
						FROM prodotto
						WHERE tipo='Crescione'";
				$result = $conn->query($sql2) or trigger_error($conn->error."[$sql2]");
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						include 'caricamento_prodotti.php';
					}
				}
				?>
          </div>
        </div>
      </div>

      <div role="tabpanel" class="tab-pane" id="rotoli">
        <div class="tab-elements">
          <div class="title-element">
            <h1>I nostri rotoli</h1>
			<?php
				$sql3 = " SELECT *
						FROM prodotto
						WHERE tipo='Rotolo'";
				$result = $conn->query($sql3) or trigger_error($conn->error."[$sql3]");
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						include 'caricamento_prodotti.php';
					}
				}
				?>
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="altro">
        <div class="tab-elements">
          <div class="title-element">
            <h1>Altre specialità</h1>
			<?php
				$sql4 = " SELECT *
						FROM prodotto
						WHERE tipo='Altro'";
				$result = $conn->query($sql4) or trigger_error($conn->error."[$sql4]");
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						include 'caricamento_prodotti.php';
					}
				}
				?>
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="bibite">
        <div class="tab-elements">
          <div class="title-element">
            <h1>Le nostre bibite</h1>
			<?php
				$sql5 = " SELECT *
						FROM prodotto
						WHERE tipo='Bibite'";
				$result = $conn->query($sql5) or trigger_error($conn->error."[$sql5]");
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						include 'caricamento_prodotti.php';
					}
				}
				?>
          </div>
        </div>
      </div>


			<div role="tabpanel" class="tab-pane" id="preferiti">
				<div class="tab-elements">
					<div class="title-element">
						<h1>I tuoi preferiti</h1>
			<?php
				$user= $_SESSION['username'];
				$sql6 = "SELECT *
						FROM prodotto
						WHERE id_prodotto IN (
							SELECT id_prodotto
							FROM preferisce
							WHERE username='$user'
						)";
				$result = $conn->query($sql6) or trigger_error($conn->error."[$sql6]");
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						include 'caricamento_prodotti.php';
					}
				}
				?>
					</div>
				</div>
			</div>


    </div>
	
	<?php
		include 'add_preferiti.php';
		include 'modal.php';
	?>
	
</body>
</html>
