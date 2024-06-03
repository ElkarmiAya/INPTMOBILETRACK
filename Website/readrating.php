<?php
include 'connect2.php';

// Requête pour récupérer les ratings actuels pour chaque vélo
$sql = "SELECT bike_id, AVG(rating) AS avg_rating FROM ratings GROUP BY bike_id";
$result = mysqli_query($con, $sql);

// Créer un tableau associatif pour stocker les ratings de chaque vélo
$ratings = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Ajouter l'ID du vélo et sa moyenne de rating au tableau des ratings
        $ratings[$row['bike_id']] = round($row['avg_rating'], 1);
    }
}

// Renvoyer les ratings au format JSON
header('Content-Type: application/json');
echo json_encode($ratings);
?>
