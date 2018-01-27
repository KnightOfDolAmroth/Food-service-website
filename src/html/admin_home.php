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
    <nav class="navbar navbar-inverse navbar-static-top">
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
      <div class="row col-titles">
        <div class="col-sm-1 field-title"></div>
        <div class="col-sm-2 field-title">num. ordine</div>
        <div class="col-sm-2 field-title">data e ora</div>
        <div class="col-sm-2 field-title">indirizzo e campanello</div>
        <div class="col-sm-2 field-title">consegna</div>
        <div class="col-sm-1 field-title">pezzi</div>
        <div class="col-sm-2 field-title">stato</div>
      </div>

    <div class="ord-body">
    <?php
      $sql0 = "SELECT *
              FROM ordine
              WHERE stato <> 'partito'";

      $result = $conn->query($sql0) or trigger_error($conn->error."[$sql0]");
      while ($row = $result->fetch_assoc()) {

        $id_ord = $row['codice_ordine'];
        $output = '';
        $output .= '
          <div class="row order">
            <div class="col-sm-1 user">';

            $sql1 = "SELECT username
                    FROM ordine
                    WHERE codice_ordine = $id_order";
            $result = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
            $identificativo = $result->fetch_assoc();
            $output .= '<img class="media-object" src="'.$identificativo.'.jpg" style="width: 72px; height: 72px;">';

            $output .= '<span id="username">'.$identificativo.'</span>
                </div>
                <div class="col-sm-2 ord-info">
                  <span class="ord-det">
                    <p>'.$id_ord.'</p>
                  </span>
                  <button class="btn btn-info det" type="button" name="button">Dettagli</button>
                </div>
                <div class="col-sm-2 ord-info">
                  <span class="d-h">
                    <p>'.$row['data_ordine'].'</p>
                    <p>'.$row['orario_ordine'].'</p>
                  </span>
                </div>
                <div class="col-sm-2 ord-info">
                  <span class="address">
                    <p>'.$row['indirizzo_recapito'].'</p>
                    <p>'.$row['nome_campanello'].'</p>
                  </span>
                </div>
                <div class="col-sm-2 ord-info">
                  <span class="d-h-cons">
                    <p>'.$row['data_consegna'].'</p>
                    <p>'.$row['orario_consegna'].'</p>
                  </span>
                </div>
                <div class="col-sm-1 ord-info">';

        $sql2 = "SELECT SUM(qta)
            		FROM dettaglio_ordine
            		WHERE id_dettaglio IN (SELECT id_dettaglio
            					                 FROM dettaglio_ordine
            					                 WHERE codice_ordine = '$id_ord'";

        $result = $conn->query($sql2) or trigger_error($conn->error."[$sql2]");
        $qta = $result->fetch_assoc();
        $output .= '<p>'.$qta.'</p>';

        $output .= '
          </div>
          <div class="col-sm-2 ord-info">
            <div class="form-inline" id="dropdowns">
              <div class="form-group">

                <label hidden for="status">Stato:</label>
                <select class="selectpicker" id="status">
                  <option selected="selected" value="inattivo">inattivo</option>
                  <option value="preparazione">in preparazione</option>
                  <option value="pronto">pronto</option>
                  <option value="partito">partito</option>
                </select>
              </div>
            </div>
          </div>
        </div>';
      	echo $output;
      }
    }
  ?>
    </div>
  </body>
</html>
