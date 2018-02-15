<?php
$servername="localhost";
$username ="root";
$password ="";
$database = "food_service";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
	die("Connection failed: " .$conn->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../../css/login.css" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="../../js/login.js" type="text/javascript"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
  <div id="change-pwd" class="modal">
    <form class="modal-content animate" action="./pwdchange.php" method="post">
      <div class="container">
        <label for="old-pwd"><b>Password attuale: </b></label>
        <input type="password" placeholder="Enter Current Password" name="old-pwd" id="old-pwd" required>

        <label for="new-pwd"><b>Nuova password: </b></label>
        <input type="password" placeholder="Enter New Password" name="new-pwd" id="new-pwd" required>

        <label for="repeat-pwd"><b>Ripeti nuova password: </b></label>
        <input type="password" placeholder="Enter New Password" name="repeat-pwd" id="repeat-pwd" required>
      </div>

      <div class="container" style="background-color: #cccccc;">
        <button type="submit" class="btn btn-primary btn-lg btn-block btn-huge" id="modifica">Modifica</button>
  	  	<button type="reset" onclick="window.location.href='../home.php'" class="btn btn-danger">Annulla</button>
      </div>
    </form>
  </div>

<?php
  if (isset($_REQUEST["old-pwd"]) && isset($_REQUEST["new-pwd"]) && isset($_REQUEST["repeat-pwd"])) {

    if ($_REQUEST["new-pwd"] === $_REQUEST["repeat-pwd"]) {
      $username = $_SESSION["uname"];
      $oldpwd = $_REQUEST["old-pwd"];
      $newpwd = $_REQUEST["new-pwd"];
			$repeatpwd = $_REQUEST["repeat-pwd"];

      $sql1 = "SELECT password
        FROM utente
        WHERE username = '$username'";
      $result = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
      $pwd = $result->fetch_assoc();

      if ($pwd == $oldpwd) {
        $sql2 = "UPDATE utente
          SET password = '$newpwd'
          WHERE username = '$username'";
        $conn->query($sql2) or trigger_error($conn->error."[$sql2]");
  			$conn->close();

        $message = "Password modificata con successo!";
  			echo "<script>alert('$message');</script>";
  			header('Location: ./pwdchange.php');
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
