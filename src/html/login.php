<?php
//Dichiarazione variabili per server
$servername="localhost";
$username ="root";
$password ="";
$database = "laboratorio";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
	die("Connection failed: " .$conn->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link href="../css/login.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="log_form" class="modal">
  
  <form class="modal-content animate" action="./login.php" method="post">
    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" id="uname" required>

      <label for="pwd"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="pwd" id="pwd" required>
        
      <button type="submit" id="accedi1">Accedi</button>
	  <button id="registrati" onclick="registration()" >Registrati</button>
      <label>
        <input type="checkbox" checked="checked"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="window.location.href='./homepage.html'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>

<div id="reg_form" class="modal">
  
  <form class="modal-content animate" action="./login.php" method="post">
    <div class="container">
      <label><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="new_uname" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="new_psw" required>
	  
	  <label><b>Repeat Password</b></label>
      <input type="password" placeholder="Enter Password" name="new_rep_psw" required>
     
      <button type="submit" id="accedi2">Submit</button>
	  <button type="button" onclick="window.location.href='./login.php'" id="cancel">Cancel</button>
      <label>
        <input type="checkbox" checked="checked"> Remember me
		<p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
      </label>
    </div>
  </form>
</div>

<script src="../js/login.js" type="text/javascript"></script>

<?php
		if (isset($_REQUEST["uname"]) && isset($_REQUEST["pwd"])) {
			$user = $_REQUEST["uname"];
			$pwd = $_REQUEST["pwd"];
			$sql = "SELECT nome, cognome
				FROM studenti
				WHERE nome = '$user'
				AND cognome = '$pwd'";
			$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
			$conn->close();
			$row = $result->fetch_assoc();
			if ($row["nome"] === $user && $row["cognome"] === $pwd) {
				header('Location: ./user_home.html');
			} else {
				header('Location: ./login.php');
			}
		}
	?>

</body>
</html>