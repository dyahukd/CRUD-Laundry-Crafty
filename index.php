<?php
if (isset($_GET['msg'])) {
    echo "<div class='alert'>".$_GET['msg']."</div>";
}

header("Location: login/login.php");
exit();
?>