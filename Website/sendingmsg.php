<?php
include("connect.php");
include("connect2.php");

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$owner_id = $_GET['owner_phone'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['message'])) {
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $query = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ('$user_id', '$owner_id', '$message')";
    if (!mysqli_query($conn, $query)) {
        die("Error: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat with Owner</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Chat with Owner</h1>
            <button class="back-button" onclick="window.location.href='homepage.php';">Retour</button>
        </div>
        <div id="chat" class="chat"></div>
        <form id="messageForm" method="POST" class="message-form">
            <input type="text" id="messageInput" name="message" placeholder="C'est là où le sender va écrire le message" required>
            <button type="submit" class="send-button">Send</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        function fetchMessages() {
            $.ajax({
                url: 'readmessage.php',
                type: 'GET',
                data: { owner_id: '<?php echo $owner_id; ?>' },
                success: function(data) {
                    $('#chat').html(data);
                }
            });
        }

        $(document).ready(function() {
            setInterval(fetchMessages, 5000);

            $('#messageForm').on('submit', function(e) {
                e.preventDefault();
                const message = $('#messageInput').val();
                $.post('addmessage.php', { msg: message, receiver_id: '<?php echo $owner_id; ?>' }, function() {
                    $('#messageInput').val('');
                    fetchMessages();
                });
            });

            fetchMessages();
        });
    </script>
</body>
</html>
