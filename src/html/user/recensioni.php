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
		$media = number_format((float)$row["media"], 1, ',', '');
		if ($media < 1) {
			$media = "non è stato espresso ancora alcun voto.";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <?php include 'navbar/generica.html'; ?>

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
	
	<header>
		<!-- DA METTERE LE INFORMAZIONI SUL PRODOTTO -->
		<img class="card-img img-rounded" alt="immagine prodotto" width="300" height="300" src="<?php echo $row["id_prodotto"];?>">
		<div class="card-body">
			<h3 class="card-title"><?php echo$row["nome_prodotto"];?></h3>
			<p class="card-text"></p>
		</div>
		<div>€ <?php echo number_format((float)$row['prezzo_base'], 2, ',', '');?></div>
		<p class="card-text">Ingredienti: 
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
				while ($row = $dati_ingredienti->fetch_assoc()) {
					if($first != 0){
						echo ', '.$row["nome_ingrediente"];
					} else {
						echo $row["nome_ingrediente"];
						$first=1;
					}
				}
			}
		?>
		</p>
		<p>Media recensioni: <?php echo $media; ?></p>
    </header>

  <body>
    <div class="container">
      <legend>Elenco recensioni</legend>
	  <div class="ord-body">

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
	  </div>
	</div>
  </body>
</html>
