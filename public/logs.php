<?php
$pageTitle = "System Logs";
require_once "../includes/header.php";
require_once "../includes/db.php";

$result = mysqli_query($conn, "SELECT * FROM logs ORDER BY id DESC");
?>

<div class="card">
  <h3>Activity Logs</h3>

  <?php while ($log = mysqli_fetch_assoc($result)): ?>
      <div><?= $log['event'] ?></div>
  <?php endwhile; ?>
</div>

<?php require_once "../includes/footer.php"; ?>
