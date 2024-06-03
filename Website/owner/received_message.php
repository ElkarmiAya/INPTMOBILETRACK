<?php
include("../connect.php");
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$owner_phone = $_SESSION['phone'];

// Fetch distinct senders who have sent messages to the logged-in user
$query = "
    SELECT DISTINCT users.id, users.firstname, users.lastname 
    FROM messages 
    JOIN users ON messages.sender_id = users.id 
    WHERE messages.receiver_id = '$owner_phone'
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Received Messages</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Rubik+Maps&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <style>
        .unread-count {
            background-color: green;
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 14px;
        }
        .list-group-item {
            position: relative;
        }
        body{
         background-color: #c9d6ff;
         background-image: url(bg2.png);
        }
        .title{
            text-align: center;
            
            font-family: "Rubik Maps", system-ui;
            font-weight: 400;
            font-style: normal;
            color:#03AED2;
}
.back-button{
height:30px;         
border:none;
margin-top:30px;
border-radius: 10px;
background-color: #03AED2;
color: #c9d6ff;

}
.back-button:hover{
height:33px;  
width:100px;       
border:none;

margin-top:30px;
border-radius: 10px;
background-color: #4eb8cf;
color: #c9d6ff;
transition: 5 ms;

}

  .div{
    font-size: 20px;
    font-weight: bold;
  }      
    </style>
</head>
<body>
    <div class="container">
        <h1 class='title'>Received Messages</h1>

        <div class="list-group" id="message-list">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $sender_id = $row['id'];
                    echo "<a href='conversation.php?sender_id=" . $sender_id . "'  style='background-color: rgba(255, 255, 255, 0.5); border-radius:10px' class='list-group-item list-group-item-action'>";
                    echo "<h5  style='background-color: rgba(255, 255, 255, 0)' class='mb-1'>" . htmlspecialchars($row['firstname']) . " " . htmlspecialchars($row['lastname']) . "</h5>";
                    echo "<span class='unread-count' id='unread-$sender_id'></span>";
                    echo "</a>";
                }
            } else {
                echo "<p class='text-muted'>No messages received.</p>";
            }
            ?>
            <button class="back-button" onclick="window.location.href='ownerhomepage.php';">
            <div class="div">Retour</div></button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        function fetchUnreadCounts() {
            $.ajax({
                url: 'get_unread_counts.php',
                type: 'GET',
                success: function(data) {
                    const counts = JSON.parse(data);
                    $('.unread-count').each(function() {
                        const senderId = $(this).attr('id').split('-')[1];
                        $(this).text(counts[senderId] ? counts[senderId] : '');
                    });
                }
            });
        }

        $(document).ready(function() {
            setInterval(fetchUnreadCounts, 5000);
            fetchUnreadCounts();
        });
    </script>
</body>
</html>
