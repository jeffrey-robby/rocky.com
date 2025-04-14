<div class="card">
      <div class="card-header d-flex justify-content-between">
        <div class="header-title">
          <!-- <h4 class="card-title">Liste Des Produits</h4> -->
        </div>
      </div>
      <div class="card-body">
        <ul class="nav nav-tabs justify-content-end" id="myTab-4" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab-end" data-bs-toggle="tab" href="#home-end" role="tab"
              aria-selected="true">Grille</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab-end" data-bs-toggle="tab" href="#profile-end" role="tab"
              aria-selected="false">Tableau</a>
          </li>
          
        </ul>
        <div class="tab-content" id="myTabContent-5">
          <div class="tab-pane fade show active" id="home-end" role="tabpanel" aria-labelledby="home-tab-end">
          <div class="card rounded-3">          
            <div class="p-5 row gy-5" style="overflow: auto;">               
                <?php 
                    $request = mysqli_query($database, "
                                    SELECT 
                                    produits.id_produits,
                                    produits.id_fournisseurs, 
                                    fournisseurs.nom_fournisseurs, 
                                    fournisseurs.tel_fournisseurs, 
                                    produits.id_categorie_produits, 
                                    categorie_produits.nom_categorie_produits, 
                                    produits.nom_produits, 
                                    produits.unite_produits,
                                    produits.prix_produits, 
                                    produits.prix_produits1,
                                    produits.photo_produits1, 
                                    produits.description_produits, 
                                    quantite_en_stocks.quantite_quantite_en_stocks,
                                    quantite_en_stocks.seuil_quantite_en_stocks,
                                    stocks.nom_stocks 
                                FROM 
                                    produits 
                                JOIN 
                                    fournisseurs ON produits.id_fournisseurs = fournisseurs.id_fournisseurs 
                                JOIN 
                                    categorie_produits ON produits.id_categorie_produits = categorie_produits.id_categorie_produits 
                                JOIN 
                                    quantite_en_stocks ON produits.id_produits = quantite_en_stocks.id_produits 
                                JOIN 
                                    stocks ON quantite_en_stocks.id_stocks = stocks.id_stocks
                                ORDER BY produits.nom_produits
                                ");
                    while ($result = mysqli_fetch_assoc($request)) {
                        echo '
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class=" browse-bookcontent">
                                    <div class=" p-0">
                                <div class="d-flex align-items-center">
                                    <div class="col-6  position-relative p-0 img-shadow ">
                                        <a href="javascript:void();" tabindex="-1" class="">
                                            <img src="'.$result['photo_produits1'].'" class="img-fluid rounded w-100" alt="" />
                                        </a>
                                        <div class="view-book">
                                            <a href="shop/book-page.php?product='.$result['id_produits'].'" class="btn view-book-btn">Afficher</a>
                                        </div>
                                    </div>
                                    <div class="col-6 px-3">
                                        <h4 class="mb-1 line-clip-2">'.$result['nom_produits'].'
                                            World</h4>
                                        <a class=" mb-1 line-clip-1" onclick="alert(\'Contact du fournisseur: '.$result['tel_fournisseurs'].' \')">'.$result['nom_fournisseurs'].'</a>


                                        <div class="d-block line-height font-size-19">
                                            <span class=" text-warning">
                                                <i class="ph-fill ph-star"></i>
                                                <i class="ph-fill ph-star"></i>
                                                <i class="ph-fill ph-star"></i>
                                                <i class="ph-fill ph-star"></i>
                                                <i class="ph-fill ph-star"></i>
                                            </span>
                                        </div>
                                        <div class="price d-flex align-items-center mb-2">
                                            <span class="pe-1 "><del>'.$result['prix_produits'].'</del></span>
                                            <h6 class="mb-0"><b>$'.$result['prix_produits1'].'</b></h6>
                                        </div>
                                        <div class="iq-product-action">
                                            <a href="javascript:void();" class="btn btn-small-icon fs-1 cart-btn bg-primary-subtle">
                                                <i class=" ri-shopping-cart-2-fill text-primary fs-5"></i></a>
                                            
                                        </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>  
                        ';
                        # code...
                    }
                ?>                                
            </div>
        </div>

        
          </div>
          <div class="tab-pane fade" id="profile-end" role="tabpanel" aria-labelledby="profile-tab-end">
          <div class="table-responsive custom-table-search">
               <table id="input-datatable" class="table" data-toggle="data-table-column-filter">
                  <thead>
                     <tr>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Prix2</th>
                        <th>Quantité En stock</th>
                        <th>Description</th>
                        <th>Fournisseur</th>
                        <th>Contact</th>
                     </tr>
                  </thead>
                  <tbody>
                    <?php 
                     $request = mysqli_query($database, "
                                SELECT 
                                produits.id_produits,
                                produits.id_fournisseurs, 
                                fournisseurs.nom_fournisseurs, 
                                fournisseurs.tel_fournisseurs, 
                                produits.id_categorie_produits, 
                                categorie_produits.nom_categorie_produits, 
                                produits.nom_produits, 
                                produits.unite_produits,
                                produits.prix_produits, 
                                produits.prix_produits1,
                                produits.photo_produits1, 
                                produits.description_produits, 
                                quantite_en_stocks.quantite_quantite_en_stocks,
                                quantite_en_stocks.seuil_quantite_en_stocks,
                                stocks.nom_stocks 
                            FROM 
                                produits 
                            JOIN 
                                fournisseurs ON produits.id_fournisseurs = fournisseurs.id_fournisseurs 
                            JOIN 
                                categorie_produits ON produits.id_categorie_produits = categorie_produits.id_categorie_produits 
                            JOIN 
                                quantite_en_stocks ON produits.id_produits = quantite_en_stocks.id_produits 
                            JOIN 
                                stocks ON quantite_en_stocks.id_stocks = stocks.id_stocks
                            ORDER BY produits.nom_produits
                            ");
                    while ($result2 = mysqli_fetch_assoc($request)) {
                        echo'
                        <tr>
                            <td>'.$result2['nom_produits'].'</td>
                            <td>'.$result2['prix_produits'].'</td>
                            <td>'.$result2['prix_produits1'].'</td>
                            ';

                            if ($result2['quantite_quantite_en_stocks'] <= $result2['seuil_quantite_en_stocks']) {
                                echo '
                                <td style="background: rgb(249 186 186 / 93%)">'.$result2['quantite_quantite_en_stocks'].'</td>
                                ';
                                # code...
                            }else {
                                echo '
                                <td>'.$result2['quantite_quantite_en_stocks'].'</td>
                                ';
                            }
                           echo '
                            <td>'.$result2['description_produits'].'</td>
                            <td>'.$result2['nom_fournisseurs'].'</td>
                            <td>'.$result2['tel_fournisseurs'].'</td>
                        </tr>
                        ';
                        # code...
                    }
                    ?>
                     
                     
                  </tbody>
                  <tfoot>
                     <tr>
                        <th title="Nom">Nom</th>
                        <th title="Prix">Prix</th>
                        <th title="Prix2">Prix2</th>
                        <td title="Quantité En stock">Quantité En stock</td>
                        <th title="Description">Description</th>
                        <th title="Fournisseur">Fournisseur</th>
                        <th title="Contact">Contact</th>
                     </tr>
                  </tfoot>
               </table>
            </div>
          </div>
          
        </div>
      </div>
    </div>
        