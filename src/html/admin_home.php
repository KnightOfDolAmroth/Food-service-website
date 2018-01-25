<!DOCTYPE html>
<html lang="it">
  <head>
    <title>Gestione ordinazioni</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="../css/admin_home.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body>
    <nav class="navbar fixed-top navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./homepage.html">La Malaghiotta</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Dati utente</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-time"></span> Orari</a></li>
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
            <li><a href="./logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <header>
      <h1>Benvenuto/a, username</h1>
      <h3>Ci sono: x nuovi ordini in casella</h3>
      <button type="button" value="Go to menu management" onclick="window.location.href='./gestore.php';"> Vai alla gestione del listino </button>
    </header>

    <div class="container">
      <div class="row">
        <div class="col-6 col-md-4">
          <!-- Identificativo dell'ordine -->
          <h3>3181</h3>
        </div>
        <div class="col 6 col-md-4">
          <!-- Prodotti base dell'ordine (sono escluse le aggiunte) -->
          <h4>Piadina alla coppa</h4>
          <h4>Crescione zucca e patate<h4>
        </div>
        <div class="col-6 col-md-4">
          <!-- Dettagli dell'ordinazione (aggiunte incluse) contenute in un modal apposito per gli ordini -->
          <button class="details" type="button" onclick="">
            Dettagli
          </button>
        </div>
      </div>
    </div>

  </body>
</html>
