<?php
	session_start();
	setcookie('username', $_SESSION['username'], time(), '/');
	setcookie('password', $_SESSION['password'], time(), '/');
	header('Location: ../homepage/home.html');
?>