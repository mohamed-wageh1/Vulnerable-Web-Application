<?php
session_start();
$pageTitle = "File Upload";
require_once "../../includes/header.php";

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    http_response_code(403);
    die("Access denied: Admins only");
}

$allowed_pages = ['dashboard.php', 'users.php', 'messages.php'];
if (isset($_GET['page']) && in_array($_GET['page'], $allowed_pages)) {
    include($_GET['page']);
}

$upload_dir = realpath(__DIR__ . "/../../uploads/files/") . "/";

if (isset($_POST['upload']) && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    $allowed_ext = ['pdf', 'png', 'jpg', 'jpeg', 'docx'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed_ext)) {
        $message = "File type not allowed!";
    } else {
        $safe_name = uniqid('file_', true) . '.' . $ext;

        if (move_uploaded_file($file['tmp_name'], $upload_dir . $safe_name)) {
            $message = "File uploaded successfully!";
        } else {
            $message = "Error uploading file.";
        }
    }
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