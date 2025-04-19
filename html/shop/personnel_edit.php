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
   <div class="col-lg-12">
      <div class="card mx-0 mx-md-3">
         <div class="card-body p-0">
            <div class="">
               <ul class="iq-edit-profile row nav nav-pills mb-0">
                  <li class="col-md-3 p-0 text-center">
                     <a class="nav-link active p-4 text-secondary" data-bs-toggle="pill" href="#personal-information">
                        Modifier les Informations Personnelles : 
                     </a>
                  </li> <!-- <li class="col-md-3 p-0 text-center">
                     <a class="nav-link p-4 text-secondary" data-bs-toggle="pill" href="#chang-pwd">
                        Change Password
                     </a>
                  </li>
                  <li class="col-md-3 p-0 text-center">
                     <a class="nav-link p-4 text-secondary" data-bs-toggle="pill" href="#emailandsms">
                        Email and SMS
                     </a>
                  </li>
                  <li class="col-md-3 p-0 text-center">
                     <a class="nav-link p-4 text-secondary" data-bs-toggle="pill" href="#manage-contact">
                        Manage Contact
                     </a>
                  </li>
                  -->
               </ul>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-12">
      <div class="iq-edit-list-data">
         <div class="tab-content">
            <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Personal Information: <?php echo $nom."-".$prenom ?></h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <form>
                        <div class="form-group row align-items-center">
                           <div class="col-md-12">
                              <div class="profile-img-edit1">
                                 <img class="profile-pic1" src="../<?php echo $image_personnels ?>" alt="profile-pic"
                                    loading="lazy">
                                 <div class="p-image1 d-flex align-items-center justify-content-center">
                                    <i class="ri-pencil-line upload-button1"></i>
                                    <input class="file-upload1" type="file" accept="image/*" />
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class=" row align-items-center">
                           <div class="form-group col-sm-6">
                              <label for="nom" class="form-label">Nom:</label>
                              <input type="text" class="form-control"  id="nom" name="nom" placeholder="<?php echo $nom?>"
                                 style="height: 45px;">
                           </div>
                           <div class="form-group col-sm-6">
                              <label for="prenom" class="form-label">Prenom:</label>
                              <input type="text" class="form-control" id="prenom" name="prenom" placeholder="<?php echo $prenom?>">
                           </div>
                           <div class="form-group col-sm-6">
                              <label for="date_" class="form-label">Date de Naissance:</label>
                              <input type="date" class="form-control" id="date_" name="dateN" value="<?php echo $dateN?>">
                           </div>
                           <div class="form-group col-sm-6">
                              <label for="adresse" class="form-label">Adresse:</label>
                              <input type="text" class="form-control" id="adresse" name="adresse" placeholder="<?php echo $residence_personnels?>">
                           </div>
                           <div class="form-group col-sm-6">
                              <label class="form-label d-block">Sexe:</label>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="sexe"
                                    id="inlineRadio10" value="Masculin" checked="">
                                 <label class="form-check-label" for="inlineRadio10"> Masculin</label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="sexe"
                                    id="inlineRadio11" value="Feminin">
                                 <label class="form-check-label" for="inlineRadio11">Feminin</label>
                              </div>
                           </div>
                           <div class="form-group col-sm-6">
                              <label for="poste" class="form-label">Poste:</label>
                              <input class="form-control" id="poste" name="poste" placeholder="<?php echo $poste_personnels?>">
                           </div>
                           <div class="form-group col-sm-6">
                              <label for="tel_personnels" class="form-label">Telephone:</label>
                              <input class="form-control" id="tel_personnels" name="tel_personnels" placeholder="<?php echo $tel_personnels?>">
                           </div>
                           
                           <!-- <div class="form-group col-sm-6">
                              <label class="form-label">Marital Status:</label>
                              <select class="form-select" aria-label="Default select example">
                                 <option selected="">Single</option>
                                 <option>Married</option>
                                 <option>Widowed</option>
                                 <option>Divorced</option>
                                 <option>Separated </option>
                              </select>
                           </div>
                           <div class="form-group col-sm-6">
                              <label class="form-label">Age:</label>
                              <select class="form-select" aria-label="Default select example 2">
                                 <option>12-18</option>
                                 <option>19-32</option>
                                 <option selected="">33-45</option>
                                 <option>46-62</option>
                                 <option>63 &gt; </option>
                              </select>
                           </div>
                           <div class="form-group col-sm-6">
                              <label class="form-label">Country:</label>
                              <select class="form-select" aria-label="Default select example 3">
                                 <option>Caneda</option>
                                 <option>Noida</option>
                                 <option selected="">USA</option>
                                 <option>India</option>
                                 <option>Africa</option>
                              </select>
                           </div>
                           <div class="form-group col-sm-6">
                              <label class="form-label">State:</label>
                              <select class="form-select" aria-label="Default select example 4">
                                 <option>California</option>
                                 <option>Florida</option>
                                 <option selected="">Georgia</option>
                                 <option>Connecticut</option>
                                 <option>Louisiana</option>
                              </select>
                           </div> -->
                           <div class="form-group col-sm-12">
                              <label class="form-label">Address:</label>
                              <textarea class="form-control" name="address" rows="5" style="line-height: 22px;">
37 Cardinal Lane
Petersburg, VA 23803
United States of America
Zip Code: 85001
                                 </textarea>
                           </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-danger-subtle">Cancel</button>
                     </form>
                  </div>
               </div>
            </div>
            <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="iq-header-title">
                        <h4 class="card-title">Change Password</h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <form>
                        <div class="form-group">
                           <label for="cpass" class="form-label">Current Password:</label>
                           <a href="https://templates.iqonic.design/auth/recoverpw.html" class="float-end">Forgot Password</a>
                           <input type="Password" class="form-control" id="cpass" value="">
                        </div>
                        <div class="form-group">
                           <label for="npass" class="form-label">New Password:</label>
                           <input type="Password" class="form-control" id="npass" value="">
                        </div>
                        <div class="form-group">
                           <label for="vpass" class="form-label">Verify Password:</label>
                           <input type="Password" class="form-control" id="vpass" value="">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-danger-subtle">Cancel</button>
                     </form>
                  </div>
               </div>
            </div>
            <div class="tab-pane fade" id="emailandsms" role="tabpanel">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Email and SMS</h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <form>
                        <div class="form-group row align-items-center">
                           <label class="col-md-3" for="emailnotification">Email Notification:</label>
                           <div class="col-md-9 form-check form-switch cust-margin">
                              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked11" checked>
                              <label class="form-check-label" for="flexSwitchCheckChecked11">Checked switch checkbox
                                 input</label>
                           </div>
                        </div>
                        <div class="form-group row align-items-center">
                           <label class="col-md-3" for="smsnotification">SMS Notification:</label>
                           <div class="col-md-9 form-check form-switch cust-margin">
                              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked12" checked>
                              <label class="form-check-label" for="flexSwitchCheckChecked12">Checked switch checkbox
                                 input</label>
                           </div>
                        </div>
                        <div class="form-group row align-items-center">
                           <label class="col-md-3" for="npass">When To Email</label>
                           <div class="col-md-9">
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault12">
                                 <label class="form-check-label" for="flexCheckDefault12">
                                    You have new notifications.
                                 </label>
                              </div>
                              <div class="form-check d-block">
                                 <input class="form-check-input" type="checkbox" value="" id="email02">
                                 <label class="form-check-label" for="email02">You're sent a direct message</label>
                              </div>
                              <div class="form-check d-block">
                                 <input type="checkbox" class="form-check-input" id="email03" checked="">
                                 <label class="form-check-label" for="email03">Someone adds you as a connection</label>
                              </div>
                           </div>
                        </div>
                        <div class="form-group row align-items-center">
                           <label class="col-md-3" for="npass">When To Escalate Emails</label>
                           <div class="col-md-9">
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" value="" id="email04">
                                 <label class="form-check-label" for="email04">
                                    Upon new order.
                                 </label>
                              </div>
                              <div class="form-check d-block">
                                 <input class="form-check-input" type="checkbox" value="" id="email05">
                                 <label class="form-check-label" for="email05">New membership approval</label>
                              </div>
                              <div class="form-check d-block">
                                 <input type="checkbox" class="form-check-input" id="email06" checked="">
                                 <label class="form-check-label" for="email06">Member registration</label>
                              </div>
                           </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-danger-subtle">Cancel</button>
                     </form>
                  </div>
               </div>
            </div>
            <div class="tab-pane fade" id="manage-contact" role="tabpanel">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Manage Contact</h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <form>
                        <div class="form-group">
                           <label for="cno" class="form-label">Contact Number:</label>
                           <input type="text" class="form-control" id="cno" value="001 2536 123 458">
                        </div>
                        <div class="form-group">
                           <label for="email" class="form-label">Email:</label>
                           <input type="text" class="form-control" id="email" value="Bnijone@demo.com">
                        </div>
                        <div class="form-group">
                           <label for="url" class="form-label">Url:</label>
                           <input type="text" class="form-control" id="url" value="https://getbootstrap.com/">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-danger-subtle">Cancel</button>
                     </form>
                  </div>
               </div>
            </div>
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