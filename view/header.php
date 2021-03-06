<!DOCTYPE html>
<html lang="en" class="loading">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Apex admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Apex admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>หน้าแรก</title>
    <link rel="apple-touch-icon" sizes="60x60" href="app-assets/img/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="app-assets/img/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="app-assets/img/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="app-assets/img/ico/apple-icon-152.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/img/ico/favicon.ico">
    <link rel="shortcut icon" type="image/png" href="app-assets/img/ico/favicon-32.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link
        href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900"
        rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="app-assets/fonts/feather/style.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" href="app-assets/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/prism.min.css">

    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    

    <style>
        body {
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>


<body data-col="2-columns" class=" 2-columns ">
    <div class="wrapper">
        <div data-active-color="white" data-background-color="purple-bliss"
            data-image="app-assets/img/sidebar-bg/07.jpg" class="app-sidebar">
            <div class="sidebar-header">
                <div class="logo clearfix">
                    <a href="index.php" class="logo-text float-left">
                        <div class="logo-img">
                            <img src="static/app-assets/img/logo015.png" width="60px" length="60px">
                            <span>Science</span>
                        </div><span class="text align-middle" style="font-family: 'Rubik', sans-serif;"></span>
                    </a>
                    <a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none"><i
                            class="ft-x"></i>
                    </a>
                </div>
            </div>
            <div class="sidebar-content">
                <div class="nav-container">
                    <ul id="main-menu-navigation" data-menu="menu-navigation" data-scroll-to-active="true"
                        class="navigation navigation-main">
                        
                    
                        <li class=" nav-item">
                            <a href="index.php"><i class="icon-home"></i><span data-i18n=""
                                    class="menu-title"><b>หน้าหลัก</b></span></a>
                        </li>
                        <?php  if($_SESSION['type_id']==1) {?>
                            <li class=" nav-item">
                            <a href="?page=Set_meeting"><i class="icon-settings"></i><span data-i18n=""
                                    class="menu-title"><b>ตั้งค่าการประชุม</b></span></a>
                        </li>
                        <?php } ?>
                        <?php  if($_SESSION['type_id']==2) {?>
                            <li class=" nav-item">
                            <a href="?page=Set_meeting"><i class="icon-heart"></i><span data-i18n=""
                                    class="menu-title"><b>การประชุมของฉัน</b></span></a>
                        </li>
                        <?php } ?>
                        <li class=" nav-item">
                            <a href="?page=search"><i class="icon-doc"></i><span data-i18n=""
                                    class="menu-title"><b>ค้นหาการประชุม</b></span></a>
                        </li>
                        <?php  if($_SESSION['type_id']==1) {?>

                        <li class=" nav-item">
                            <a href="?page=manage_members"><i class="icon-users"></i><span data-i18n=""
                                    class="menu-title"><b>จัดการสมาชิก</b></span></a>
                        </li>
                        <?php } ?>
                        <li class=" nav-item">
                            <a href="?logout"><i class="icon-logout"></i><span data-i18n=""
                                    class="menu-title"><b>ออกจากระบบ</b></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sidebar-background"></div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-faded header-navbar">

            <div class="container-fluid">


            </div>
        </nav>

        <div class="main-panel">

            <div class="main-content">
                <div class="content-wrapper">