<!DOCTYPE html>
<html lang="it">
<head>
  <title>Gestione ordinazioni</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="../css/order_management.css" rel="stylesheet" type="text/css"/>
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
          <li><a href="./logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <header>
    <h1>I TUOI ORDINI</h1>
  </header>

  <section>

    <div class="tab">
      <button class="tablinks" onclick="openList(event, 'current')">Ordini in corso</button>
      <button class="tablinks" onclick="openList(event, 'previous')">Ordini precedenti</button>
    </div>

    <div id="current" class="tabcontent container">
      <div class="row col-titles">
        <div class="col-sm-3 field-title">id ordine</div>
        <div class="col-sm-4 field-title">riepilogo</div>
        <div class="col-sm-3 field-title">stato</div>
        <div class="col-sm-2 field-title"></div>

      </div>
      <div class="ord-body">
        <div class="row order">
          <div class="col-sm-3 ord-info id-ord">
            <span>
              <h1>123</h1>
            </span>
          </div>


          <div class="col-sm-4 ord-info">
            <div class="tl-row">
              <div class="timeline">
                    <span class="stat">inattivo</span>
                      <span class="stat">pendente</span>
                      <span class="stat">partito</span>
                      <span class="stat stat-active">concluso</span>
              </div>
            </div>
          </div>

            <div class="col-sm-3 ord-info riep">
                <div class="riepilogo">
                  <span class="field">
                    <p class="field-name">Indirizzo: </p>
                    <p class="field-value">Via 'ndante </p>
                  </span>
                  <span class="field">
                    <p class="field-name">Campanello: </p>
                    <p class="field-value">ciccio pasticcio</p>
                  </span>
                  <span class="field">
                    <p class="field-name">Data: </p>
                    <p class="field-value">10/02/2018</p>
                  </span>
                  <span class="field">
                    <p class="field-name">Ora: </p>
                    <p class="field-value">12:35</p>
                  </span>
                </div>
          </div>


          <div class="col-sm-2 ord-info trash">
            <button type="button" class="btn btn-link btn-lg">
									<span class="glyphicon glyphicon-trash"> </span>
						</button>
          </div>
      </div>

      <div class="row order">
        <div class="col-sm-3 ord-info id-ord">
          <span>
            <h1>333</h1>
          </span>
        </div>


        <div class="col-sm-4 ord-info">
          <div class="tl-row">
            <div class="timeline">
                  <span class="stat">inattivo</span>
                    <span class="stat">pendente</span>
                    <span class="stat">partito</span>
                    <span class="stat stat-active">concluso</span>
            </div>
          </div>
        </div>

          <div class="col-sm-3 ord-info riep">
              <div class="riepilogo">
                <span class="field">
                  <p class="field-name">Indirizzo: </p>
                  <p class="field-value">Via roma, 56 </p>
                </span>
                <span class="field">
                  <p class="field-name">Campanello: </p>
                  <p class="field-value">muzio scevola</p>
                </span>
                <span class="field">
                  <p class="field-name">Data: </p>
                  <p class="field-value">01/02/2018</p>
                </span>
                <span class="field">
                  <p class="field-name">Ora: </p>
                  <p class="field-value">08:40</p>
                </span>
              </div>
        </div>


        <div class="col-sm-2 ord-info trash">
          <button type="button" class="btn btn-link btn-lg">
                <span class="glyphicon glyphicon-trash"> </span>
          </button>
        </div>
    </div>

    <div class="row order">
      <div class="col-sm-3 ord-info id-ord">
        <span>
          <h1>274</h1>
        </span>
      </div>


      <div class="col-sm-4 ord-info">
        <div class="tl-row">
          <div class="timeline">
                <span class="stat">inattivo</span>
                  <span class="stat">pendente</span>
                  <span class="stat">partito</span>
                  <span class="stat stat-active">concluso</span>
          </div>
        </div>
      </div>

        <div class="col-sm-3 ord-info riep">
            <div class="riepilogo">
              <span class="field">
                <p class="field-name">Indirizzo: </p>
                <p class="field-value">Via delle rose </p>
              </span>
              <span class="field">
                <p class="field-name">Campanello: </p>
                <p class="field-value">lina carto</p>
              </span>
              <span class="field">
                <p class="field-name">Data: </p>
                <p class="field-value">3/02/2018</p>
              </span>
              <span class="field">
                <p class="field-name">Ora: </p>
                <p class="field-value">13:50</p>
              </span>
            </div>
      </div>


      <div class="col-sm-2 ord-info trash">
        <button type="button" class="btn btn-link btn-lg">
              <span class="glyphicon glyphicon-trash"> </span>
        </button>
      </div>
  </div>
    </div>

    <div id="previous" class="tabcontent">
      <p>These are your previous orders.</p>
    </div>
  </section>

  <script>
  function openList(evt, category) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(category).style.display = "block";
    evt.currentTarget.className += " active";
  }
  </script>

  <script type="text/javascript">
  $(function() {
  $('.timeline').on('click', '.stat', function() {
      $('.stat').removeClass('stat-active');
      $(this).addClass('stat-active');
  })
})
  </script>
</body>
</html>
