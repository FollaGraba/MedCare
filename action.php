<?php
namespace Medical;

!isset($_SESSION) ? session_start() :'';

if(isset($_GET['query']))
    switch ($_GET['query']) {
        case'login':


            if (isset($_POST)) {
                $email= $_POST['email'];
                $password = $_POST['password'];
                if($_POST['profile']=="Personnel"){
                    include '../Models/Personnel.php';
                    $user = new Personnel();
                    if($user->login($email,$password))
                        header("Location:../views/personnel.php");
                    else
                        header("Location: ../login.php?message=Erreur : adresse mail / mot de passe inccorecte...");
                }
                elseif($_POST['profile']=="Médecin"){
                    include '../Models/Medecin.php';
                    $user = new Medecin();
                    if($user->login($email,$password))
                        header("Location:../views/medecin.php");
                    else
                        header("Location: ../login.php?message=Erreur : adresse mail / mot de passe inccorecte...");
                }

            }


            break;
        case'logout':
            include '../Models/Personnel.php';
            $user = new Personnel();
           $user->logout();
            break;
        case'inscription':
            if(isset($_POST['profile']) && $_POST['profile']=="Personnel"){
                include '../Models/Personnel.php';
                $user = new Personnel();
                $data = array();
                if (isset($_POST))
                    $data = [
                        "nom" => $_POST['nom'],
                        "prenom" => $_POST['prenom'],
                        "password" => $_POST['password'],
                        "email" => $_POST['email'],
                        "tel" => $_POST['tel']
                    ];
                if($user->create($data))
                    header("Location: ../login.php?message=Inscription a été effectué avec succès");
                else
                    header("Location: ../login.php?message=Erreur lors de l'inscription");
            }else{
                include '../Models/Medecin.php';
                $user = new Medecin();
                $data = array();

                if (isset($_POST))
                    $data = [
                        "nom" => $_POST['nom'],
                        "prenom" => $_POST['prenom'],
                        "service_id" => $_POST['service_id'],
                        "password" => $_POST['password'],
                        "email" => $_POST['email'],
                        "tel" => $_POST['tel']
                    ];
                if($user->create($data))
                    header("Location: ../login.php?message=Inscription a été effectué avec succès");
                else
                    header("Location: ../login.php?message=Erreur lors de l'inscription");
            }


            break;
        case'delete_user':
            include 'Class/User.php';


            break;
        case'save_patient':
            include '../Models/Patient.php';
            $user = new Patient();
            $data = array();
            if (isset($_POST))
                $data = [
                    "nom_prenom" => $_POST['nom_prenom'],
                    "date_naissance" => $_POST['date_naissance'],
                    "sexe" => $_POST['sexe'],
                    "email" => $_POST['email'],
                    "tel" => $_POST['tel']
                ];
            if($user->add_patient($data))
                header("Location: ../views/personnel.php?page=list_patients&message=Patient enregistré avec succès...");
            else
                header("Location: ../views/personnel.php?page=add_patient&message=Erreur : Patient non enregistré");
            break;
        case'save_fiche':
            include '../Models/Patient.php';
            $user = new Patient();
            $data = array();

            if (isset($_POST))
                $data = [
                    "patient_id" => $_POST['patient_id'],
                    "medecin_id" => $_POST['medecin_id']
                ];
            if($user->fiche_patient($data))
                header("Location: ../views/personnel.php?page=list_fiches&message=Fiche enregistré avec succès...");
            else
                header("Location: ../views/personnel.php?page=list_fiches&message=Erreur : Fiche non enregistré");
            break;
        case'get_doctors':
            include '../Models/Medecin.php';
            $doctor = new Medecin();
            $data = $doctor->getDoctors($_GET['sp_doctor']);
            if(isset($data)) {
                $html = "";
                foreach ($data as $d) {
                    $html .= "<option value='" . $d['id'] . "'>" . $d['name'] . "</option>";
                }
                echo $html;
            }
            echo "";
            break;




    }


?>
