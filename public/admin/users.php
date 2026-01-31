<?php
$pageTitle = "Admin – User Management";
require_once "../../includes/header.php";
?>
<link rel="stylesheet" href="../assets/css/style.css">
<h1 class="admin-table">Admin – User Management</h1>

<table id="users-table" class="admin-table">
  <thead>
    <tr>
      <th>ID</th> 
      <th>Username</th>
      <th>Role</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>
<script src="../assets/js/admin.js"></script>

<?php require_once "../../includes/footer.php"; ?>
<script>
const csrfToken = '<?= $_SESSION['csrf_token'] ?>';

function updateRole(userId, newRole) {
    fetch('update_role.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `user_id=${userId}&role=${newRole}&csrf_token=${csrfToken}`
    }).then(res => res.text())
      .then(console.log);
}
</script>
