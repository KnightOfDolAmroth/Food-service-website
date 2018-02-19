<?php
	$output = '';
	$output .= '
		<link href="../../css/revModal.css" rel="stylesheet" type="text/css"/>
		<link href="../../css/stars.css" rel="stylesheet" type="text/css"/>
		<script src="../../js/stars.js" type="text/javascript"></script>

		<li>
		<div class="user-image">
			<img class="usr-img img-circle img-responsive" src="../../../img/users/male.png" alt="User Icon">
		</div>
		<div class="user-infos">
			<p class="username">'.$row["username"].'</p>
            <p class="register-date">'.$row["data"].'</p>
        </div>
		<div class="review-content">
            <div class="rank rev-star">';
				for ($i = 0; $i < $row["stelle"]; $i++) {
					$output .= '<span class="glyphicon .glyphicon-star glyphicon-star rev-star"></span>';
				}
				for (; $i < 5; $i++) {
					$output .= '<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty rev-star "></span>';
				}
				$output .= '
			</div>
			<p>'.$row["testo"].'</p>
		</div>
		</li>';
	echo $output;
?>
