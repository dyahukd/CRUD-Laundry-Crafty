<?php
if (isset($_GET['msg'])) {
    echo "<div class='alert'>".$_GET['msg']."</div>";
}

session_start();
session_destroy();
header("Location: ../login/login.php");
exit();
?>