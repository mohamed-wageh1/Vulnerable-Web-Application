<?php
require_once "../includes/db.php";
require_once "../includes/auth.php";

require_login(); // user must be logged in ❗

// 🚨 VULNERABILITY: trusting user-controlled ID
$user_id = $_GET['user_id'];

$stmt = $pdo->prepare("
    SELECT id, username, email, role
    FROM users
    WHERE id = ?
");
$stmt->execute([$user_id]);

echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Stats</title>
    <link rel="stylesheet" href="../assets/admin.css">
</head>
<body>

<h1>📊 Admin Statistics</h1>

<div class="stats-grid">

<?php
$stats = [
    "Total Users" => "SELECT COUNT(*) FROM users",
    "Admins" => "SELECT COUNT(*) FROM users WHERE role='admin'",
    "Normal Users" => "SELECT COUNT(*) FROM users WHERE role='user'",
    "Disabled Accounts" => "SELECT COUNT(*) FROM users WHERE status='disabled'",
    "Users Never Logged In" => "SELECT COUNT(*) FROM users WHERE last_login IS NULL",
    "New Users (7 days)" => "SELECT COUNT(*) FROM users WHERE created_at >= NOW() - INTERVAL 7 DAY"
];

foreach ($stats as $label => $query) {
    $count = $pdo->query($query)->fetchColumn();
    echo "<div class='stat-card'>
            <h3>$label</h3>
            <p>$count</p>
          </div>";
}
?>

</div>

<h2>🚨 High Risk Accounts</h2>

<table>
<tr>
    <th>Username</th>
    <th>Failed Logins</th>
</tr>

<?php
$stmt = $pdo->query("
    SELECT username, failed_logins 
    FROM users 
    WHERE failed_logins >= 5
");

while ($row = $stmt->fetch()) {
    echo "<tr>
            <td>{$row['username']}</td>
            <td>{$row['failed_logins']}</td>
          </tr>";
}
?>

</table>

</body>
</html>