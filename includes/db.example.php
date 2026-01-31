<?php
$conn = mysqli_connect("localhost", "root", "", "portal");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
