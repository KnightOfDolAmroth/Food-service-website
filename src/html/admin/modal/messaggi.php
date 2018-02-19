<?php
	if(isset($_REQUEST["username"])) {
		$servername="localhost";
		$username ="root";
		$password ="";
		$database = "food_service";

		$conn = new mysqli($servername, $username, $password, $database);
		if ($conn->connect_error) {
			die("Connection failed: " .$conn->connect_error);
		}
		$usr = $_REQUEST["username"];

		$sql = "SELECT *
				FROM messaggio
				WHERE username = '$usr'";
		$output = '';
		$output .= '
			<legend>Aggiungi degli avvisi per i visitatori</legend>
				<div class="ord-body">
				<div class="row order new-avviso">

					<div class="col-sm-12 oggetto">
					<label class="avvisi-lab"; for="oggetto">oggetto</label>
					<input required type="text" class="form-control" id="oggetto" value="" /></div>
					<div class="col-sm-12 testo">
						<label class="avvisi-lab"; for="testo">testo</label>
					<input required type="text" class="form-control" id="testo" value="" /></div>
					<div class="col-sm-12 elimina">
						<button class="btn btn-info bottone_aggiungi" type="button" name="button" value="admin">Aggiungi</button>
					</div>
				</div>
			</div>';

		$output .= '
			<legend>Elimina gli avvisi che non sono più significativi</legend>';
				$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
				if ($result->num_rows>0) {
					$output .= '
						<div class="row col-titles mex-tit">
							<div class="col-sm-2 field-title">Oggetto</div>
							<div class="col-sm-8 field-title">Testo del messaggio</div>
							<div class="col-sm-2 field-title"></div>
						</div>
						<div class="ord-body">';
					while ($row = $result->fetch_assoc()) {
						$output .= '
							<div class="row order">
								<div class="col-sm-2 oggetto grass">
									<span class="text-center"><p>'.$row["oggetto"].'</p></span>
								</div>
								<div class="col-sm-8 testo">
									<span class="ord-id text-center"><p>'.$row["testo"].'</p></span>
								</div>
								<div class="col-sm-2 elimina">
									<button class="btn btn-info bottone_elimina el-mex" type="button" name="button" id="'.$row["id_messaggio"].'" value="'.$usr.'">Elimina</button>
								</div>
							</div>';
					}
				} else {
					$output .= '
							<div class="row order">
								<div class="col-sm-12 oggetto">
									<span class="text-center"><p>La cartella è vuota</p></span>
								</div>
							</div>';
				}
				$output .= '
			</div>
			<script>
				$(document).ready(function(){
					$(".bottone_elimina").click(function(){
						var id_messaggio = $(this).attr("id");
						var username = $(this).attr("value");
						$.ajax({
							url:"modal/aggiorna.php",
							method:"post",
							data:{id_messaggio:id_messaggio},
							success:function(data){
								console.log(id_messaggio);
							}
						});
						setTimeout(function(){
							$.ajax({
								url:"modal/messaggi.php",
								method:"post",
								data:{username:username},
								success:function(data){
									console.log(username);
									$("#dettagli_messaggi").html(data);
									$("#data_modal").modal("show");
								}
							});
						}, 100);
					});

					$(".bottone_aggiungi").click(function(){
						var oggetto = $("#oggetto").val();
						var testo = $("#testo").val();
						var username = "admin";
						$.ajax({
							url:"avvisi.php",
							method:"post",
							data:{oggetto:oggetto, testo:testo},
							success:function(data){
								console.log(oggetto);
							}
						});
						setTimeout(function(){
							$.ajax({
								url:"modal/messaggi.php",
								method:"post",
								data:{username:username},
								success:function(data){
									console.log(username);
									$("#dettagli_messaggi").html(data);
									$("#data_modal").modal("show");
								}
							});
						}, 100);
					});
				});
			</script>';
		echo $output;
	}
?>
