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
    <link href="../../css/menu.css" rel="stylesheet" type="text/css"/>
	<link href="../../css/mix.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  </head>


  <body>

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

			$('.glyphicon-pencil').click(function(){
				var id_prodotto = $(this).attr("name");
				$.ajax({
					url:"modal/recensione.php",
					method:"post",
					data:{id_prodotto:id_prodotto},
					success:function(data){
						console.log(id_prodotto);
						$('#dettagli_recensione').html(data);
						$('#modal-recensione').modal("show");
					}
				});
			});

			$('.glyphicon-shopping-cart').click(function(){
				var id_prodotto = $(this).attr("id");
				$.ajax({
					url:"modal/prodotti.php",
					method:"post",
					data:{id_prodotto:id_prodotto},
					success:function(data){
						console.log(id_prodotto);
						$('#dettagli_prodotto').html(data);
						$('#data_modal_prodotti').modal("show");
					}
				});
			});

			$('#submit_form').click(function(event){
				var id = $('#id_prodotto').val();
				var qta = $('#qta').val();
				var imp = $('.selectpicker').val();
				var agg = new Array();
				$('.check:checked').each(function(){
					agg.push($(this).val());
				});
				$.ajax({
					url:"ordini.php",
					method:"post",
					data:{id_prodotto:id,qta:qta,imp:imp,agg:agg},
					success:function(data){
						console.log(`${imp}`);
						$('#data_modal_prodotti').modal("hide");
					}
				});
			});

			$('.glyphicon-heart-empty').click(function(){
				var id_prodotto = $(this).attr("id");
				$.ajax({
					url:"preferiti.php",
					method:"post",
					data:{id_prodotto:id_prodotto},
					success:function(data){
						console.log(id_prodotto);
					}
				});
				setTimeout(function () { location.reload(true); }, 100);
			});

			$('.selector').click(function(){
				var id_selezione = $(this).attr("name");
				$.ajax({
					url:"selezione.php",
					method:"post",
					data:{id_selezione:id_selezione},
					success:function(data){
						console.log(id_selezione);
					}
				});
			});
		});

	</script>

	<?php include 'navbar/generica.php'; ?>

	<div class="bkg">
		<img class="img-responsive" src="../../../img/piadona.jpeg" alt="background piada">
	</div>

    <ul class="nav nav-tabs" role="tablist" id="tablist">

      <li role="presentation" <?php if(isset($_SESSION['menu']) && $_SESSION['menu'] === 'tutto') {echo 'class="active"';}?>>
        <a href="#tutto" aria-controls="tutto" role="tab" data-toggle="tab" name="tutto" class="selector">
            <img class="img-responsive img-circle tab-img" src="../../../img/logo.jpg" alt="tutti i prodotti">
        </a>
      </li>

      <li role="presentation" <?php if(isset($_SESSION['menu']) && $_SESSION['menu'] === 'piadine') {echo 'class="active"';}?>>
        <a href="#piadine" aria-controls="piadine" role="tab" data-toggle="tab" name="piadine" class="selector">
          <img class="img-responsive img-circle tab-img" src="../../../img/piadine.jpg" alt="piadine">
        </a>
      </li>

      <li role="presentation" <?php if(isset($_SESSION['menu']) && $_SESSION['menu'] === 'crescioni') {echo 'class="active"';}?>>
        <a href="#crescioni" aria-controls="crescioni" role="tab" data-toggle="tab" name="crescioni" class="selector">
          <img class="img-responsive img-circle tab-img" src="../../../img/crescione.jpg" alt="crescioni">
        </a>
      </li>

      <li role="presentation" <?php if(isset($_SESSION['menu']) && $_SESSION['menu'] === 'rotoli') {echo 'class="active"';}?>>
        <a href="#rotoli" aria-controls="rotoli" role="tab" data-toggle="tab" name="rotoli" class="selector">
          <img class="img-responsive img-circle tab-img" src="../../../img/rotoli.jpg" alt="rotoli">
        </a>
      </li>

      <li role="presentation" <?php if(isset($_SESSION['menu']) && $_SESSION['menu'] === 'altro') {echo 'class="active"';}?>>
        <a href="#altro" aria-controls="altro" role="tab" data-toggle="tab" name="altro" class="selector">
          <img class="img-responsive img-circle tab-img" src="../../../img/altro.jpg" alt="altro">
        </a>
      </li>


      <li role="presentation" <?php if(isset($_SESSION['menu']) && $_SESSION['menu'] === 'bibite') {echo 'class="active"';}?>>
        <a href="#bibite" aria-controls="bibite" role="tab" data-toggle="tab" name="bibite" class="selector">
          <img class="img-responsive img-circle tab-img" src="../../../img/bibite.jpg" alt="bibite">
        </a>
      </li>

	  <li role="presentation" <?php if(isset($_SESSION['menu']) && $_SESSION['menu'] === 'preferiti') {echo 'class="active"';}?>>
		<a href="#preferiti" aria-controls="preferiti" role="tab" data-toggle="tab" name="preferiti" class="selector">
			<img class="img-responsive img-circle tab-img" src="../../../img/preferiti.png" alt="preferiti">
		</a>
	  </li>
    </ul>

    <div class="tab-content">

		<div role="tabpanel" class="tab-pane <?php if($_SESSION['menu'] === 'tutto') {echo 'active';}?>" id="tutto">
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
								include 'prodotti.php';
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>

		<div role="tabpanel" class="tab-pane <?php if($_SESSION['menu'] === 'piadine') {echo 'active';}?>" id="piadine">
			<div class="tab-elements">
				<div class="title-element">
					<h1>Le nostre piadine</h1>
				</div>
				<div class="container" id=prod-container>
					<div class="row">
						<?php
						$sql1 = " SELECT *
								FROM prodotto
								WHERE tipo='Piadina'";
						$result = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								include 'prodotti.php';
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>

		<div role="tabpanel" class="tab-pane <?php if($_SESSION['menu'] === 'crescioni') {echo 'active';}?>" id="crescioni">
			<div class="tab-elements">
				<div class="title-element">
					<h1>I nostri crescioni</h1>
				</div>
				<div class="container" id=prod-container>
					<div class="row">
						<?php
						$sql2 = " SELECT *
								FROM prodotto
								WHERE tipo='Crescione'";
						$result = $conn->query($sql2) or trigger_error($conn->error."[$sql2]");
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								include 'prodotti.php';
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>

		<div role="tabpanel" class="tab-pane <?php if($_SESSION['menu'] === 'rotoli') {echo 'active';}?>" id="rotoli">
			<div class="tab-elements">
				<div class="title-element">
					<h1>I nostri rotoli</h1>
				</div>
				<div class="container" id=prod-container>
					<div class="row">
					<?php
					$sql3 = " SELECT *
							FROM prodotto
							WHERE tipo='Rotolo'";
					$result = $conn->query($sql3) or trigger_error($conn->error."[$sql3]");
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							include 'prodotti.php';
						}
					}
					?>
					</div>
				</div>
			</div>
		</div>

		<div role="tabpanel" class="tab-pane <?php if($_SESSION['menu'] === 'altro') {echo 'active';}?>" id="altro">
			<div class="tab-elements">
				<div class="title-element">
					<h1>Altre specialità</h1>
				</div>
				<div class="container" id=prod-container>
					<div class="row">
						<?php
						$sql4 = " SELECT *
								FROM prodotto
								WHERE tipo='Altro'";
						$result = $conn->query($sql4) or trigger_error($conn->error."[$sql4]");
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								include 'prodotti.php';
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>

		<div role="tabpanel" class="tab-pane <?php if($_SESSION['menu'] === 'bibite') {echo 'active';}?>" id="bibite">
			<div class="tab-elements">
				<div class="title-element">
					<h1>Le nostre bibite</h1>
				</div>
				<div class="container" id=prod-container>
					<div class="row">
					<?php
					$sql5 = " SELECT *
							FROM prodotto
							WHERE tipo='Bibite'";
					$result = $conn->query($sql5) or trigger_error($conn->error."[$sql5]");
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							include 'prodotti.php';
						}
					}
					?>
					</div>
				</div>
			</div>
		</div>

		<div role="tabpanel" class="tab-pane <?php if($_SESSION['menu'] === 'preferiti') {echo 'active';}?>" id="preferiti">
			<div class="tab-elements">
				<div class="title-element">
					<h1>I tuoi preferiti</h1>
				</div>
				<div class="container" id=prod-container>
                <div class="row">
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
							include 'prodotti.php';
						}
					}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="data_modal_prodotti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Aggiungi al carrello</h4>
				</div>
				<div class="modal-body" id="dettagli_prodotto"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
					<button type="button" class="btn btn-primary" id="submit_form">Aggiungi
					  <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
					</button>
				</div>
			</div>
		</div>
    </div>

	<div id="modal-recensione" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-body" id="dettagli_recensione"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
