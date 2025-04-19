<?php 
require_once '../ressources/Config.php' ;
if (isset($_GET['Stock'])) {
    $id_stocks = $_GET['Stock'];
    $request = mysqli_query($database, "SELECT * FROM stocks WHERE id_stocks = '$id_stocks'");
    $result = mysqli_fetch_assoc($request);
    $nom_stocks = $result['nom_stocks'];
    if (isset($_POST['appro'])) {
        foreach ($_POST as $idproduits => $quantite) {
            // Vérifiez que la clé est un ID produit valide (par exemple, exclure le bouton "appro")
            if (is_numeric($idproduits) && !empty($quantite)) {
                // Exécutez la requête pour mettre à jour la quantité
                $request = mysqli_query($database, "
                    UPDATE quantite_en_stocks
                    SET quantite_quantite_en_stocks = quantite_quantite_en_stocks + $quantite
                    WHERE id_produits = $idproduits AND id_stocks = $id_stocks
                ");
            }
        }
    }
}else {
    header('Location: ../index.php');
    exit();
}
?>
<!doctype html>
<html lang="en" class="theme-fs-sm" data-bs-theme-color="default" dir="ltr">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title data-setting="app_name" data-rightJoin=" Book store management system"></title>

    <?php require_once '../ressources/ThemeScript.html' ?>


    <meta name="setting_options" content='{&quot;saveLocal&quot;:&quot;sessionStorage&quot;,&quot;storeKey&quot;:&quot;booksto&quot;,&quot;setting&quot;:{&quot;app_name&quot;:{&quot;value&quot;:&quot;booksto&quot;},&quot;theme_scheme_direction&quot;:{&quot;value&quot;:&quot;ltr&quot;},&quot;theme_scheme&quot;:{&quot;value&quot;:&quot;light&quot;},&quot;theme_color&quot;:{&quot;colors&quot;:{},&quot;value&quot;:&quot;default&quot;},&quot;theme_font_size&quot;:{&quot;value&quot;:&quot;theme-fs-md&quot;},&quot;page_layout&quot;:{&quot;value&quot;:&quot;container-fluid&quot;},&quot;sidebar_color&quot;:{&quot;value&quot;:&quot;sidebar-white&quot;},&quot;sidebar_type&quot;:{&quot;value&quot;:[]},&quot;sidebar_menu_style&quot;:{&quot;value&quot;:&quot;text-hover&quot;},&quot;theme_style_appearance&quot;:{&quot;value&quot;:{&quot;0&quot;:&quot;theme-default&quot;}},&quot;theme_transition&quot;:{&quot;value&quot;:&quot;theme-with-animation&quot;},&quot;header_navbar&quot;:{&quot;value&quot;:&quot;default&quot;},&quot;header_banner&quot;:{&quot;value&quot;:&quot;default&quot;},&quot;card_color&quot;:{&quot;value&quot;:&quot;card-default&quot;},&quot;footer&quot;:{&quot;value&quot;:&quot;default&quot;},&quot;body_font_family&quot;:{&quot;value&quot;:null},&quot;heading_font_family&quot;:{&quot;value&quot;:null}}}'>
    <!-- Google Font Api KEY-->
    <meta name="google_font_api" content="AIzaSyBG58yNdAjc20_8jAvLNSVi9E4Xhwjau_k">
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/logo-mini.png" />
    
    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="../assets/css/core/libs.min.css" />
    
    <!-- flaticon css -->
    <link rel="stylesheet" href="../assets/vendor/flaticon/css/flaticon.css" />
    
    <!-- font-awesome css -->
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css" />
    
    
    
    <!-- SwiperSlider css -->
    <link rel="stylesheet" href="../assets/vendor/swiperSlider/swiper.min.css">
    
    
    
    
    
    <!-- Sweetlaert2 css -->
    <link rel="stylesheet" href="../assets/vendor/sweetalert2/dist/sweetalert2.min.css">
    
    
    <!-- booksto Design System Css -->
    <link rel="stylesheet" href="../assets/css/booksto.min5438.css?v=1.2.0" />
    
    <!-- Custom Css -->
    <link rel="stylesheet" href="../assets/css/custom.min5438.css?v=1.2.0" />
    
    <!-- RTL Css -->
    <link rel="stylesheet" href="../assets/css/rtl.min5438.css?v=1.2.0" />
    
    <!-- Customizer Css -->
    <link rel="stylesheet" href="../assets/css/customizer.min5438.css?v=1.2.0" />
    
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet">
    
    
    <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css" />
    
    <link rel="stylesheet" href="../assets/vendor/dripicons/webfont/webfont.css" />
    
    <link rel="stylesheet" href="../assets/vendor/ionicons/css/ionicons.min.css" />
    
    <link rel="stylesheet" href="../assets/vendor/line-awesome/css/line-awesome.min.css" />
    
    <!-- Phosphor icons  -->
    <link rel="stylesheet" href="../assets/vendor/phosphor-icons/Fonts/regular/style.css"></link>
    <link rel="stylesheet" href="../assets/vendor/phosphor-icons/Fonts/duotone/style.css"></link>
    <link rel="stylesheet" href="../assets/vendor/phosphor-icons/Fonts/fill/style.css"></link>
    
</head>

<body class="  ">
     <!-- loader Start -->
     <?php include '../view/loader.php' ?>
    <!-- loader END -->

    <?php require '../view/Aside.php' ?>    

    <main class="main-content">
        <div class="position-sticky top-0 z-3">
            <!--Nav Start-->
            <?php include '../view/Nav.php' ?>
            <!--Nav End-->
        </div>
        <div class="content-inner container-fluid pb-0" id="page_layout"> 
        <div class="card">
                <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Approvisionnement : <?php echo $nom_stocks ?></h4>
                     </div>
                  </div>
                  <div class="card-body">
                    <form action="" method="post">
                    <button type="submit" name="appro" class="btn btn-primary">Enregistrer</button>

                        <div class="table-responsive custom-table-search">
                            <table id="input-datatable" class="table" data-toggle="data-table-column-filter">
                                <thead>
                                    <tr>
                                    <th>Nom</th>                    
                                    <th>Quantité En stock</th>
                                    <th>Approvisionner</th>
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
                                        WHERE
                                            stocks.id_stocks = '$id_stocks'
                                        ORDER BY produits.nom_produits
                                        ");
                                while ($result2 = mysqli_fetch_assoc($request)) {
                                    echo'
                                    <tr>
                                        <td>'.$result2['nom_produits'].'</td>
                                        
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
                                        <td><input type="number" name="'.$result2['id_produits'].'" id=""></td>
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
                                    <td title="Quantité En stock">Quantité En stock</td>
                                    <th title="Approvisionner">Approvisionner</th>
                                    <th title="Description">Description</th>
                                    <th title="Fournisseur">Fournisseur</th>
                                    <th title="Contact">Contact</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </form>
                    
                  </div>
               </div>
       
  
        <div>
                
        <!-- Footer Section Start -->
        <?php include '../view/Footer.php' ?>
        <!-- Footer Section End -->  
    </main>
   <!-- Live Customizer start -->
   <?php include '../ressources/ThemeSettings.html' ?>
    <!-- Live Customizer end -->
    <!-- Wrapper End-->


    <!-- Library Bundle Script -->
    <script src="../assets/js/core/libs.min.js"></script>
    <!-- Plugin Scripts -->
    
    
    <!-- Slider-tab Script -->
    <script src="../assets/js/plugins/slider-tabs.js"></script>
    
    
    <!-- Sweet-alert Script -->
    <script src="../assets/vendor/sweetalert2/dist/sweetalert2.min.js" async></script>
    <script src="../assets/js/plugins/sweet-alert.js" defer></script>
    
    
    
    
    
    <!-- SwiperSlider Script -->
    <script src="../assets/vendor/swiperSlider/swiper.min.js"></script>
    
    
    <!-- Lodash Utility -->
    <script src="../assets/vendor/lodash/lodash.min.js"></script>
    <!-- Utilities Functions -->
    <script src="../assets/js/iqonic-script/utility.min.js"></script>
    <!-- Settings Script -->
    <script src="../assets/js/iqonic-script/setting.min.js"></script>
    <!-- Settings Init Script -->
    <script src="../assets/js/setting-init.js"></script>
    <!-- External Library Bundle Script -->
    <script src="../assets/js/core/external.min.js"></script>
    <!-- Dashboard Script -->
    <script src="../assets/js/Charts/dashboard.js" defer></script>
    
    
    <!-- All Plugins Script -->
    
    
    
    
    
    <!-- Sweet-alert Script -->
    <script src="../assets/vendor/sweetalert2/dist/sweetalert2.min.js" async></script>
    <script src="../assets/js/plugins/sweet-alert.js" defer></script>
    
    
    <!-- All charts Script -->
    
    
    
    
    <script src="../assets/js/vertical_slider.js" defer></script>
    
    <script src="../assets/js/slider5438.js?v=1.2.0" defer></script>
    
    <!-- Hopeui Script -->
    <script src="../assets/js/booksto5438.js?v=1.2.0" defer></script>
    <script src="../assets/js/booksto-advance5438.js?v=1.2.0" defer></script>
    
    <script src="../assets/js/sidebar5438.js?v=1.2.0" defer></script>
    
    
    <script src="../assets/js/plugins/select2.js" defer></script>
    <script src="../assets/js/Setting/enchanter.js" defer></script>
    
    
    <!--morris chart -->
    <script src="../../../../cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
    <script src="../../../../cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    
    
    
    <!--highcharts chart -->
    <script src="../../../../code.highcharts.com/highcharts.html"></script>
    <script src="../../../../code.highcharts.com/highcharts-more.html"></script>
    <script src="../../../../code.highcharts.com/modules/exporting.html"></script>
    
    
    
    <!--Am chart -->
    <script src="../../../../cdn.amcharts.com/lib/4/core.js"></script>
    <script src="../../../../cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="../../../../cdn.amcharts.com/lib/4/themes/animated.js"></script>
    
    <!--Widget Chart -->
    
    
    <!--Custom js -->
    <script>
        $(document).ready(function () {
            if ($.fn.DataTable.isDataTable('#input-datatable')) {
                $('#input-datatable').DataTable().destroy();
            }
            $('#input-datatable').DataTable({
                paging: false, // Désactive la pagination
                searching: true, // Garde la recherche active
                ordering: true, // Garde le tri actif
            });
        });
    </script>
</body>


<!-- Mirrored from templates.iqonic.design/booksto-dist/html/shop/category-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Apr 2025 12:20:36 GMT -->
</html>