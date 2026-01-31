<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = $pageTitle ?? "Dashboard";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="dashboard-body">

<div class="top-nav">
    <div class="nav-content">
        <div class="nav-title">
            <?= htmlspecialchars($pageTitle) ?>
        </div>

        <div class="nav-actions">
            <?php if (isset($_SESSION['user'])): ?>
                <span class="nav-user">
                    <?= htmlspecialchars($_SESSION['user']['username'] ?? 'user') ?>
                </span>
                <a href="/logout.php" class="logout-link">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="container">
