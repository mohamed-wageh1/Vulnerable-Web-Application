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
    <!-- Filled by admin.js -->
  </tbody>
</table>
<script src="../assets/js/admin.js"></script>

<?php require_once "../../includes/footer.php"; ?>
