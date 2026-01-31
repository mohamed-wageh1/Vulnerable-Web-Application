<?php
$pageTitle = "Messages";
require_once "../includes/header.php";
require_once "../includes/db.php";

$user_id = $_SESSION['user_id'] ?? 1;

if (isset($_POST['send'])) {
    $content = trim($_POST['message']);

    if ($content !== '') {
        if (strlen($content) > 1000) {
            $content = substr($content, 0, 1000);
        }

        $stmt = $pdo->prepare("INSERT INTO messages (user_id, content) VALUES (?, ?)");
        $stmt->execute([$user_id, $content]);
    }

    header("Location: messages.php");
    exit;
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<h1 class="topbar">Messages</h1>

<form method="POST" class="msg">
    <textarea name="message" placeholder="Type your message"></textarea><br>
    <button type="submit" name="send">Send</button>
</form>

<hr>
<?php require_once "../includes/footer.php"; ?>

