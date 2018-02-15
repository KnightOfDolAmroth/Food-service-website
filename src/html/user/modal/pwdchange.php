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
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../../../css/login.css" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../../../js/login.js" type="text/javascript"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
  <div id="change-pwd" class="modal show">
    <form class="modal-content animate" action="./pwdchange.php" method="post">
      <div class="container">
        <label for="old-pwd"><b>Password attuale: </b></label>
        <input type="password" placeholder="Enter Current Password" name="old-pwd" id="old-pwd" required>

        <label for="new-pwd"><b>Nuova password: </b></label>
        <input type="password" placeholder="Enter New Password" name="new-pwd" id="new-pwd" required>

        <label for="repeat-pwd"><b>Conferma password: </b></label>
        <input type="password" placeholder="Enter New Password" name="repeat-pwd" id="repeat-pwd" required>
      </div>

      <div class="container" style="background-color: #cccccc;">
        <button type="submit" class="btn btn-primary btn-lg btn-block btn-huge" id="modifica">Modifica</button>
  	  	<button type="reset" onclick="window.location.href='../home.php'" id="annulla" class="btn btn-primary btn-lg btn-block btn-huge">Annulla</button>
      </div>
    </form>
  </div>

<?php
	if (isset($_REQUEST["old-pwd"]) && isset($_REQUEST["new-pwd"]) && isset($_REQUEST["repeat-pwd"])) {
		$user = $_SESSION["username"];
		$oldpwd = $_REQUEST["old-pwd"];
		$newpwd = $_REQUEST["new-pwd"];
		$repeatpwd = $_REQUEST["repeat-pwd"];
		if ($newpwd === $repeatpwd) {
			$sql = "SELECT *
				FROM utente
				WHERE username = '$user'";
			$result = $conn->query($sql) or trigger_error($conn->error."[$sql]");
			$row = $result->fetch_assoc();
			$email = $row["email"];
			$pwd = $row["password"];
			$oldpwd = $oldpwd.$row["salt"];
			$oldpwd = substr(sha1($oldpwd),0,32);

			echo $pwd."   ===   ";
			echo $oldpwd;
			if ($pwd === $oldpwd) {
				$newpwd = sha1($newpwd.$row["salt"]);
				$sql = "UPDATE utente
					SET password = '$newpwd'
					WHERE username = '$user'";
				$conn->query($sql) or trigger_error($conn->error."[$sql]");
				$conn->close();

				$subject = "Your Recovered Password";
				$message = "Please use this new password to login: ".$repeatpwd;
				$headers = "From: prova@unibo.it";
				mail($email, $subject, $message, $headers);

				header('Location: ../home.php');
				exit;
			} else {
				$message = "Non hai inserito correttamente la tua password attuale.";
				echo "<script>alert('$message');</script>";
			}
		} else {
			$message = "Non hai confermato correttamente la tua password.";
			echo "<script>alert('$message');</script>";
		}
	}
?>

</body>
</html>
