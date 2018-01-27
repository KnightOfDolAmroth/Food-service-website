<?php 
	$servername="localhost";
	$username ="root";
	$password ="";
	$database = "food_service";
	
	$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " .$conn->connect_error);
	}
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="../css/admin_home.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <nav class="navbar navbar-inverse navbar-static-top">
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
            <li><a href="#"><span class="glyphicon glyphicon-time"></span> Orari</a></li>
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
    </nav>
	
	<script>
		$(document).ready(function(){  
			$('.bottone_dettagli').click(function(){  
				var codice_ordine = $(this).attr("value");  
				$.ajax({
					url:"modal-dettagli.php",  
					method:"post",
					data:{codice_ordine:codice_ordine},  
					success:function(data){
						console.log(codice_ordine);
						$('#dettagli_prodotto').html(data);  
						$('#data_modal').modal("show");  
					}  
				});				
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
      <button type="button" value="Go to menu management" onclick="window.location.href='./gestore.php';"> Vai alla gestione del listino </button>
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
				WHERE stato <> 'Creazione'
				ORDER BY data";
		$result = $conn->query($sql0) or trigger_error($conn->error."[$sql0]");
		if ($result->num_rows>0) {
			while ($row = $result->fetch_assoc()) {
				include 'carica-ordini.php';
			}
		}
	  
	  ?>
	  </div>
	</div>
	
	<div class="modal fade" id="data_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Dettagli ordine</h4>
				</div>
				<div class="modal-body" id="dettagli_prodotto"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Esci</button>
				</div>
			</div>
		</div>
	</div>
	
  </body>
</html>
