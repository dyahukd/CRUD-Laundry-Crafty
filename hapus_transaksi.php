<?php
if (isset($_GET['msg'])) {
    echo "<div class='alert'>".$_GET['msg']."</div>";
}

include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if(mysqli_query($conn, "DELETE FROM transaksi WHERE id='$id'")){
        header("Location: tampil_transaksi.php?msg=Data berhasil dihapus!");
    } else {
        header("Location: tampil_transaksi.php?msg=Gagal menghapus data!");
    }
}
exit;
?>