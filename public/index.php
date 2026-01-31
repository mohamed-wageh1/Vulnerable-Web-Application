<?php
require_once "C:/xampp/htdocs/vulnwebapp/Vulnerable_web_app/includes/db.php";
session_start();



if (isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) >= 1) {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role']    = $user['role'];
        $_SESSION['username'] = $user['username'];

        if ($user['role'] === 'admin') {
            header("Location: admin/index.php");
        } else {
            header("Location: dashboard.php");

        }
        exit();
    }else{
        $error = "Invalid cerdentials";
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
                <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
                <button type="submit" name="login" placeholder="Email">Login</button>
        </div>
    </div>
</body>
</html>
