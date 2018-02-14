<?php
	session_start();
	ob_start();
	if (isset($_SESSION['rememberme']) && $_SESSION['rememberme'] === true) {
		setcookie('username', $_SESSION['username'], time()+60*60*24*365, '/');
		setcookie('password', $_SESSION['password'], time()+60*60*24*365, '/');
	} else {
		setcookie('username', $_SESSION['username'], time(), '../', '../');
		setcookie('password', $_SESSION['password'], time(), '../', '../');
	}
	ob_end_flush();

	$servername="localhost";
	$username ="root";
	$password ="";
	$database = "food_service";

	$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " .$conn->connect_error);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home Utente</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="../../css/user_home.css" rel="stylesheet" type="text/css"/>
  <link href="../../css/admin_home.css" rel="stylesheet" type="text/css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

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

		$('.bottone_elimina').click(function(){
			var id_messaggio = $(this).attr("id");
			var username = $(this).attr("value");
			$.ajax({
				url:"modal/aggiorna.php",
				method:"post",
				data:{id_messaggio:id_messaggio, username:username},
				success:function(data){
					console.log(id_messaggio);
					$('#data_modal').modal("hide");
					$('#dettagli_messaggi').html(data);
					$('#data_modal').modal("show");
				}
			});
		});
	});

</script>

<body>
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
					<li><a href="#" class="messaggi"><span class="glyphicon glyphicon-envelope"></span> Messaggi</a></li>
					<li class="dropdown">
						<a href="#" data-toggle="dropdown" class="dropdown-toggle"> Gestione Password<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#">
								<label for="nome"><b>Nome utente: </b></label>
							</a></li>
							<li><a href="#">
								<input type="text" placeholder="Enter Username" name="usr" id="nome" required>
							</a></li>
							<li><a href="#">
								<label for="old"><b>Password corrente: </b></label>
							</a></li>
							<li><a href="#">
								<input type="password" placeholder="Enter Old Password" name="pwd" id="old" required>
							</a></li>
							<li><a href="#">
								<label for="new"><b>Nuova password:</b></label>
							</a></li>
							<li><a href="#">
								<input type="password" placeholder="Enter New Password" name="new-pwd" id="new" required>
							</a></li>
							<li><a href="#">
								<label for="repeat"><b>Conferma password: </b></label>
							</a></li>
							<li><a href="#">
								<input type="password" placeholder="Enter New Password" name="conf-pwd" id="repeat" required>
							</a></li>
							<li class="divider"></li>
							<li><a href="#">
								<button type="submit" value="aggiornaPassword" id="update">Aggiorna Password</button><br>
								<button type="button" onclick="window.location.href='./home.php'" id="abort">Cancella</button>
							</a></li>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
	        <li><a href="../homepage/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>

  <header>
    <h1>Benvenuto/a, <?php echo $username; ?></h1>
    <h3>Hai accumulato: <?php echo $punti; ?> punti</h3>
  </header>

  <article>
    <div class="ordinazioni">
		<div class="listino">
			<button type="button" class="btn btn-primary btn-lg btn-block btn-huge" onclick="window.location.href='./menu.php'">Listino prodotti:<br/>scegli le nostre proposte</button>
		</div>
		<div class="preferiti">
			<button type="button" class="btn btn-primary btn-lg btn-block btn-huge" onclick="window.location.href='./cart/carrello.php'">Carrello ordini:<br/>procedi all'acquisto</button>
		</div>
    </div>
  </article>

  <div class="modal fade" id="data_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Casella degli avvisi</h4>
				</div>
				<div class="modal-body" id="dettagli_messaggi"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Esci</button>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
