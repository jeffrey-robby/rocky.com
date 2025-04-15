<form action="" method="post">
  <div class="modal fade addCat" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajouter une catégorie</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group input-group mb-0 search-input category-search-input">
                <span class="input-group-text  ps-3 pe-0 border-0">
                    <i class="ph ph-magnifying-glass"></i>
                </span>
                <input type="text" name="catName" class="form-control border-0" required placeholder="Ajouter une categorie...">

            </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" name="AddCat" class="btn btn-success">Ajouter</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form action="../shop/approvisionner.php" method="get">
  <div class="modal fade RaddStock" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Approvisionner un Stock</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group input-group mb-0 search-input category-search-input">
                
                <select name="Stock" id="" class="form-control" required>               
                  <?php 
                  $request = mysqli_query($database, "SELECT * FROM stocks ");
                  while ($result = mysqli_fetch_assoc($request)) {
                    echo '
                     <option value="'.$result['id_stocks'].'">'.$result['nom_stocks'].'</option>
                    ';
                    # code...
                  }
                  ?>
                </select> 

            </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" name="RaddStock" class="btn btn-success">Allez y</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form action="../shop/transfert.php" method="get">
  <div class="modal fade TransdStock" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Transfert de Stock</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group input-group mb-0 search-input category-search-input">
                <label class="form-label" for="">Départ</label>
                <select name="StockD" id="" class="form-control" required>               
                  <?php 
                  $request = mysqli_query($database, "SELECT * FROM stocks ");
                  while ($result = mysqli_fetch_assoc($request)) {
                    echo '
                     <option value="'.$result['id_stocks'].'">'.$result['nom_stocks'].'</option>
                    ';
                    # code...
                  }
                  ?>
                </select>                 
            </div>
            <div class="form-group input-group">
            <label class="form-label" for="">Arriver</label>
                <select name="StockA" id="" class="form-control" required>               
                  <?php 
                  $request = mysqli_query($database, "SELECT * FROM stocks ");
                  while ($result = mysqli_fetch_assoc($request)) {
                    echo '
                     <option value="'.$result['id_stocks'].'">'.$result['nom_stocks'].'</option>
                    ';
                    # code...
                  }
                  ?>
                </select> 
            </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" name="RaddStock" class="btn btn-success">Allez y</button>
        </div>
      </div>
    </div>
  </div>
</form>

<div class="modal fade addFour" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajouter un Fournisseur</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
      <div class="card-body">
              <form class="row g-3 needs-validation" method="post" novalidate>
                <div class="col-md-6 position-relative">
                    <label for="validationTooltip01" class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" id="validationTooltip01" value="Fournisseur 1" required>
                    <div class="valid-tooltip">
                      Bon!
                    </div>
                </div>
                <div class="col-md-6 position-relative">
                    <label for="validationTooltip02" class="form-label">Contact</label>
                    <input type="tel" name="tel" class="form-control" id="validationTooltip02" min="9" placeholder="+237..." required>
                    <div class="invalid-tooltip">
                      Numéro Incorrecte!
                    </div>
                </div>
                <div class="col-md-6 position-relative">
                    <label for="validationTooltipUsername" class="form-label">Adresse</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text pt-1" id="validationTooltipUsernamePrepend">@</span>
                      <input type="text" name="adresse" class="form-control" id="validationTooltipUsername"
                          aria-describedby="validationTooltipUsernamePrepend" required placeholder="Adresse">
                      <div class="invalid-tooltip">
                        Entrer cette information!
                      </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <button name="AddFour" class="btn btn-primary mt-5" type="submit">Ajouter</button>
                </div>
              </form>
          </div>
      </div>        
    </div>
  </div>
</div>

<form action="" method="post">
  <div class="modal fade addStock" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajouter un Stockage</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group input-group mb-0 search-input category-search-input">
                <span class="input-group-text  ps-3 pe-0 border-0">
                    <i class="ph ph-magnifying-glass"></i>
                </span>
                <input type="text" name="catStock" class="form-control border-0" required placeholder="Ajouter un stock">

            </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" name="AddStock" class="btn btn-success">Ajouter</button>
        </div>
      </div>
    </div>
  </div>
</form>




<div class="modal fade addProd" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajouter un Produit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
      <div class="card-body">
          <form class="row g-3 needs-validation" method="post" enctype="multipart/form-data" novalidate >
            <div class="col-md-6 position-relative">
                <label for="validationTooltip01" class="form-label">Nom du Produit</label>
                <input type="text" name="nom" class="form-control" id="validationTooltip01" value="Prod 1" required>
                <div class="valid-tooltip">
                  Bon!
                </div>
            </div>
            <div class="col-md-6 position-relative">
                <label for="validationTooltip014" class="form-label">Quantité</label>
                <input type="number" name="Qt" class="form-control" id="validationTooltip014" min="1" required>
                <div class="invalid-tooltip">
                  Invalide!
                </div>
            </div>
            <div class="col-md-6 position-relative">
                <label for="validationTooltip02" class="form-label">Image Recto</label>
                <input type="file" name="ProdFile" class="form-control" id="validationTooltip02" required>
                <div class="invalid-tooltip">
                  Image manquante!
                </div>
            </div>
            <div class="col-md-6 position-relative">
                <label for="validationTooltip022" class="form-label">Image Verso</label>
                <input type="file" name="ProdFile2" class="form-control" id="validationTooltip022" required>
                <div class="invalid-tooltip">
                  Image manquante!
                </div>
            </div>
            <div class="col-md-6 position-relative">
                <label for="validationTooltipUsername12" class="form-label">Prix de détail</label>
                <div class="input-group has-validation">
                  <span class="input-group-text pt-1" id="validationTooltipUsername12Prepend">cfa</span>
                  <input type="number" name="PrixD" min="1" class="form-control" id="validationTooltipUsername12"
                      aria-describedby="validationTooltipUsername12Prepend" require>
                  <div class="invalid-tooltip">
                    Entrer un prix!
                  </div>
                </div>
            </div>
            <div class="col-md-6 position-relative">
                <label for="validationTooltipUsername2" class="form-label">Prix de Gros</label>
                <div class="input-group has-validation">
                  <span class="input-group-text pt-1" id="validationTooltipUsername2Prepend">cfa</span>
                  <input type="number" name="PrixG" min="1" class="form-control" id="validationTooltipUsername2"
                      aria-describedby="validationTooltipUsername2Prepend" require>
                  <div class="invalid-tooltip">
                    Entrer un prix!
                  </div>
                </div>
            </div>
            <div class="col-md-6 position-relative">
                <label for="validationTooltipUsername124" class="form-label">Seuil Critique</label>
                <div class="input-group has-validation">
                  <span class="input-group-text pt-1" id="validationTooltipUsername124Prepend">.</span>
                  <input type="number" name="Scr" min="1" class="form-control" id="validationTooltipUsername124"
                      aria-describedby="validationTooltipUsername124Prepend" require>
                  <div class="invalid-tooltip">
                  Non Valide!
                  </div>
                </div>
            </div>
            <div class="col-md-6 position-relative">
                <label for="validationTooltipUsername33" class="form-label">Description du Produit</label>
                <div class="input-group">
                  <input type="text" name="Desc" class="form-control" id="validationTooltipUsername33"
                      aria-describedby="validationTooltipUsername33Prepend" required>
                  <div class="invalid-tooltip">
                  Dites en Plus!
                  </div>
                </div>
            </div>
            <div class="col-md-6 position-relative">
                <label for="validationTooltip0224447" class="form-label">Catégorie</label>
                <select name="unit" id="" class="form-control" required>               
                  <option value="Paquet">Paquet</option>
                  <option value="Carton">Carton</option>
                  <option value="Piece">Piece</option>
                  <option value="Boite">Boite</option>
                  <option value="Cartouche">Cartouche</option>
                </select> 
                <div class="invalid-tooltip">
                  Non Valide!
                  </div>               
            </div>
            <div class="col-md-6 position-relative">
                <label for="validationTooltip0224447" class="form-label">Stock</label>
                <select name="Stock" id="" class="form-control" required>               
                  <?php 
                  $request = mysqli_query($database, "SELECT * FROM stocks ");
                  while ($result = mysqli_fetch_assoc($request)) {
                    echo '
                     <option value="'.$result['id_stocks'].'">'.$result['nom_stocks'].'</option>
                    ';
                    # code...
                  }
                  ?>
                </select> 
                <div class="invalid-tooltip">
                  Non Valide!
                  </div>               
            </div>
            <div class="col-md-6 position-relative">
                <label for="validationTooltip022" class="form-label">Fournisseur</label>
                <select name="Four" id="" class="form-control" required>
                  <?php 
                  $request = mysqli_query($database, "SELECT * FROM fournisseurs ");
                  while ($result = mysqli_fetch_assoc($request)) {
                    echo '
                     <option value="'.$result['id_fournisseurs'].'">'.$result['nom_fournisseurs'].'</option>
                    ';
                    # code...
                  }
                  ?>
                 
                </select>
                <div class="invalid-tooltip">
                  Non Valide!
                  </div>              
            </div>
            <div class="col-md-6 position-relative">
                <label for="validationTooltip02244" class="form-label">Catégorie</label>
                <select name="Cat" id="" class="form-control" required>
                <?php 
                  $request = mysqli_query($database, "SELECT * FROM categorie_produits ");
                  while ($result = mysqli_fetch_assoc($request)) {
                    echo '
                     <option value="'.$result['id_categorie_produits'].'">'.$result['nom_categorie_produits'].'</option>
                    ';
                    # code...
                  }
                  ?>
                  <option value=""></option>
                </select> 
                <div class="invalid-tooltip">
                  Non Valide!
                  </div>               
            </div>
            
            
            <div class="col-12">
                <button name="AddProd" class="btn btn-primary mt-5" type="submit">Ajouter</button>
            </div>
          </form>
        </div>
      </div>        
    </div>
  </div>
</div>









        <!-- <footer class="footer">
          <div class="footer-body">
            <ul class="left-panel list-inline mb-0 p-0">
              <li class="list-inline-item fw-500"><a class="footer-link" href="extra-pages/privacy-policy.html">Privacy
                  Policy</a></li>
              <li class="list-inline-item fw-500"><a class="footer-link" href="extra-pages/terms-of-service.html">Terms
                  of Use</a></li>
            </ul>
            <h6 class="right-panel mb-0">
              ©
              <script>document.write(new Date().getFullYear())</script>
              <span data-setting="app_name">Rocky</span>
              with
              <span class="text-danger">
                <svg class="icon-16" width="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M15.85 2.50065C16.481 2.50065 17.111 2.58965 17.71 2.79065C21.401 3.99065 22.731 8.04065 21.62 11.5806C20.99 13.3896 19.96 15.0406 18.611 16.3896C16.68 18.2596 14.561 19.9196 12.28 21.3496L12.03 21.5006L11.77 21.3396C9.48102 19.9196 7.35002 18.2596 5.40102 16.3796C4.06102 15.0306 3.03002 13.3896 2.39002 11.5806C1.26002 8.04065 2.59002 3.99065 6.32102 2.76965C6.61102 2.66965 6.91002 2.59965 7.21002 2.56065H7.33002C7.61102 2.51965 7.89002 2.50065 8.17002 2.50065H8.28002C8.91002 2.51965 9.52002 2.62965 10.111 2.83065H10.17C10.21 2.84965 10.24 2.87065 10.26 2.88965C10.481 2.96065 10.69 3.04065 10.89 3.15065L11.27 3.32065C11.3618 3.36962 11.4649 3.44445 11.554 3.50912C11.6104 3.55009 11.6612 3.58699 11.7 3.61065C11.7163 3.62028 11.7329 3.62996 11.7496 3.63972C11.8354 3.68977 11.9247 3.74191 12 3.79965C13.111 2.95065 14.46 2.49065 15.85 2.50065ZM18.51 9.70065C18.92 9.68965 19.27 9.36065 19.3 8.93965V8.82065C19.33 7.41965 18.481 6.15065 17.19 5.66065C16.78 5.51965 16.33 5.74065 16.18 6.16065C16.04 6.58065 16.26 7.04065 16.68 7.18965C17.321 7.42965 17.75 8.06065 17.75 8.75965V8.79065C17.731 9.01965 17.8 9.24065 17.94 9.41065C18.08 9.58065 18.29 9.67965 18.51 9.70065Z"
                    fill="currentColor"></path>
                </svg>
              </span>
              By
              <a href="#" target="_parent">Luci</a>.
            </h6>
          </div>
        </footer> -->