<?php
//Dichiarazione variabili per server
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
  
  <form class="modal-content animate" method="post">
    <div class="container">
	  <label for="new_name"><b>Nome</b></label>
      <input type="text" placeholder="Enter name" name="new_name" id="new_name" required>
	  
	  <label for="new_surname"><b>Cognome</b></label>
      <input type="text" placeholder="Enter surname" name="new_surname" id="new_surname" required>
	  
	  <label for="new_mail"><b>Mail</b></label>
      <input type="email" placeholder="Enter mail" name="new_mail" id="new_mail" required>
	  
	  <label for="new_telephone"><b>Telefono</b></label>
      <input type="text" placeholder="Enter telephone" name="new_telephone" id="new_telephone" required>
	  
      <label for="new_uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="new_uname" id="new_uname" required>

      <label for="new_psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="new_psw" id="new_psw" required>
	  
	  <label for="new_rep_psw"><b>Repeat Password</b></label>
      <input type="password" placeholder="Enter Password" name="new_rep_psw" id="new_rep_psw" required>
     
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
			$sql = "SELECT username, password
				FROM utente
				WHERE username = '$user'
				AND password = '$pwd'";
			$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
			$conn->close();
			echo "$user";
			echo "$pwd";
			$row = $result->fetch_assoc();
			if ($row["username"] === $user && $row["password"] === $pwd) {
				$_SESSION["username"] = $user;
				header('Location: ./user_home.php');
			} else {
				header('Location: ./login.php');
			}
		}
	?>
	
<?php
		if (isset($_REQUEST["new_name"]) && isset($_REQUEST["new_surname"]) && isset($_REQUEST["new_mail"]) && isset($_REQUEST["new_telephone"])
			&& isset($_REQUEST["new_uname"]) && isset($_REQUEST["new_psw"]) && isset($_REQUEST["new_rep_psw"])) {
			
			if ($_REQUEST["new_psw"] === $_REQUEST["new_rep_psw"]) {
				$username = $_REQUEST["new_uname"];
				$password = $_REQUEST["new_psw"];
			
				$sql1 = "SELECT *
					FROM utente
					WHERE username = '$username'
					OR password = '$password'";
				$result = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
				
				if($result->num_rows === 0) {
					$email = $_REQUEST["new_mail"];
					$telephone = $_REQUEST["new_telephone"];
					$nome = $_REQUEST["new_name"];
					$cognome = $_REQUEST["new_surname"];
					
					$sql2 = "INSERT INTO utente(username, password, email, nome, cognome, telefono)
						VALUES ('$username', '$password', '$email', '$nome', '$cognome', '$telephone')";
					$conn->query($sql2) or trigger_error($conn->error."[$sql2]");
					
					header('Location: ./login.php');
				} else {
					echo "ESISTE GIÀ UN UTENTE CON STESSO USERNAME O EMAIL";
				}
			} else {
				echo "PASSWORD E CONFERMA PASSWORD NON COMBACIANO";
			}
		}
	?>	
	
</body>
</html>