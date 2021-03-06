
    <!DOCTYPE html>
    <html lang="en" class="loading">
    <!-- BEGIN : Head-->
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta name="description" content="Apex admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
      <meta name="keywords" content="admin template, Apex admin template, dashboard template, flat admin template, responsive admin template, web app">
      <meta name="author" content="PIXINVENT">
      <title>Login ScienceMeet</title>
      <link rel="apple-touch-icon" sizes="60x60" href="app-assets/img/ico/apple-icon-60.png">
      <link rel="apple-touch-icon" sizes="76x76" href="app-assets/img/ico/apple-icon-76.png">
      <link rel="apple-touch-icon" sizes="120x120" href="app-assets/img/ico/apple-icon-120.png">
      <link rel="apple-touch-icon" sizes="152x152" href="app-assets/img/ico/apple-icon-152.png">
      <link rel="shortcut icon" type="image/x-icon" href="app-assets/img/ico/favicon.ico">
      <link rel="shortcut icon" type="image/png" href="app-assets/img/ico/favicon-32.png">
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="apple-touch-fullscreen" content="yes">
      <meta name="apple-mobile-web-app-status-bar-style" content="default">
      <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
      <!-- BEGIN VENDOR CSS-->
      <!-- font icons-->
      <link rel="stylesheet" type="text/css" href="app-assets/fonts/feather/style.min.css">
      <link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.css">
      <link rel="stylesheet" type="text/css" href="app-assets/fonts/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/perfect-scrollbar.min.css">
      <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/prism.min.css">
      <!-- END VENDOR CSS-->
      <!-- BEGIN APEX CSS-->
      <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
      <!-- END APEX CSS-->
      <!-- BEGIN Page Level CSS-->
      <!-- END Page Level CSS-->
           <!-- ////////////////////////////////////////////////////////////////////////////-->

      <!-- BEGIN VENDOR JS-->
      <script src="app-assets/vendors/js/core/jquery-3.2.1.min.js" type="text/javascript"></script>
      <script src="app-assets/vendors/js/core/popper.min.js" type="text/javascript"></script>
      <script src="app-assets/vendors/js/core/bootstrap.min.js" type="text/javascript"></script>
      <script src="app-assets/vendors/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
      <script src="app-assets/vendors/js/prism.min.js" type="text/javascript"></script>
      <script src="app-assets/vendors/js/jquery.matchHeight-min.js" type="text/javascript"></script>
      <script src="app-assets/vendors/js/screenfull.min.js" type="text/javascript"></script>
      <script src="app-assets/vendors/js/pace/pace.min.js" type="text/javascript"></script>
      <!-- BEGIN VENDOR JS-->
      <!-- BEGIN PAGE VENDOR JS-->
      <!-- END PAGE VENDOR JS-->
      <!-- BEGIN APEX JS-->
      <script src="app-assets/js/app-sidebar.js" type="text/javascript"></script>
      <script src="app-assets/js/notification-sidebar.js" type="text/javascript"></script>
      <script src="app-assets/js/customizer.js" type="text/javascript"></script>
      <!-- END APEX JS-->
      <!-- BEGIN PAGE LEVEL JS-->
      <!-- END PAGE LEVEL JS-->
      <?php
include "view/connect.php";


if (isset($_POST['login'])) {
  $user_name = $_POST['user_name'];
  $pass_word = $_POST['pass_word'];
  if ($user_name != '' && $pass_word != '') {
    $select_user = "SELECT user_id , user_title, user_fname, user_lname, user_program,type_id FROM user WHERE user_name = '$user_name' && user_password = '$pass_word'";
    $query_user = mysqli_query($conn,$select_user);
    if (mysqli_num_rows($query_user) != '0') {      
      $res_user = mysqli_fetch_array($query_user);
    //   echo "<br>";
    // print_r($res_user);
      // echo $res_user['type_id'];
      $_SESSION['user_id'] = $res_user['user_id'];
      $_SESSION['user_title'] = $res_user['user_title'];
      $_SESSION['user_fname'] = $res_user['user_fname'];
      $_SESSION['user_lname'] = $res_user['user_lname'];
      $_SESSION['user_program'] = $res_user['user_program'];
      $_SESSION['type_id'] = $res_user['type_id'];

      // echo $_SESSION['type_id'];
    
    echo '<script>window.location.href="index.php";</script>';
        }

      }
    }
    ?>
    </head>
    <!-- END : Head-->

    <!-- BEGIN : Body-->
    <body data-col="1-column" class=" 1-column  blank-page">
      <!-- ////////////////////////////////////////////////////////////////////////////-->
      <div class="wrapper">
        <div class="main-panel">
          <!-- BEGIN : Main Content-->
          <div class="main-content">
            <div class="content-wrapper"><!--Login Page Starts-->
              <section id="login">
                <div class="container-fluid">
                  <div class="row full-height-vh m-0">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                      <div class="card">
                        <div class="card-content">
                          <div class="card-body login-img">
                            <div class="row m-0">
                              <div class="col-lg-6 d-lg-block d-none py-2 text-center align-middle">
                                <img src="app-assets/img/gallery/logo1.png" alt="" class="img-fluid mt-5" width="400" height="230">
                              </div>

                              <div class="col-lg-6 col-md-12 bg-white px-4 pt-3">
                                <h4 class="mb-2 card-title">เข้าสู่ระบบ</h4>
                                <form action="" method="POST" >

                                  <input type="text" name="user_name" class="form-control mb-3" placeholder="Username" />
                                  <input type="password" name="pass_word" class="form-control mb-1" placeholder="Password" />
                                  <div class="d-flex justify-content-between mt-2">


                                  </div>
                                  <div class="fg-actions d-flex justify-content-between">
                                    <div class="login-btn">
                                    </div>
                                    <div class="recover-pass">
                                      <button name="login" class="btn btn-primary text-decoration-none text-black" style="font-family: kanit; color:black ">เข้าสู่ระบบ</button>
                                    </div>
                                  </div>
                                </form>
                                <hr class="m-0">
                                <div class="d-flex justify-content-between mt-3">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <!--Login Page Ends-->

            </div>
          </div>
          <!-- END : End Main Content-->
        </div>
      </div>
 
    </body>
    <!-- END : Body-->
    </html>

