<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home Utente</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="../css/user_home.css" rel="stylesheet" type="text/css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<!-- Lo username può essere reperito in $_REQUEST con parametro "uname" -->

<body>
  <nav class="navbar fixed-top navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">La Malaghiotta</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="#"><span class="glyphicon glyphicon-user"></span> Dati utente</a></li>
          <li><a href="#"><span class="glyphicon glyphicon-envelope"></span> Messaggi</a></li>
        </ul>
        <form class="navbar-form navbar-left" action="/action_page.php">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search">
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-search"></i>
              </button>
            </div>
          </div>
        </form>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <header>
    <h1>BENVENUTO, <?php $username=$_REQUEST['uname']; $username=strtoupper($username); echo $username; ?></h1>
    <h3>Hai accumulato: x punti</h3>
    <button type="button" onclick="window.location.href='./catalogue.html'"> Vai al catalogo offerte </button>
  </header>

  <article>
    <div class="ordinazioni">
      <div class="listino">
        <button type="button" class="btn btn-primary btn-lg btn-block btn-huge" onclick="window.location.href='./listino.html'"> Visualizza il listino completo <br/> e compila il tuo ordine! </button>
      </div>
      <div class="preferiti">
        <button type="button" class="btn btn-primary btn-lg btn-block btn-huge" onclick="window.location.href='./preferiti.html'"> Visualizza i tuoi preferiti <br/> e ordina più velocemente! </button>
      </div>
    </div>

    <div class="servizi">
      <div class="statistiche">
        <button type="button" class="btn btn-primary btn-lg btn-block btn-huge" onclick="window.location.href='./statistiche.html'"> I tuoi piatti preferiti? <br/> Accedi alle tue statistiche! </button>
      </div>
      <div class="storico">
        <button type="button" id="problem" class="btn btn-primary btn-lg btn-block btn-huge" onclick="window.location.href='./storico.html'"> La tua esperienza <br/> con noi di Malaghiotta! </button>
      </div>
    </div>
  </article>

</body>
</html>
