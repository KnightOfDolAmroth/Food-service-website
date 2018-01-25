<!DOCTYPE html>	
	<?php	
	echo "<div class='"."col-sm-6 col-md-4 col-lg-3"."'>";
	echo "<div class='"."card-container"."'>";
	echo "<div class='"."card"."'>";
	echo "<img class='"."card-img img-rounded"." alt='"."immagine prodotto"." src='".$row['id_prodotto']."'>";
	echo "<div class='"."card-body"."'>";
	echo "<h2 class='"."card-title"."'>".$row['nome_prodotto']."</h2>";
	echo "<p class='"."card-text"."'></p>";
	echo "</div>";
	echo "<div class='"."checkout-details"."'>";
	echo "<div class='"."price"."'>€ ".$row['prezzo_base']."</div>";
	echo "<div class='"."btn-container"."'>";
	?><form class="modal-content animate" action="./add_preferiti.php" method="post">
	<button type="submit" name="id_prodotto" value="<?php echo $row['id_prodotto'] ?>" class="btn btn-default btn-circle glyphicon glyphicon-heart-empty"></button>
	</form>
	<button type="button"  class="btn btn-default btn-circle glyphicon glyphicon-shopping-cart"></button><?php
	echo "</div></div></div></div></div>";?>