<?php
	session_start();
	if (isset($_REQUEST['id_selezione'])) {
		$_SESSION['menu'] = $_REQUEST['id_selezione'];
	}
?>