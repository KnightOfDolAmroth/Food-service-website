<?php
	if(isset($_REQUEST["procedi"])) {
		$servername="localhost";
		$username ="root";
		$password ="";
		$database = "food_service";

		$conn = new mysqli($servername, $username, $password, $database);
		if ($conn->connect_error) {
			die("Connection failed: " .$conn->connect_error);
		}

		$sql = "SELECT *
			FROM orari";
		$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");

		$output = '';
		$output .= '
			<legend>Fai sapere i tuoi orari di apertura ai tuoi visitatori.</legend>
			<div id="orari-tit" class="row col-titles">
				<div class="col-sm-2 field-title">Giorno</div>
				<div class="col-sm-4 field-title">Mattina</div>
				<div class="col-sm-4 field-title">Pomeriggio</div>
				<div class="col-sm-2 field-title"></div>
			</div>
			<div class="ord-body">';
				while ($row = $result->fetch_assoc()) {
					$output .= '
						<div  class="row order ora">
							<div class="col-sm-2 giorno">
								<span class="text-center"><p>'.$row["giorno"].'</p></span>
							</div>
							<div class="col-sm-2 hour apertura_mattina">
							<label class="ora-label"; for="apertura_mattina_">apertura:</label>
							<input required type="time" class="form-control" id="apertura_mattina_'.$row["giorno"].'" value="'.$row["apertura_mattina"].'"/>
							</div>
							<div class="col-sm-2 hour chiusura_mattina">
							<label class="ora-label"; for="chiusura_mattina_">chiusura:</label>

							<input required type="time" class="form-control" id="chiusura_mattina_'.$row["giorno"].'" value="'.$row["chiusura_mattina"].'"/></div>
							<div class="col-sm-2 hour apertura_pomeriggio">
							<input required type="time" class="form-control" id="apertura_pomeriggio_'.$row["giorno"].'" value="'.$row["apertura_pomeriggio"].'"/>
							</div>
							<div class="col-sm-2 hour chiusura_pomeriggio"><input required type="time" class="form-control" id="chiusura_pomeriggio_'.$row["giorno"].'" value="'.$row["chiusura_pomeriggio"].'"/></div>
							<div class="col-sm-2 aggiorna">
								<button class="btn btn-info bottone_aggiorna" type="button" name="button" id="'.$row["giorno"].'">Aggiorna</button>
							</div>
						</div>';
				}
				$output .= '
			</div>
			<h4>Seleziona 00:00 per indicare che il chiosto resterà chiuso.</h4>
			<script>
				$(document).ready(function(){
					$(".bottone_aggiorna").click(function(){
						var giorno = $(this).attr("id");
						var apertura_mattina = $("#apertura_mattina_".concat(giorno)).val();
						var chiusura_mattina = $("#chiusura_mattina_".concat(giorno)).val();
						var apertura_pomeriggio = $("#apertura_pomeriggio_".concat(giorno)).val();
						var chiusura_pomeriggio = $("#chiusura_pomeriggio_".concat(giorno)).val();
						$.ajax({
							url:"modal/tempo.php",
							method:"post",
							data:{giorno:giorno, apertura_mattina:apertura_mattina, chiusura_mattina:chiusura_mattina, apertura_pomeriggio:apertura_pomeriggio, chiusura_pomeriggio:chiusura_pomeriggio},
							success:function(data){
								console.log(giorno);
								console.log(apertura_mattina);
								console.log(chiusura_mattina);
								console.log(apertura_pomeriggio);
								console.log(chiusura_pomeriggio);
							}
						});
					});
				});
			</script>';
		echo $output;
	}
?>
