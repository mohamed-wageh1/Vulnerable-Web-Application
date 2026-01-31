<?php
$pageTitle = "Admin Messages";
require_once "../../includes/header.php";
require_once "../../includes/db.php";

// INTENTIONAL BROKEN ACCESS CONTROL
$result = mysqli_query($conn, "SELECT * FROM messages ORDER BY id DESC");
?>

<?php while ($msg = mysqli_fetch_assoc($result)) : ?>
    <div class="msg">
        <strong>User <?= $msg['user_id'] ?>:</strong>
        <?= $msg['content'] ?>
    </div>
<?php endwhile; ?>

<?php require_once "../../includes/footer.php"; ?>
