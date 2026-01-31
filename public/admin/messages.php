<?php
$pageTitle = "Admin Messages";
require_once "../../includes/header.php";
require_once "../../includes/db.php";

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    http_response_code(403);
    die("Access denied: Admins only");
}

$result = mysqli_query($conn, "SELECT * FROM messages ORDER BY id DESC");
?>

<?php while ($msg = mysqli_fetch_assoc($result)) : ?>
    <div class="msg">
        <strong>User <?= htmlspecialchars($msg['user_id']) ?>:</strong>
        <?= nl2br(htmlspecialchars($msg['content'])) ?>

        <form method="POST" action="delete_message.php" style="display:inline;">
            <input type="hidden" name="id" value="<?= (int)$msg['id'] ?>">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
            <button type="submit">Delete</button>
        </form>
    </div>
<?php endwhile; ?>
    
