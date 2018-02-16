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
	
	$sql = "SELECT AVARAGE(stelle) AS media
		FROM prodotto
		WHERE id_prodotto = '$id_prodotto'";
	$result = $conn->query($sql) or trigger_error($conn->error."[$sql0]");
	if ($result->num_rows>0) {
		$row = $result->fetch_assoc();
		$media = $row["media"];
	} else
	
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
