<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['phone'])) {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: login.php");
    exit();
}

// Mettez à jour la colonne last_visit dans votre base de données
include("../connect.php");

$phone = $_SESSION['phone'];
$query = "UPDATE owners SET last_visit = NOW() WHERE télephone= '$phone'";
if (mysqli_query($conn, $query)) {
    // Répondez avec un statut HTTP 200 si la mise à jour réussit
    http_response_code(200);
} else {
    // Répondez avec un statut HTTP 500 en cas d'erreur de mise à jour
    http_response_code(500);
}
?>
