<?php
include("../connect.php");
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

$owner_phone = $_SESSION['phone'];
$receiver_id = $_POST['receiver_id'];
$message = mysqli_real_escape_string($conn, $_POST['message']);

$query = "INSERT INTO messages (sender_id, receiver_id, message, timestamp) VALUES ('$owner_phone', '$receiver_id', '$message', NOW())";
mysqli_query($conn, $query);
?>
