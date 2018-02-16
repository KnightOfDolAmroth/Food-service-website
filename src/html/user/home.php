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

	<?php
		include 'navbar/home.html';
		$username=$_SESSION['username'];
		$sql = "SELECT punti
			FROM utente
			WHERE username = '$username'";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
		$row = $result->fetch_assoc();
		$punti = $row["punti"];
	?>

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
		<div class="preferiti">
			<button type="button" class="btn btn-primary btn-lg btn-block btn-huge" onclick="window.location.href='recensioni.php'">Recensioni:<br/>scrivi le tue impressioni</button>
		</div>
    </div>
  </article>

</body>
</html>
