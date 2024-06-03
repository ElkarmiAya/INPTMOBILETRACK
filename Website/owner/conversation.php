<?php
include("../connect.php"); // Ensure this path is correct
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$owner_phone = $_SESSION['phone'];

$sender_id = $_GET['sender_id'];

// Mark messages as read
$update_query = "UPDATE messages SET read_at = NOW() WHERE sender_id = '$sender_id' AND receiver_id = '$owner_phone' AND read_at IS NULL";
mysqli_query($conn, $update_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $query = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ('$owner_phone', '$sender_id', '$message')";
    mysqli_query($conn, $query);
}

// Fetch messages between the logged-in user and the selected sender
$query = "
    SELECT messages.*, timestamp 
    FROM messages 
    WHERE (messages.sender_id = '$owner_phone' AND messages.receiver_id = '$sender_id') 
    OR (messages.sender_id = '$sender_id' AND messages.receiver_id = '$owner_phone')
    ORDER BY messages.timestamp
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Conversation</title>
    <link rel="stylesheet" href="styles.css">
  
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Conversation with <?php 
                $sender_query = "SELECT firstname, lastname FROM users WHERE id = '$sender_id'";
                $sender_result = mysqli_query($conn, $sender_query);
                $sender = mysqli_fetch_assoc($sender_result);
                echo htmlspecialchars($sender['firstname']) . " " . htmlspecialchars($sender['lastname']);
            ?></h1>
            <button class="back-button" onclick="window.location.href='received_message.php';">Retour</button>
        </div>
        <div id="messages" class="messages">
            <!-- Messages will be loaded here -->
        </div>
        <form id="messageForm" method="POST" class="message-form">
            <input type="text" name="message" id="messageInput" placeholder="Message" required>
            <button type="submit" class="send-button">Send</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        function fetchMessages() {
            $.ajax({
                url: 'get_messages.php',
                type: 'GET',
                data: { sender_id: '<?php echo $sender_id; ?>' },
                success: function(data) {
                    const messages = JSON.parse(data);
                    $('#messages').empty();
                    messages.forEach(message => {
                        const sender = message.sender_id == '<?php echo $owner_phone; ?>' ? 'You' : 'Customer';
                        if(sender=="You"){
                            $('#messages').append(
                            `<div class='message-item-sent'>

                                <p class='message-text'>${message.message}</p>
                                <small class='timestamp'>${message.timestamp}</small>
                            </div>`
                        );
                        }else{
                            $('#messages').append(
                            `<div class='message-item-received'>
                                <h6 class='sender'>Customer</h6>
                                <p class='message-text'>${message.message}</p>
                                <small class='timestamp'>${message.timestamp}</small>
                            </div>`
                        );
                        }
                        
                    });
                }
            });
        }

        $(document).ready(function() {
            setInterval(fetchMessages, 5000);

            $('#messageForm').on('submit', function(e) {
                e.preventDefault();
                const message = $('#messageInput').val();
                $.post('send_message.php', { message: message, receiver_id: '<?php echo $sender_id; ?>' }, function() {
                    $('#messageInput').val('');
                    fetchMessages();
                });
            });

            fetchMessages();
        });
    </script>
</body>
</html>
