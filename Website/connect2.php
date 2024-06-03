<?php


$con = new mysqli("localhost", "root", "", "mobiletrack");

// Vérifier la connexion
if ($con->connect_error) {
    die("Erreur de connexion à la base de données : " . $con->connect_error);
}



?>