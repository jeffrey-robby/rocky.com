
<?php require './LogSettings.php';

?>
<!doctype html>
<html lang="en" data-bs-theme="light" class="theme-fs-sm" dir="ltr">


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title data-setting="app_name" data-rightJoin=" Librairy Management Dashboard">Rocky: sign-in</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="../assets/images/logo-mini.png" />
  
  <!-- Library / Plugin Css Build -->
  <link rel="stylesheet" href="../assets/css/core/libs.min.css" />
  
  <!-- flaticon css -->
  <link rel="stylesheet" href="../assets/vendor/flaticon/css/flaticon.css" />
  
  <!-- font-awesome css -->
  <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css" />
  
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
  

  <?php require_once '../ressources/ThemeScript.html' 
  ?>
</head>

<body class=" ">
  <!-- loader Start -->
  <?php require_once '../view/loader.php' 
  ?>
  <!-- loader END -->
  <div class="wrapper">

<div class="login-content">
  <div class="container">
    
    <div class="row d-flex align-items-center justify-content-center vh-100 w-100 m-0">
      <div class="col-lg-5 col-md-12 align-self-center bg-primary py-3">
      <div id="getToastrOptions">
      <!-- Notification area -->
      </div>
        <div class="card p-0 mb-0">
          <div class="card-body auth-card">
            <div class="logo-img">
              <a href="../index-2.html" class="navbar-brand d-flex align-items-center mb-2 justify-content-center">
                <!--Logo start-->
                <div class="logo-main auth-logo">
                
                    <img class="logo-normal  "
                        src="../assets/images/logo.png" height="30" alt="logo">
                    <img class="logo-color  "
                        src="../assets/images/logo-white.png" height="30" alt="logo">
                    <img class="logo-mini "
                        src="../assets/images/logo-mini.png" alt="logo">
                    <img class="logo-mini-white "
                        src="../assets/images/logo-mini-white.png" alt="logo">
                
                </div>
                <!--logo End-->              </a>
            </div>
            <h1 class="text-primary reset-pw fw-900 d-flex ms-3 justify-content-center">Sign In</h1>
            <p class="text-center mb-4 auth-desc">Enter your email address and password to access admin
              panel.</p>
            <form method="post" id="SingIn">
              <div class="custom-form-field">
                <label>Username Or Email Address&nbsp; <span>*</span>
                </label>
                <input type="text" name="user_name" class="form-control mb-5 mt-2" required>
              </div>
              <div class="custom-form-field">
                <label>Password&nbsp; <span>*</span>
                </label>
                <input type="password" name="pwd" class="form-control mb-5 mt-2" required>
              </div>
              <div class="d-flex align-items-center justify-content-between mb-5">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember" checked>
                  <label class="form-check-label" for="remember">
                    Remember Me
                  </label>
                </div>
                <a href="recoverpw.html" class="forgot-pwd">Forgot Password?</a>
              </div>
              <button type="submit" class="btn btn-primary w-100">
                <span class="btn-inner d-flex align-items-center justify-content-center gap-2">
                  <span class="text d-inline-block align-middle width-full">Sign In</span>
                  <i class="ph ph-plus custom-ph-icons"></i>
                </span>
                </span>
              </button>
            </form>
            <div class="auth-signup mt-5">
              <p class="d-flex justify-content-center mb-0">Don't Have An Account Yet?<a href="sign-up.html"
                  class="ms-2">Sign
                  Up.</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  </div>
  <!-- Live Customizer start -->
  <!-- Setting offcanvas start here -->
  <?php include '../ressources/ThemeSettings.html' 
  ?>

  

  <!-- Library Bundle Script -->
  <script src="../assets/js/core/libs.min.js"></script>
  <!-- Plugin Scripts -->
  
  
  <!-- Slider-tab Script -->
  <script src="../assets/js/plugins/slider-tabs.js"></script>
  
  
  
  
  
  
  
  
  
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
  
  
  
  
  
  
  
  
  
  <!-- All charts Script -->
  
  
  
  
  
  <script src="../assets/js/vertical_slider.js" defer></script>
  
  
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
  <script src="../ressources/RessourceJs.jsx"></script>
  <script src="./Sign_in.jsx"></script>
  <!--Custom js -->
</body>


</html>