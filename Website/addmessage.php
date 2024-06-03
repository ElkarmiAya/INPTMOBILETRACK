<?php
session_start();
include("connect.php");

$msg = mysqli_real_escape_string($conn, $_POST["msg"]);
$user_id = $_SESSION["user_id"];
$owner_id = $_POST["receiver_id"];

$q = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ('$user_id', '$owner_id', '$msg')";
mysqli_query($conn, $q);
?>
