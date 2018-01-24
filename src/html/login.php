<?php
$servername="localhost";
$username ="root";
$password ="";
$database = "food_service";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
	die("Connection failed: " .$conn->connect_error);
}

session_start();
set_time_limit(30);

if(isset($_COOKIE["username"]) && ($_COOKIE["password"] != 'false')) {
	$usr = $_COOKIE['username'];
	$sql0 = "SELECT password
			FROM utente
			WHERE username = '$usr'";
	$result = $conn->query($sql0) or trigger_error($conn->error."[$sql0]");
	$row = $result->fetch_assoc();
	
	if ($row["password"] === $_COOKIE["password"]) {
		$conn->close();
		$_SESSION["username"] = $_COOKIE["username"];
		$_SESSION["password"] = $_COOKIE["password"];
		header('Location: ./user_home.php');
	}	
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link href="../css/login.css" rel="stylesheet" type="text/css"/>
 <script src="../js/login.js" type="text/javascript"></script>
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
	  <button type="reset" id="registrati" onclick="registration()" >Registrati</button>
      <label>
        <input type="checkbox" checked="checked" name="rememberme" id="rememberme" value="1" > Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="window.location.href='./homepage.html'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a onclick="forgot_pwd()" style="cursor: pointer; cursor: hand;">password?</a></span>
    </div>
  </form>
</div>

<div id="reg_form" class="modal">
  
  <form class="modal-content animate" method="post">
    <div class="container">
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

<div id="forgot_pwd_form" class="modal">
  
  <form class="modal-content animate" action="./login.php" method="post">
    <div class="container">
      <label for="mail_fp"><b>Mail</b></label>
      <input type="email" placeholder="Enter mail" name="mail_fp" id="mail_fp" required>
        
      <button type="submit" id="accedi3">Invia</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="window.location.href='./login.php'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<?php
		if (isset($_REQUEST["uname"]) && isset($_REQUEST["pwd"])) {
			$user = $_REQUEST["uname"];
			$sql = "SELECT username, password, salt
				FROM utente
				WHERE username = '$user'";
			$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
			$conn->close();
			$row = $result->fetch_assoc();
			$pwd = $_REQUEST["pwd"].$row["salt"];
			$pwd = substr(sha1($pwd),0,32);
			echo $pwd;
			echo "    ";
			echo $row["password"];
			if ($row["username"] === $user && $row["password"] === $pwd) {
				$_SESSION["username"] = $user;
				$_SESSION["password"] = $row["password"];
				if (isset($_REQUEST['rememberme'])) {
					$_SESSION["rememberme"] = true;
				} else {
					$_SESSION["rememberme"] = false;
				}
				header('Location: ./user_home.php');
			} else {
				header('Location: ./login.php');
			}
		}
	?>
	
<?php
		if (isset($_REQUEST["new_mail"]) && isset($_REQUEST["new_telephone"]) && isset($_REQUEST["new_uname"])
			&& isset($_REQUEST["new_psw"]) && isset($_REQUEST["new_rep_psw"])) {
			
			if ($_REQUEST["new_psw"] === $_REQUEST["new_rep_psw"]) {
				$username = $_REQUEST["new_uname"];
				$email = $_REQUEST["new_mail"];
			
				$sql1 = "SELECT *
					FROM utente
					WHERE username = '$username'
					OR email = '$email'";
				$result = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
				
				if($result->num_rows === 0) {
					$telephone = $_REQUEST["new_telephone"];
					$punti = 0;
					$salt = substr(md5(microtime()),rand(0,26),32);
					$password = $_REQUEST["new_psw"].$salt;
					$password = sha1($password);
					
					$sql2 = "INSERT INTO utente(username, password, email, telefono, punti, salt)
						VALUES ('$username', '$password', '$email', '$telephone', '$punti', '$salt')";
					$conn->query($sql2) or trigger_error($conn->error."[$sql2]");
					$conn->close();
					header('Location: ./login.php');
				} else {
					echo "ESISTE GIÀ UN UTENTE CON STESSO USERNAME O EMAIL";
				}
			} else {
				echo "PASSWORD E CONFERMA PASSWORD NON COMBACIANO";
			}
		}
	?>
	
<?php
		if (isset($_REQUEST["mail_fp"])) {
			echo "LETTURA DB";
			$email = $_REQUEST["mail_fp"];
			$sql3 = "SELECT email, password, salt
				FROM utente
				WHERE email = '$email'";
			$result = $conn->query($sql3) or trigger_error($conn->error."[$sql3]");
			$row = $result->fetch_assoc();
			echo "DB LETTO";
			if ($row["email"] === $email) {
				$new_pwd = substr(md5(microtime()),rand(0,26),10);				
				$subject = "Your Recovered Password";
				$message = "Please use this new password to login: ".$new_pwd;
				$headers = "From: prova@unibo.it";
				if(mail($email, $subject, $message, $headers)) {
					$pass = $new_pwd.$row["salt"];
					$pass = substr(sha1($pass),0,32);
					$sql4 = "UPDATE utente
						SET password = '$pass'
						WHERE email = '$email'";
					$result = $conn->query($sql4) or trigger_error($conn->error."[$sql4]");
					echo "MAIL INVIATA";
					header('Location: ./login.php');
				} else {
					echo "ERRORE INVIO MAIL";
				}
				echo "MAIL PREPARATA";
			}
			$conn->close();
		}
	?>
	
</body>
</html>