<?php
session_start();
include "bdd/bdd.php";
require "class/user.php";

$message; // Variable utilisée en cas d'erreur(s)

if (isset($_POST['connexion'])) {
    $login = $_POST['login'];
    $passwd = $_POST['passwd'];

    // Vérifier l'authentification
    if (User::Autorisation($login, $passwd)) {
        // Stocker l'ID de l'utilisateur dans la session
        $_SESSION['id_utilisateur'] = $login;

        // Redirection de l'utilisateur vers la page d'accueil
        header('location: main_pages/accueil.php');
        exit();
    } 
    else {
        $message = "Erreur d'authentification. Veuillez réessayer.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GPS - Connexion</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Bienvenue !</h1>
                            </div>

                            <!-- Ajout des balises form pour le formulaire -->

                            <form class="user" method="post">

                            <!-- Rentrer le Login -->
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user"
                                        id="login" name="login" placeholder="Entrez votre Login..." required>
                                </div>

                            <!-- Rentrer le Mot de Passe -->
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                        id="passwd" name="passwd" placeholder="Entrez votre Mot de Passe..." required>
                                </div>
                                <input type="submit" class="btn btn-primary btn-user btn-block" name="connexion" value="Connexion">
                            </form>

                            <!-- Fin des balises form -->

                            <hr>

                            <!-- Si l'user souhaite s'inscrire, redirection -->
                            <div class="text-center">
                                <a class="small" href="main_pages/inscription.php">Pas encore inscrit ? C'est ici !</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>