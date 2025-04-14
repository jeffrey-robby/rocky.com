<?php require_once '../ressources/Config.php' 
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
                <div class="d-block text-center">
                    <h2 class="mb-3">Catégories Produits</h2>
                    <div class="d-flex flex-column flex-lg-row align-items-center gap-3 custom-search mb-lg-5 mx-0 mx-md-auto">                       
                        <div class="d-flex align-items-center w-50 search-bar-width mb-5 mb-lg-0 mx-md-auto">                           
                            <div class="d-block w-75">
                                <form action="" method="post">
                                        <div class="form-group input-group mb-0 search-input category-search-input">
                                            <span class="input-group-text  ps-3 pe-0 border-0">
                                                <i class="ph ph-magnifying-glass"></i>
                                            </span>
                                            <input type="text" class="form-control border-0" required placeholder="Ajouter une categorie...">

                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary search-data ms-2">Ajouter</button>
                                </form>                                
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                            <h4 class="card-title">Tabs Vertical Pills</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Stack your navigation by changing the flex item direction with
                            the
                            <code>.flex-column</code>
                            utility.
                            </p>
                            <div class="row">
                            <div class="col-sm-3">
                                <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="button"
                                aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home"
                                    role="tab" aria-selected="true">Home</a>
                                <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile"
                                    role="tab" aria-selected="false">Profile</a>
                                <a class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target=""="#v-pills-messages"
                                    role="tab" aria-selected="false">Messages</a>
                                <a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" href="#v-pills-settings" role="tab"
                                    aria-selected="false">Settings</a>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="tab-content mt-0" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                    aria-labelledby="v-pills-home-tab">
                                    <p>Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has been the
                                    industry's standard dummy text ever since the 1500s,
                                    when an unknown printer took a galley of type and
                                    scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into
                                    electronic typesetting, remaining essentially unchanged.</p>
                                </div>
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                    <p>Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has been the
                                    industry's standard dummy text ever since the 1500s,
                                    when an unknown printer took a galley of type and
                                    scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into
                                    electronic typesetting, remaining essentially unchanged.</p>
                                </div>
                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                    <p>Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has been the
                                    industry's standard dummy text ever since the 1500s,
                                    when an unknown printer took a galley of type and
                                    scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into
                                    electronic typesetting, remaining essentially unchanged.</p>
                                </div>
                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                    <p>Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has been the
                                    industry's standard dummy text ever since the 1500s,
                                    when an unknown printer took a galley of type and
                                    scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into
                                    electronic typesetting, remaining essentially unchanged.</p>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>                                
                    </div>
                
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