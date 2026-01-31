<?

$type = $_GET['type'];
$result = mysqli_query($conn, "SELECT * FROM $type");

?>