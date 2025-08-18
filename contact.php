<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $fullName   = htmlspecialchars(trim($_POST["full_name"]));
    $email      = htmlspecialchars(trim($_POST["email"]));
    $phone      = htmlspecialchars(trim($_POST["phone"]));
    $genre      = htmlspecialchars(trim($_POST["genre"]));
    $bookTitle  = htmlspecialchars(trim($_POST["book_title"]));
    $details    = htmlspecialchars(trim($_POST["details"]));
    $terms      = isset($_POST["terms"]) ? "Agreed" : "Not Agreed";

    // File Upload
    $fileInfo = "";
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
        $fileName = $_FILES["file"]["name"];
        $fileTmp  = $_FILES["file"]["tmp_name"];
        $fileSize = $_FILES["file"]["size"];
        $fileType = $_FILES["file"]["type"];

        $fileInfo = "File Uploaded: $fileName ($fileType, " . round($fileSize / 1024, 2) . " KB)";
    } else {
        $fileInfo = "No file uploaded.";
    }

    // Email details
    $to      = "innoxent.tariq2016@gmail.com"; // Your email
    $subject = "📖 New Book Submission from $fullName";

    $body = "
    Full Name: $fullName
    Email: $email
    Phone: $phone
    Genre: $genre
    Book Title: $bookTitle
    Terms: $terms

    File Info:
    $fileInfo

    Details:
    $details
    ";

    $headers = "From: $email\r\nReply-To: $email\r\n";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('✅ Your submission has been sent successfully!'); window.location.href='contact.php';</script>";
    } else {
        echo "<script>alert('❌ Failed to send. Please try again later.'); window.location.href='contact.php';</script>";
    }
}
?>
