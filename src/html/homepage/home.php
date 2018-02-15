<!DOCTYPE html>
<html lang="en">
<head>
  <title>La Malaghiotta</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../../css/homepage.css" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- this file causes some unhappy side effects if we try to use the loggin form in this page -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>

</head>
<body>

<script>
	var dropCookie = true; // false disables the Cookie, allowing you to style the banner
	var cookieDuration = 14; // Number of days before the cookie expires, and the banner reappears
	var cookieName = 'complianceCookie'; // Name of our cookie
	var cookieValue = 'on'; // Value of cookie
	function createDiv(){
		var bodytag = document.getElementsByTagName('body')[0];
		var div = document.createElement('div');
		div.setAttribute('id','cookie-law');
		div.innerHTML = '<p>Our website uses cookies. By continuing we assume your permission to deploy cookies, as detailed in our <a href="/privacy-cookies-policy/" rel="nofollow" title="Privacy &amp; Cookies Policy">privacy and cookies policy</a>. <a class="close-cookie-banner" href="javascript:void(0);" onclick="removeMe();"><span>Chiudi</span></a></p>';
		// Be advised the Close Banner 'X' link requires jQuery
		// bodytag.appendChild(div); // Adds the Cookie Law Banner just before the closing </body> tag
		// or
		bodytag.insertBefore(div,bodytag.firstChild); // Adds the Cookie Law Banner just after the opening <body> tag
		document.getElementsByTagName('body')[0].className+=' cookiebanner'; //Adds a class tothe <body> tag when the banner is visible
		createCookie(window.cookieName,window.cookieValue, window.cookieDuration); // Create the cookie
	}
	function createCookie(name,value,days) {
		if (days) {
			var date = new Date();
			date.setTime(date.getTime()+(days*24*60*60*1000));
			var expires = "; expires="+date.toGMTString();
		}
		else var expires = "";
		if(window.dropCookie) {
			document.cookie = name+"="+value+expires+"; path=/";
		}
	}

	function checkCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) {
				return c.substring(nameEQ.length,c.length);
			}
		}
		return null;
	}

	function eraseCookie(name) {
		createCookie(name,"",-1);
	}
	window.onload = function(){
		if(checkCookie(window.cookieName) != window.cookieValue){
			createDiv();
		}
	}

	function removeMe(){
		var element = document.getElementById('cookie-law');
		element.parentNode.removeChild(element);
	}

</script>

<?php include 'navbar/home.html'; ?>

<div class="container text-center">
  <div class="row">
    <div class="col-sm-8">
  		<h2>Dove Siamo</h2>
  		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2606.263526976612!2d12.24132431551359!3d44.13838607910776!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x132ca4c89d21b735%3A0x3d6c5c21ea807c37!2s%22La+Malaghiotta%22!5e1!3m2!1sen!2sit!4v1514203490102"
  		width=100% height=300px frameborder="0" allowfullscreen></iframe>
	  </div>

    <div class="col-sm-4">
		<h2>Orari</h2>
		<table class='table table-striped table-borded'>
			<tr>
				<th>Lunedì</th>
				<th>12:00 - 14:00 | 18:30 - 20:30</th>
			</tr>
			<tr>
				<th>Martedì</th>
				<th>12:00 - 14:00 | 18:30 - 20:30</th>
			</tr>
			<tr>
				<th>Mercoledì</th>
				<th>12:00 - 14:00 | 18:30 - 20:30</th>
			</tr>
			<tr>
				<th>Giovedì</th>
				<th>Chiuso</th>
			</tr>
			<tr>
				<th>Venerdì</th>
				<th>12:00 - 14:00 | 18:30 - 20:30</th>
			</tr>
			<tr>
				<th>Sabato</th>
				<th>12:00 - 14:00 | 18:30 - 20:30</th>
			</tr>
			<tr>
				<th>Domenica</th>
				<th>12:00 - 14:00</th>
			</tr>
    </div>
  </div>
</div><br>
</body>
</html>
