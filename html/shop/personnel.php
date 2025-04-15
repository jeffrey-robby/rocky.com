<?php 
require_once '../ressources/Config.php' 
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
            <div class="row">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Personnels</h4>
                     </div>
                  </div>
                  <div class="card-body">
                  <div class="custom-table-effect table-responsive custom-table-search user-table">
                        <table class=" mb-0 table table-bordered" id="datatable" data-toggle="data-table1">
                            <thead class="">
                                <tr class="bg-white">
                                    <th scope="col" class="border-bottom bg-primary text-white">Photo</th>
                                    <th scope="col" class="border-bottom bg-primary text-white">Nom </th>
                                    <th scope="col" class="border-bottom bg-primary text-white">Date Naissance</th>
                                    <th scope="col" class="border-bottom bg-primary text-white">Poste</th>
                                    <th scope="col" class="border-bottom bg-primary text-white">Conctact</th>
                                    <th scope="col" class="border-bottom bg-primary text-white">Email</th>
                                    <th scope="col" class="border-bottom bg-primary text-white">Sexe</th>
                                    <th scope="col" class="border-bottom bg-primary text-white">Adresse</th>
                                    <th scope="col" class="border-bottom bg-primary text-white">CNI</th>
                                    <th scope="col" class="border-bottom bg-primary text-white">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $request = mysqli_query($database, "SELECT * FROM personnels");
                                while ($result = mysqli_fetch_assoc($request)) {
                                    ?>
                                    <tr>
                                        <td><img src="../<?php echo $result['photo_verso_personnels'] ?>"
                                                class="rounded img-fluid avatar-40" alt=""></td>
                                        <td><?php echo $result['nom_personnels'].' '.$result['prenom_personnels'] ?></td>
                                        <td><?php echo $result['date_de_naissance_personnels'] ?></td>
                                        <td><?php echo $result['poste_personnels'] ?></td>
                                        <td><?php echo $result['tel_personnels'] ?></td>
                                        <td><?php echo $result['email_personnels'] ?></td>
                                        <td><?php echo $result['sexe_personnels'] ?></td>
                                        <td><?php echo $result['residence_personnels'] ?></td>
                                        <td><?php echo $result['numero_cni_personnels'] ?></td>
                                        <td>
                                            <div class="d-flex gap-2 align-items-center">
                                                <a class="btn btn-primary-subtle px-1 py-1 rounded d-flex"
                                                    data-toggle="tooltip" data-placement="top" title="Add"
                                                    href="user-add.html">
                                                    <i class="ph ph-user-plus"></i>
                                                </a>
                                                <a class="btn btn-warning-subtle px-1 py-1 rounded d-flex"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"
                                                    href="user-edit.html">
                                                    <i class="ph ph-pencil-simple"></i>
                                                </a>
                                                <a class="btn btn-danger-subtle px-1 py-1 rounded d-flex"
                                                    data-toggle="tooltip" data-placement="top" title="Delete" href="#">
                                                    <i class="ph ph-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <?php
                                    # code...
                                }
                                ?>
                                                               

                            </tbody>
                        </table>
                    </div>                    
                  </div>
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
</body>


<!-- Mirrored from templates.iqonic.design/booksto-dist/html/shop/category-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Apr 2025 12:20:36 GMT -->
</html>