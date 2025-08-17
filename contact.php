<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName   = htmlspecialchars(trim($_POST["first_name"]));
    $lastName    = htmlspecialchars(trim($_POST["last_name"]));
    $email       = htmlspecialchars(trim($_POST["email"]));
    $phone       = htmlspecialchars(trim($_POST["phone"]));
    $topic       = htmlspecialchars(trim($_POST["topic"]));
    $message     = htmlspecialchars(trim($_POST["message"]));

    $to      = "innoxent.tariq2016@gmail.com"; // Your email
    $subject = "New Support Request from $firstName $lastName";

    $body = "
    First Name: $firstName
    Last Name: $lastName
    Email: $email
    Phone: $phone
    Support Topic: $topic

    Message:
    $message
    ";

    $headers = "From: $email\r\nReply-To: $email\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('✅ Message sent successfully!'); window.location.href='contact.php';</script>";
    } else {
        echo "<script>alert('❌ Failed to send message. Please try again later.'); window.location.href='contact.php';</script>";
    }
}
?>
