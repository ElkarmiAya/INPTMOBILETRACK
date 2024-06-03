<?php
include 'connect2.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

$user_id = $_SESSION['user_id'];
$bike_id = $_POST['bike_id'];
$rating = $_POST['rating'];

// Check if the user has already rated this bike
$query = "SELECT * FROM ratings WHERE bike_id='$bike_id' AND user_id='$user_id'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    // Update existing rating
    $query = "UPDATE ratings SET rating='$rating' WHERE bike_id='$bike_id' AND user_id='$user_id'";
} else {
    // Insert new rating
    $query = "INSERT INTO ratings (bike_id, user_id, rating) VALUES ('$bike_id', '$user_id', '$rating')";
}

if (mysqli_query($con, $query)) {
    echo json_encode(['success' => 'Rating saved successfully']);
} else {
    echo json_encode(['error' => 'Error saving rating']);
}
?>
