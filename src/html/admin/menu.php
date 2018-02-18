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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link href="../../css/menu.css" rel="stylesheet" type="text/css"/>
	<link href="../../css/mix.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  </head>


  <body>

  <script>
		$(document).ready(function(){

			/*$('.glyphicon-edit').click(function(){
				var id_prodotto = $(this).attr("id");
				$.ajax({
					url:"modal/modifica-prodotto.php",
					method:"post",
					success:function(data){
						$('#dettagli_prodotto').html(data);
						$('#data_modal_prodotti').modal("show");
					}
				});
			});*/


			$('.add-prd').click(function(){
				$.ajax({
					url:"modal/aggiungi-prodotto.php",
					method:"post",
					success:function(data){
						$('#dettagli_nuovo_prodotto').html(data);
						$('#data_modal_aggiungi_prodotti').modal("show");
					}
				});
			});
			
			/*document.getElementById('.img-load').addEventListener("change", function(){
				$('#immagine-caricata').setAttribute('src', this);
				$.ajax({
					url:"modal/aggiungi-prodotto.php",
					method:"post",
					success:function(data){
						$('#dettagli_nuovo_prodotto').html(data);
						$('#data_modal_aggiungi_prodotti').modal("show");
					}
				});
			});*/

			/*$('.glyphicon-trash').click(function(){
				var id_prodotto = $(this).attr("id");
				$.ajax({
					url:"elimina-prodotto.php",
					method:"post",
					data:{id_prodotto:id_prodotto},
					success:function(data){
						console.log(id_prodotto);
					}
				});
				setTimeout(function () { location.reload(true); }, 100);
			});*/

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

	<?php include 'navbar/menu.html'; ?>

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
    </ul>

    <div class="tab-content">

		<div role="tabpanel" class="tab-pane <?php if($_SESSION['menu'] === 'tutto') {echo 'active';}?>" id="tutto">
			<div class="tab-elements">
				<div class="title-element">
				  <h1>Tutti i nostri prodotti</h1>
					<button class="btn btn-default add-prd glyphicon glyphicon-plus-sign" type="button" name="button"> Aggiungi prodotto </button>
				</div>
				<div class="container" id="prod-container">
					<div class="row">
						<?php
						$sql0 = " SELECT *
								FROM prodotto";
						$result = $conn->query($sql0) or trigger_error($conn->error."[$sql0]");

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								include '../user/prodotti.php';
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
					<button class="btn btn-default add-prd glyphicon glyphicon-plus-sign" type="button" name="button"> Aggiungi prodotto </button>
				</div>
				<div class="container" id="prod-container">
					<div class="row">
						<?php
						$sql1 = " SELECT *
								FROM prodotto
								WHERE tipo='Piadina'";
						$result = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								include '../user/prodotti.php';
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
					<button class="btn btn-default add-prd glyphicon glyphicon-plus-sign" type="button" name="button"> Aggiungi prodotto </button>
				</div>
				<div class="container" id="prod-container">
					<div class="row">
						<?php
						$sql2 = " SELECT *
								FROM prodotto
								WHERE tipo='Crescione'";
						$result = $conn->query($sql2) or trigger_error($conn->error."[$sql2]");
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								include '../user/prodotti.php';
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
					<button class="btn btn-default add-prd glyphicon glyphicon-plus-sign" type="button" name="button"> Aggiungi prodotto </button>
				</div>
				<div class="container" id="prod-container">
					<div class="row">
					<?php
					$sql3 = " SELECT *
							FROM prodotto
							WHERE tipo='Rotolo'";
					$result = $conn->query($sql3) or trigger_error($conn->error."[$sql3]");
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							include '../user/prodotti.php';
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
					<button class="btn btn-default add-prd glyphicon glyphicon-plus-sign" type="button" name="button"> Aggiungi prodotto </button>
				</div>
				<div class="container" id="prod-container">
					<div class="row">
						<?php
						$sql4 = " SELECT *
								FROM prodotto
								WHERE tipo='Altro'";
						$result = $conn->query($sql4) or trigger_error($conn->error."[$sql4]");
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								include '../user/prodotti.php';
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
					<button class="btn btn-default add-prd glyphicon glyphicon-plus-sign" type="button" name="button"> Aggiungi prodotto </button>
				</div>
				<div class="container" id="prod-container">
					<div class="row">
					<?php
					$sql5 = " SELECT *
							FROM prodotto
							WHERE tipo='Bibite'";
					$result = $conn->query($sql5) or trigger_error($conn->error."[$sql5]");
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							include '../user/prodotti.php';
						}
					}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="data_modal_aggiungi_prodotti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Nuovo prodotto</h4>
				</div>
				<form class="inserimento" name="inserimento" action="modal/nuovo.php" method="post" enctype="multipart/form-data">
				<div class="modal-body" id="dettagli_nuovo_prodotto"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default " data-dismiss="modal">Annulla
				</button>
					<button type="submit" class="btn btn-default" id="bottone-aggiungi">Salva
					  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
					</button>
				</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>
