<?php
session_start();

// BROKEN ACCESS CONTROL (INTENTIONAL)
if (!isset($_SESSION['user_id'])) {
    // should redirect, but we allow bypass
}

$username = $_SESSION['username'] ?? 'Employee';
$role = $_SESSION['role'] ?? 'employee';
$user_id = $_SESSION['user_id'] ?? 0;

$documents_count   = 47;
$unread_messages   = 12;
$pending_tasks     = 5;
$upcoming_meetings = 3;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard - Corporate Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="dashboard-body">
    <div class="header">
        <div class="header-content">
            <div>
                <h2>Corporate Employee Portal</h2>
                <p>Internal Dashboard System</p>
            </div>
            <div class="user-info">
                Logged in as: <span class="user-role"><?php echo htmlspecialchars($role); ?></span> | 
                ID: <span class="user-id"><?php echo htmlspecialchars($user_id); ?></span>
                <a href="logout.php" class="logout-link">Logout</a>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="welcome-section">
            <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
            <p>This is your employee dashboard. Here you can access your profile, documents, messages, and view important statistics.</p>
        </div>
        
        <div class="dashboard-grid">
            <div class="card profile">
                <div class="card-header">
                    <div class="card-icon">👤</div>
                    <h3 class="card-title">My Profile</h3>
                </div>
                <div class="card-content">
                    <p>View and update your personal information, contact details, and employment information.</p>
                </div>
                <a href="profile.php?id=<?php echo $user_id; ?>" class="card-button">View Profile</a>
            </div>
            
            <div class="card documents">
                <div class="card-header">
                    <div class="card-icon">📄</div>
                    <h3 class="card-title">My Documents</h3>
                </div>
                <div class="card-content">
                    <p>Access your personal documents, contracts, payslips, and company policies.</p>
                </div>
                <a href="documents.php?user_id=<?php echo $user_id; ?>" class="card-button">View Documents</a>
            </div>
            
            <div class="card messages">
                <div class="card-header">
                    <div class="card-icon">✉️</div>
                    <h3 class="card-title">Messages</h3>
                </div>
                <div class="card-content">
                    <p>Check your inbox, send messages to colleagues, and manage your notifications.</p>
                </div>
                <a href="messages.php?uid=<?php echo $user_id; ?>" class="card-button">View Messages</a>
            </div>
            
            <div class="card tasks">
                <div class="card-header">
                    <div class="card-icon">✓</div>
                    <h3 class="card-title">My Tasks</h3>
                </div>
                <div class="card-content">
                    <p>View assigned tasks, track progress, and submit completed work for review.</p>
                </div>
                <a href="tasks.php?employee=<?php echo $user_id; ?>" class="card-button">View Tasks</a>
            </div>
        </div>
        
        <div class="stats-section">
            <h2>Dashboard Statistics</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number"><?php echo $documents_count; ?></div>
                    <div class="stat-label">Documents</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo $unread_messages; ?></div>
                    <div class="stat-label">Unread Messages</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo $pending_tasks; ?></div>
                    <div class="stat-label">Pending Tasks</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo $upcoming_meetings; ?></div>
                    <div class="stat-label">Upcoming Meetings</div>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p>Corporate Employee Portal v2.1 | © 2023 Company Name. All rights reserved.</p>
        </div>
    </div>
</body>
<script src="../assets/js/dashboard.js"></script>
</html>