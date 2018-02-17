<link href="../../css/admin_home.css" rel="stylesheet" type="text/css"/>
<link href="../../css/navbar.css" rel="stylesheet" type="text/css"/>
<nav class="navbar fixed-top navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="../homepage/home.php">La Malaghiotta</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
        <li><a href="#" class="messaggi" id="<?php echo $_SESSION['username'] ?>"><span class="glyphicon glyphicon-envelope"></span> Messaggi</a></li>
				<li><a href="./home.php"><span class="glyphicon glyphicon-home"></span> Homepage</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
        <!--<li>
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-user"></span>
            Profilo
           </a>-->

<?php
$usr_name = $_SESSION['username'];
/*$sql_query = " SELECT immagine
    FROM utente
    WHERE username = '$usr_name'";

$res = $conn->query($sql_query) or trigger_error($conn->error."[$sql_query]");
$usr_img_path = $res->fetch_assoc();*/
 ?>
           <!--<div class="dropdown-menu" aria-labelledby="userDropdown">
             <div class="user-data">
               <img class="img-responsive img-circle user-img" src="<?php echo $usr_img_path['immagine'] ?>" alt="user image">
               <span><?php echo $_SESSION['username'] ?></span>
             </div>
             <hr>
             <div id="img-loading-area">
               <label class="hidden" for="img-load">Carica immagine </label>
               <input id="img-load" type="file" accept="image/*">
             </div>
           </div>
        </li>
        <li><a href="../homepage/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
  		</ul>-->
      </div>
    </div>
  </nav>

  <div class="modal fade" id="data_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Casella degli avvisi</h4>
				</div>
				<div class="modal-body" id="dettagli_messaggi"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Esci</button>
				</div>
			</div>
		</div>
	</div>
