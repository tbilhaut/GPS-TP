<?php
session_start();
include "../bdd/bdd.php";
include "../class/user.php";

$message; // Variable utilisée en cas d'erreur(s)

// Traitement du formulaire d'inscription
if (isset($_POST['inscription'])) {
    $login = $_POST['new_login'];
    $passwd = $_POST['new_passwd'];

    // On effectue l'inscription en utilisant la fonction "Inscription" de la Class User
    $result = User::Inscription($login, $passwd);

    if ($result === true) {
        $message = "Inscription réussie. Vous pouvez maintenant vous connecter.";
        header('location: ../index.php');
    } else {
        $message = "Erreur d'inscription : $result";
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

    <title>PROJET GPS - Inscription</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets//css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Création de votre compte</h1>
                            </div>

                            <!-- Ajout des balises form pour le formulaire -->

                            <form class="user" method="post">

                                <!-- Rentrer le Login -->
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="new_login" name="new_login" placeholder="Login" required>
                                </div>

                                <!-- Rentrer le Mot de Passe -->
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="new_passwd" name="new_passwd" placeholder="Mot de Passe" required>
                                    </div>
                                    <!-- Confirmer le Mot de Passe -->
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" name="confpass" placeholder="Répétez le Mot de Passe" required>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary btn-user btn-block" name="inscription" value="S'incrire">
                            </form>

                            <!-- Fin des balises form -->

                            <hr>
                            <div class="text-center">
                                <a class="small" href="../index.php">Vous avez déjà un compte ? Connectez-vous !</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

</body>

</html>