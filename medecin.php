<?php
!isset($_SESSION) ? session_start() : header('Location: ../index.php');
if (empty($_SESSION['user']['email']) OR !isset($_SESSION['user']['email']))
    header('Location: controller/action.php?query=logout');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Médecin |Med Care</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico"><!-- App css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/jquery-ui.min.css" rel="stylesheet">
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/metisMenu.min.css" rel="stylesheet" type="text/css">
    <link href="../plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css">
</head>
<body class="dark-sidenav"><!-- Left Sidenav -->
<div class="left-sidenav"><!-- LOGO -->
    <div class="brand">
        <a href="" class="logo">
            <span style="color: white">
               Med Care
            </span>
        </a>
    </div>
    <!--end logo-->
    <div class="menu-content h-100" data-simplebar>
        <ul class="metismenu left-sidenav-menu">
            <li class="menu-label mt-0">MENU PRINCIPALE</li>
            <li>
                <a href="medecin.php?page=list_fiches">
                    <i data-feather="lock" class="align-self-center menu-icon"></i>
                    <span>Consultation</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span>
                </a>

            </li>
        </ul>
    </div>
</div><!-- end left-sidenav-->
<div class="page-wrapper"><!-- Top Bar Start -->
    <div class="topbar"><!-- Navbar -->
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-nav float-right mb-0">
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user"
                                        data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                        aria-expanded="false">
                        <span class="ml-1 nav-user-name hidden-sm font-weight-bold">Médecin :  <?=ucfirst ($_SESSION['user']["prenom"]).' '.ucfirst($_SESSION['user']["nom"]) ?></span>

                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">
                            <i data-feather="user" class="align-self-center icon-xs icon-dual mr-1"></i>
                            Profile</a>

                        <div class="dropdown-divider mb-0"></div>
                        <a class="dropdown-item" href="../controller/action.php?query=logout"><i data-feather="power"
                                                             class="align-self-center icon-xs icon-dual mr-1"></i>
                            Déconnexion</a></div>
                </li>
            </ul><!--end topbar-nav-->
            <ul class="list-unstyled topbar-nav mb-0">
                <li>
                    <button class="nav-link button-menu-mobile"><i data-feather="menu"
                                                                   class="align-self-center topbar-icon"></i></button>
                </li>

            </ul>
        </nav><!-- end navbar-->
    </div><!-- Top Bar End --><!-- Page Content-->
    <div class="page-content">
        <div class="container-fluid"><!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="text-success text-center"><?php if(isset($_GET['message'])) echo $_GET['message']; ?></h4>
                    <?php
                    if (isset($_GET['page']) && $_GET['page'] == 'list_fiches')
                        require(__Dir__ . '\list_fiches_medecin.php');
                    ?>
                </div>

            </div>
        </div>
        <!-- container -->
        <footer class="footer text-center text-sm-left">&copy; 2022 Hopital Web Application
            <span class="d-none d-sm-inline-block float-right">Contact</span>
            <span class="d-none d-sm-inline-block float-right">About</span>
        </footer>
        <!--end footer-->
    </div><!-- end page content -->
</div><!-- end page-wrapper --><!-- jQuery  -->
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/metismenu.min.js"></script>
<script src="../assets/js/waves.js"></script>
<script src="../assets/js/feather.min.js"></script>
<script src="../assets/js/simplebar.min.js"></script>
<script src="../assets/js/jquery-ui.min.js"></script>
<script src="../assets/js/moment.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script><!-- App js -->
<script src="../assets/js/app.js"></script>
</body>
</html>
