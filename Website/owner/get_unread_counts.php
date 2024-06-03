<?php
include("../connect.php");
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$owner_phone = $_SESSION['phone'];

// Fetch unread message counts for each sender
$query = "
    SELECT sender_id, COUNT(*) as unread_count 
    FROM messages 
    WHERE receiver_id = '$owner_phone' AND read_at IS NULL
    GROUP BY sender_id
";

$result = mysqli_query($conn, $query);

$counts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $counts[$row['sender_id']] = $row['unread_count'];
}

echo json_encode($counts);
?>
