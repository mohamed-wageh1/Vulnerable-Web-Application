<?php
session_start();
require_once __DIR__ . "/../includes/db.php";

if (isset($_POST['login'])) {

    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if ($email === '' || $password === '') {
        $error = "Invalid credentials";
    } else {

        $stmt = $pdo->prepare("
            SELECT id, username, password, role, status
            FROM users
            WHERE username = ?
            LIMIT 1
        ");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {

            if ($user['status'] === 'disabled') {
                $error = "Account disabled";
            } else {

                $pdo->prepare("
                    UPDATE users SET failed_logins = 0, last_login = NOW()
                    WHERE id = ?
                ")->execute([$user['id']]);

                $_SESSION['user_id']  = $user['id'];
                $_SESSION['role']     = $user['role'];
                $_SESSION['username'] = $user['username'];

                if ($user['role'] === 'admin') {
                    header("Location: admin/index.php");
                } else {
                    header("Location: dashboard.php");
                }
                exit;
            }

        } else {
            if ($user) {
                $pdo->prepare("
                    UPDATE users SET failed_logins = failed_logins + 1
                    WHERE id = ?
                ")->execute([$user['id']]);
            }

            $error = "Invalid credentials";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="form-box active" id="login-form">
            <form method="POST">
                <h2>Login</h2>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <?php if (isset($error)) echo "<p style='color:red'>" . htmlspecialchars($error) . "</p>"; ?>
                <button type="submit" name="login" placeholder="Email">Login</button>
        </div>
    </div>
</body>
</html>
