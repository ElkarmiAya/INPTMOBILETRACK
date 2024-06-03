<?php
include("connect.php");

session_start();

$user_id = $_SESSION['user_id'];
$owner_id = $_GET['owner_id'];

$query = "
    SELECT * FROM messages 
    WHERE (sender_id = '$user_id' AND receiver_id = '$owner_id') 
    OR (sender_id = '$owner_id' AND receiver_id = '$user_id') 
    ORDER BY timestamp ASC";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $sender_class = $row['sender_id'] == $user_id ? 'you' : 'Owner';
    if ($sender_class=='you'){    
        echo "<div class='message-item-sent'>
            
            <p class='message-text'>{$row['message']}</p>
            <small class='timestamp'>{$row['timestamp']}</small>
          </div>";
    }else{
        echo "<div class='message-item-received'>
            <p class='mes_o'>{$sender_class}</p>
            <p class='message-text'>{$row['message']}</p>
            <small class='timestamp'>{$row['timestamp']}</small>
          </div>";
    }
}
?>
