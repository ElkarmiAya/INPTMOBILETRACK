<?php
include("../connect.php");
session_start();

$owner_phone = $_SESSION['phone'];
$sender_id = $_GET['sender_id'];

$query = "
    SELECT messages.*, messages.timestamp 
    FROM messages 
    WHERE (messages.sender_id = '$owner_phone' AND messages.receiver_id = '$sender_id') 
    OR (messages.sender_id = '$sender_id' AND messages.receiver_id = '$owner_phone')
    ORDER BY messages.timestamp
";

$result = mysqli_query($conn, $query);

$messages = array();
while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
}

echo json_encode($messages);
?>
