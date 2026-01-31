<?php

$user = $_GET['user_id'];
$new = $_POST['password'];

mysqli_query($conn, "UPDATE users SET password='$new' WHERE id=$user");

?>