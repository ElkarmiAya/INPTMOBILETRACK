<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $to = "ayaelkarmi123@gmail.com";
        $headers = "From: $email";

        if (mail($to, $subject, $message, $headers)) {
            echo "Message sent successfully!";
        } else {
            echo "Failed to send message.";
        }
    } else {
        echo "Please fill in all fields correctly.";
    }
}
?>
