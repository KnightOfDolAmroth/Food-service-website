<?php 
	$output = '';
	$output .= '
		<link href="../../css/revModal.css" rel="stylesheet" type="text/css"/>
		<link href="../../css/stars.css" rel="stylesheet" type="text/css"/>
		<script src="../../js/stars.js" type="text/javascript"></script>
		<div class="row order">
			<div class="col-sm-3 user">
				<span id="data">'.$row["data"].'</span>
			</div>
			<div class="col-sm-6 ord-info">
				<span class="username"><p>'.$row["username"].'</p></span>
			</div>
			<div class="col-sm-3 ord-info">
				<span class="d-h">';
				//CARICARE LE STELLE DINAMICAMENTE
				for ($i = 0; $i < $row["stelle"]; $i++) {
					$output .= '<span class="glyphicon .glyphicon-star glyphicon-star"></span>';
				}
				for (; $i < 5; $i++) {
					$output .= '<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>';
				}
				$output .= '
				</span>
			</div>
			<div class="col-sm-12 ord-info">
				<span class="testo">
				<p>'.$row["testo"].'</p></span>
			</div>
		</div>';
	echo $output;
?>