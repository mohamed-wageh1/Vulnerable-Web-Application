<?php
session_start();

// INTENTIONAL BROKEN ACCESS CONTROL
if (!isset($_SESSION['user_id'])) {
    // should block access – but we allow it
}
if (isset($_GET['page'])) {
    include($_GET['page']);
    exit;
}
$role = $_SESSION['role'] ?? 'guest';
$user_id = $_SESSION['user_id'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="dashboard-body">

<div class="header">
    <div class="header-content">
        <div>
            <h2>Admin Control Panel</h2>
            <p>Corporate Internal Management</p>
        </div>
        <div class="user-info">
            Role: <b><?php echo htmlspecialchars($role); ?></b> |
            ID: <b><?php echo htmlspecialchars($user_id); ?></b>
            <a href="../logout.php" class="logout-link">Logout</a>
        </div>
    </div>
</div>

<div class="container">
    <div class="welcome-section">
        <h1>Admin Dashboard</h1>
        <p>Administrative functions for internal systems.</p>
    </div>

    <div class="dashboard-grid">

        <div class="card">
            <h3>User Management</h3>
            <p>View and manage company users.</p>
            <a href="users.php?uid=1" class="card-button">View Users</a>
        </div>

        <div class="card">
            <h3>File Uploads</h3>
            <p>Upload internal documents.</p>
            <a href="uploads.php" class="card-button">Upload Files</a>
        </div>

        <div class="card">
            <h3>System Logs</h3>
            <p>View system activity and logs.</p>
            <a href="logs.php" class="card-button">View Logs</a>
        </div>
        <div class="card">
            <h3>Messages</h3>
            <p>Sent Messages.</p>
            <a href="messages.php" class="card-button">View Messages</a>
        </div>
    </div>
</div>

</body>
</html>
