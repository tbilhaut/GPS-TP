<?php

class User
{ // Création de la Classe User
    private $id;
    private $login;
    private $passwd;
    private $isAdmin;

    public function __construct($id, $login, $passwd, $isAdmin) // Constructeur
    { 
        $this->id = $id;
        $this->login = $login;
        $this->passwd = $passwd;
        $this->isAdmin = $isAdmin;
    }


    // -- Méthodes : accès aux propriétés --


    public function getId()
    { // Retourne l'Id 
        return $this->id;
    }

    public function getLogin()
    { // Retourne le login 
        return $this->login;
    }

    public function getPasswd()
    { // Retourne le password 
        return $this->passwd;
    }

    public function getisAdmin()
    { // Retourne le isAdmin
        return $this->isAdmin;
    }


    // -- Méthodes : fonctions pour interagir avec l'user --


    // 1) Connexion à la BDD
    public function Connexion($user, $passwd, $bdd)
    {
        try {
            // Tente la connexion à la BDD
            $pdo = new PDO('mysql:host=' . $GLOBALS["ipserver"] . ';dbname=' . $bdd, $user, $passwd);
            return true; // Connexion réussie
        } catch (PDOException $error) {
            return "Erreur de connexion à la base de données : " . $error->getMessage();
        }
    }


    // 2) Inscription d'un user
    public function Inscription($login, $passwd, $isAdmin = 0)
    {
        // Vérifier si le login existe pas déjà
        $sql = "SELECT * FROM User WHERE login = '" . $login . "'";
        $result = $GLOBALS["pdo"]->query($sql);

        // Vérification si personne n'a le même login que celui rentré 
        if ($result && $result->rowCount() > 0) {
            return "Un utilisateur avec le même login existe déjà.";
        }

        // Insérer le nouvel user dans la BDD
        $sql = "INSERT INTO User (login, passwd, isAdmin) VALUES ('$login', '$passwd', $isAdmin)";

        if ($GLOBALS["pdo"]->exec($sql) !== false) {
            return true; // Inscription réussie
        } else {
            return "Erreur lors de l'inscription.";
        }
    }


    // 3) Autorisation pour que l'user accès au site + vérification s'il est Admin ou pas
    public function Autorisation($login, $passwd)
    {
        // Recherche de l'user dans la BDD avec le login
        $sql = "SELECT * FROM User WHERE login = '" . $login . "'";
        $result = $GLOBALS["pdo"]->query($sql);

        if ($result && $result->rowCount() > 0) {
            // L'user existe, vérifie le mot de passe
            $sql = "SELECT * FROM User WHERE login = '" . $login . "' AND passwd = '" . $passwd . "'";
            $result = $GLOBALS["pdo"]->query($sql);

            if ($result && $result->rowCount() > 0) {
                // Authentification réussie
                $userData = $result->fetch(PDO::FETCH_ASSOC);

                // Stocker le nom d'user dans la session
                $_SESSION['id_user'] = $userData['login'];

                // Si l'user est Admin dans la BDD
                if ($userData['isAdmin'] == 1) {
                    // On définit une variable dans la SESSION
                    $_SESSION['isAdmin'] = 1;
                } else {
                    // Sinon c'est un user normal
                    $_SESSION['isAdmin'] = 0;
                }
                return true;
            }
        }
        return false; // Authentification échouée
    }


    // 4) Modifier un user
    public function ModifierUser($login, $nouveauLogin, $nouveauPasswd)
    {
        $sql = "UPDATE User SET login = '$nouveauLogin', passwd = '$nouveauPasswd' WHERE login = '$login'"; // Requête pour modifier login + mdp
        if ($GLOBALS["pdo"]->exec($sql) !== false) {
            echo '<script>setTimeout(function(){ window.location = "admin.php"; }, 2000);</script>';
            return true; // Modification réussie
        } else {
            return "Erreur lors de la modification de l'utilisateur.";
        }
    }


    // 5) Supprimer un user
    public function SupprimerUser($login)
    {
        $sql = "DELETE FROM User WHERE login = '$login'";
        if ($GLOBALS["pdo"]->exec($sql) !== false) {
            echo '<script>setTimeout(function(){ window.location = "admin.php"; }, 2000);</script>';
            return true; // Suppression réussie
        } else {
            return "Erreur lors de la suppression de l'utilisateur.";
        }
    }


    // 6) Déconnecter l'user
    public function Deconnexion()
    {
        session_unset();
        session_destroy();
        return true; // Déconnexion réussie

        // Supprime également le cookie de session
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }
    }


    // 7) Afficher tous les users dans un tableau sur la page admin
    public function AfficherTableauUtilisateurs()
    {
        $sql = "SELECT login, passwd FROM User"; // On récupère tous les users de la BDD
        $result = $GLOBALS["pdo"]->query($sql);

        if ($result && $result->rowCount() > 0) { // Config pour le tableau
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Login</th>'; // Login
            echo '<th>Password</th>'; // Password
            echo '<th></th>'; // Modifier
            echo '<th></th>'; // Supprimer
            echo '</tr>';
            echo '</thead>';
            echo '<tfoot>';
            echo '<tr>';
            echo '</tr>';
            echo '</tfoot>';
            echo '<tbody>';

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $row['login'] . '</td>';
                echo '<td>' . $row['passwd'] . '</td>';
                echo '<td><button class="btn btn-primary" data-toggle="modal" data-target="#modifierModal" data-login="' . $row['login'] . '">Modifier</button></td>';
                echo '<td><button class="btn btn-danger" data-toggle="modal" data-target="#supprimerModal" data-login="' . $row['login'] . '">Supprimer</button></td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo 'Aucun utilisateur trouvé.';
        }
    }


    // 8) Afficher juste son user dans les paramètres
    public function AfficherSingleUser()
    {
        $login = $_SESSION['id_utilisateur']; // On récupère le login de l'user connecté

        $sql = "SELECT login, passwd FROM User WHERE login = '$login'"; // On va chercher ses infos
        $result = $GLOBALS["pdo"]->query($sql);

        // On affiche tout ça dans un tableau
        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered" width="100%" cellspacing="0">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Login</th>'; // Login
        echo '<th>Password</th>'; // Password
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row['login'] . '</td>';
            echo '<td>' . $row['passwd'] . '</td>';
            echo '<td><button class="btn btn-primary" data-toggle="modal" data-target="#modifierModal" data-login="' . $row['login'] . '">Modifier</button></td>';
            echo '<td><button class="btn btn-danger" data-toggle="modal" data-target="#supprimerModal" data-login="' . $row['login'] . '">Supprimer</button></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    }
}
