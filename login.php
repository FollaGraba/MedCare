<?php
include 'Models\Medecin.php';
$med =  new \Medical\Medecin();
$services = $med->getServices();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Med Care</title>
    <meta content="width=device-width,initial-scale=1,shrink-to-fit=no" name="viewport">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="" name="author">
    <meta content="IE=edge" http-equiv="X-UA-Compatible"><!-- App favicon -->
    <link href="assets/images/favicon.ico" rel="shortcut icon"><!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css">
</head>
<body class="account-body accountbg"><!-- Register page -->
<div class="container">
    <div class="row vh-100 d-flex justify-content-center">
        <div class="col-12 align-self-center">
            <div class="row">
                <div class="col-lg-5 mx-auto">
                    <div class="card">
                        <div class="card-body p-0 auth-header-box">
                            <div class="text-center p-3"><a class="logo logo-admin" href="index.php"><img
                                        alt="logo" class="auth-logo" height="50" src="assets/images/logo-sm.png"></a>
                                <h4 class="mt-1 mb-1 font-weight-semibold text-white font-18">Med Care</h4>

                            </div>

                        </div>
                        <div class="card-body">
                            <h4 class="text-success"><?php if(isset($_GET['message'])) echo $_GET['message']; ?></h4>
                            <ul class="nav-border nav nav-pills" role="tablist">
                                <li class="nav-item"><a class="nav-link active font-weight-semibold" data-toggle="tab"
                                                        href="#LogIn_Tab" role="tab">Connexion</a></li>
                                <li class="nav-item"><a class="nav-link font-weight-semibold" data-toggle="tab"
                                                        href="#Register_Tab" role="tab">Inscription</a></li>
                            </ul><!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                    <form action="controller/action.php?query=login" class="form-horizontal auth-form my-4" method="post">
                                        <div class="form-group">
                                            <label for="username" class="font-weight-bold">Adresse mail</label>
                                            <div class="input-group mb-3">
                                                <input class="form-control" id="username" name="email" placeholder="Adresse mail" type="text">
                                            </div>
                                        </div><!--end form-group-->
                                        <div class="form-group">
                                            <label for="userpassword" class="font-weight-bold">Mot de passe</label>
                                            <div class="input-group mb-3">
                                                <input class="form-control" id="userpassword" name="password" placeholder="Mot de passe" type="password">
                                            </div>
                                        </div><!--end form-group-->
                                        <!--end form-group-->
                                        <div class="form-group mb-0 row">
                                            <div class="col-12 mt-2">
                                                <label for="profil" class="font-weight-bold">Profile</label>
                                                <select id="profil" class="form-control" name="profile" required>
                                                    <option value="Personnel">Personnel</option>
                                                    <option value="Médecin">Médecin</option>
                                                </select>
                                            </div><!--end col-->
                                        </div>
                                        <div class="form-group mb-0 row">
                                            <div class="col-12 mt-2">
                                                <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">
                                                    Se Connecter
                                                    <i class="fas fa-sign-in-alt ml-1"></i>
                                                </button>
                                            </div><!--end col-->
                                        </div>
                                    </form><!--end form-->


                                </div>
                                <div class="tab-pane px-3 pt-3" id="Register_Tab" role="tabpanel">
                                    <form name="form_register" action="controller/action.php?query=inscription" class="form-horizontal auth-form my-4" method="post">
                                        <div class="form-group">
                                            <label for="profile">Profile</label>
                                            <select id="profile" class="form-control" name="profile" required>
                                                <option value="Personnel">Personnel</option>
                                                <option value="Médecin">Médecin</option>
                                            </select>
                                        </div>

                                        <div id="service" class="form-group">
                                            <label for="service">Service</label>
                                            <select  class="form-control" name="service_id" required>
                                                <?php foreach ($services as $service) {?>
                                                <option value="<?=$service['id'] ?>"><?=$service['nom_service'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="username">Nom & Prénom</label>
                                            <div class="input-group mb-3">
                                                <input class="form-control" id="nom"
                                                       name="nom" placeholder="Nom" type="text" required>
                                                <input class="form-control ml-2" id="prenom"
                                                       name="prenom" placeholder="Prénom" type="text" required>
                                            </div>
                                        </div>
                                        <div class="form-group"><label for="email">Email</label>
                                            <div class="input-group mb-3"><input class="form-control" id="email"
                                                                                 name="email" placeholder="Adresse mail"
                                                                                 type="email" required></div>
                                        </div><!--end form-group-->
                                        <div class="form-group"><label for="password">Mot de passe</label>
                                            <div class="input-group mb-3"><input class="form-control" id="password"
                                                                                 name="password"
                                                                                 placeholder="Mot de passe"
                                                                                 type="password" required></div>
                                        </div><!--end form-group-->

                                        <div class="form-group"><label for="tel">Tél</label>
                                            <div class="input-group mb-3"><input class="form-control" id="tel"
                                                                                 name="tel"
                                                                                 placeholder="Numéro de Tél"
                                                                                 type="number" required>
                                            </div>
                                        </div><!--end form-group-->

                                        <div class="form-group mb-0 row">
                                            <div class="col-12 mt-2">
                                                <button class="btn btn-primary btn-block waves-effect waves-light"
                                                        type="submit">Valider <i class="fas fa-sign-in-alt ml-1"></i>
                                                </button>
                                            </div><!--end col--></div><!--end form-group--></form><!--end form-->
                                </div>
                            </div>
                        </div><!--end card-body-->
                        <div class="card-body bg-light-alt text-center"><span
                                class="text-muted d-none d-sm-inline-block font-weight-bold">Med Care ©2022</span></div>
                    </div><!--end card--></div><!--end col--></div><!--end row--></div><!--end col--></div>
    <!--end row--></div><!--end container--><!-- End Register page --><!-- jQuery  -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/waves.js"></script>
<script src="assets/js/feather.min.js"></script>
<script src="assets/js/simplebar.min.js"></script>
<script>
    $(document).ready(function() {
        if($('#profile').val()=="Personnel")
        {
            $('#service').hide();
        }
        else{
            $('#service').show();
        }
    });
    $('#profile').change(function() {
        if($('#profile').val()=="Personnel")
        {
            $('#service').hide();
        }
        else{
            $('#service').show();
        }
    });
</script>
</body>
</html>