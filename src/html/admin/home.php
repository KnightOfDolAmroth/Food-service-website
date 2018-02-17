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
	
	if (isset($_SESSION["avvisi"])) {
		echo "<script>$('#data_modal').modal('show');</script>";
		unset($_SESSION["avvisi"]);
	}
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

  <?php include 'navbar/home.html'; ?>

	<script>
		$(document).ready(function(){
			$('.bottone_dettagli').click(function(){
				var codice_ordine = $(this).attr("value");
				$.ajax({
					url:"modal/dettagli.php",
					method:"post",
					data:{codice_ordine:codice_ordine},
					success:function(data){
						console.log(codice_ordine);
						$('#dettagli_ordine').html(data);
						$('#data_modal_dettagli').modal("show");
					}
				});
			});

			$('.selectpicker').click(function(){
				var stato = $(this).val();
				document.getElementById("stato").value = stato;
				console.log((document.getElementById("stato").value));
			});

			$('.bottone_stato').click(function(){
				var procedi = $(this).val();
				var stato = $('#stato').val();
				$.ajax({
					url:"stato.php",
					method:"post",
					data:{procedi:procedi,stato:stato},
					success:function(data){
						console.log(procedi);
						$('#dettagli_ordine').html(data);
					}
				});
				setTimeout(function () { location.reload(true); }, 100);
			});
		});
	</script>

	<header>
      <h1>Benvenuto/a, admin</h1>

	  <?php
		$sql0 = " SELECT COUNT(codice_ordine) AS count
				FROM ordine
				WHERE stato = 'Inattivo'
				ORDER BY data";
		$result = $conn->query($sql0) or trigger_error($conn->error."[$sql0]");
		if ($result->num_rows>0) {
			$row = $result->fetch_assoc();
			$ordini_inattivi = $row["count"];
		} else {
			$ordini_inattivi = '0';
		}
		?>

      <h3>Ci sono: <?php echo $ordini_inattivi ?> ordini non spediti</h3>
    </header>

  <body>
    <div class="container">
      <legend>Gestione ordini</legend>
      <div class="row col-titles">
        <div class="col-sm-1 field-title"></div>
        <div class="col-sm-2 field-title">num. ordine</div>
        <div class="col-sm-2 field-title">data e ora</div>
        <div class="col-sm-2 field-title">indirizzo e campanello</div>
        <div class="col-sm-2 field-title">consegna</div>
        <div class="col-sm-1 field-title">pezzi</div>
        <div class="col-sm-2 field-title">stato</div>
      </div>
	  <div class="ord-body">

	  <?php

		$sql0 = " SELECT *
				FROM ordine
				WHERE stato <> 'in creazione'
				ORDER BY data DESC";
		$result = $conn->query($sql0) or trigger_error($conn->error."[$sql0]");
		if ($result->num_rows>0) {
			while ($row = $result->fetch_assoc()) {
				include 'ordini.php';
			}
		}

	  ?>
	  </div>
	</div>

	<div class="modal fade" id="data_modal_dettagli" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Dettagli ordine</h4>
				</div>
				<div class="modal-body" id="dettagli_ordine"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Esci</button>
				</div>
			</div>
		</div>
	</div>

  </body>
</html>
