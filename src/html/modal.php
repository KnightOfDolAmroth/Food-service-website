
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Aggiungi al carrello</h4>
        </div>
        <div class="modal-body">
          <div class="card-container">
            <div class="card">
              <img class="card-img img-rounded" src="<?php echo $_REQUEST['id_prodotto'];?>" alt="immagine prodotto">
              <div class="card-body">
				
                <h2 class="card-title"><?php echo $row['nome_prodotto'];?></h4>
                  <p class="card-text">Prosciutto cotto, prosciutto crudo, salame, pancetta, speck, ciccioli, lardo, speck, cubetti di strutto, zampone, mortadella, olio di palma</p>
                </div> <!--end product-->
              </div>

              <legend class="details">Dettagli aggiuntivi</legend>
              <div class="supplements">

                <div class="form-inline" id="dropdowns">
                  <div class="form-group">
                    <label for="imp">Impasto:</label>
                    <select class="selectpicker" id="imp">
                      <?php
                        $sql0 = "SELECT nome_impasto
                                FROM impasto";
                        $result = $conn->query($sql0) or trigger_error($conn->error."[$sql0]");
                        while ($row = $result->fetch_assoc()) {
                          echo "<option>" . $row['nome_impasto'] . "</option>";
                        }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="qta">Quantità </label>
                    <input id="qta" type="number" min="1" max="10">
                    </select>
                  </div>

                </div>

                <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapse-supp" aria-expanded="false" aria-controls="collapse-supp">
                  Aggiunte (0,50€)
                </button>

                <div class="collapse" id="collapse-supp">
                  <div class="well">
                    <div class="supp-container"></div>
                    <form class="supplements-list">
                      <div class="row">
                      <?php
                        $sql1 = "SELECT nome_ingrediente
                                FROM ingrediente";
                        $result = $conn->query($sql1) or trigger_error($conn->error."[$sql1]");
                        while ($row = $result->fetch_assoc()) {
								          ?><div class="col-sm-4 col-md-3">
								              <div class="form-check">
                                <label class="supp-label">
                                  <input type="checkbox" name="check" unchecked><?php
								                    echo "<span class='"."label-text"."'>".$row['nome_ingrediente']."</span>";
                                    echo "</label></div></div>";
                          }
                        ?>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
            <button type="button" class="btn btn-primary">Aggiungi
              <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div> <!--fine modal-->