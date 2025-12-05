<?php
if (isset($_GET['msg'])) {
    echo "<div class='alert'>".$_GET['msg']."</div>";
}

$host = "localhost";
$user = "root";
$pass = "";
$db   = "crud_laundry";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>