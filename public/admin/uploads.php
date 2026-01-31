<?php
session_start();
$pageTitle = "File Upload";
require_once "../../includes/header.php";
// BROKEN ACCESS CONTROL (INTENTIONAL)
if (!isset($_SESSION['user_id'])) {
    // bypass allowed
}

$upload_dir = realpath(__DIR__ . "/../../uploads/files/") . "/";
// echo "<pre>UPLOAD DIR: $upload_dir</pre>";

if (isset($_POST['upload'])) {
    $filename = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];

    move_uploaded_file($tmp_name, $upload_dir . $filename);

    $message = "File uploaded successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin File Upload</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="dashboard-body">

<div class="container">
    <h2>Upload Internal Document</h2>

    <?php if (isset($message)) echo "<p style='color:green'>$message</p>"; ?>

    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit" name="upload">Upload</button>
    </form>

    <p>Uploaded files are stored internally.</p>
</div>

</body>
</html>