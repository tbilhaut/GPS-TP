<?php

$ipserver = "192.168.64.157"; // A modifier si vous travaillez chez vous
$bdd = "Base_PROJET";
$login_bdd = "dudule";
$password = "root";

try {
    $pdo = new PDO('mysql:host=' . $ipserver . ';dbname=' . $bdd . '', $login_bdd, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

/* // Ancienne version
    $ipserver="192.168.1.56";
    $basename="Base_PROJET";
    $login="root";
    $password="root";
    $GLOBALS["pdo"] = new PDO('mysql:host='.$ipserver.';dbname='.$basename.'',$login,$password);
*/

?>