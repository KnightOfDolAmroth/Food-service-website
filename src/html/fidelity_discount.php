<!DOCTYPE html>
<html lang="it">
<head>
  <title>Sconti fedeltà</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="../css/fidelity_discount.css" rel="stylesheet" type="text/css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
  <!-- Barra di navigazione -->
  <?php require_once('./navigation.html') ?>
  <!-- Fine barra di navigazione -->

  <header>
    <h3>Hai accumulato: x punti</h3>
    <h5> Scegli come usarli! </h5>
  </header>

  <div class="discount_list">
    <section>
      <h4> Con 15 punti: </h4>
      <h6> sconto del 5% sul tuo ordine! </h6>
    </section>
    <section>
      <h4> Con 25 punti: </h4>
      <h6> sconto del 10% sul tuo ordine! </h6>
    </section>
    <section>
      <h4> Con 50 punti: </h4>
      <h6> sconto del 20% sul tuo ordine! </h6>
    </section>
    <section>
      <h4> Con 100 punti: </h4>
      <h6> sconto del 40% sul tuo ordine! </h6>
    </section>
    <section>
      <h4> Con 150 punti: </h4>
      <h6> sconto del 60% sul tuo ordine! </h6>
    </section>
  </div>

  <article>
    <div class="ordinazioni">
      <div class="listino">
        <button type="button" class="btn btn-primary btn-lg btn-block btn-huge" onclick="window.location.href='./listino.html'"> Visualizza il listino completo <br/> e compila il tuo ordine! </button>
      </div>
      <div class="preferiti">
        <button type="button" class="btn btn-primary btn-lg btn-block btn-huge" onclick="window.location.href='./preferiti.html'"> Visualizza i tuoi preferiti <br/> e ordina più velocemente! </button>
      </div>
    </div>
  </article>
</body>
</html>
