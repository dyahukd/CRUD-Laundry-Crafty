<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit();
}
include "../koneksi.php";

$data = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY id DESC");

$alert = "";
if(isset($_GET['msg'])){
    $alert = "<div class='alert'>".$_GET['msg']."</div>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Transaksi</title>

<style>
    body { 
        font-family: Poppins, sans-serif; 
        background:#FFE4F3; 
        padding:20px; 
    }

    .topbar {
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
    }

    h2 { 
        color:#FF2F87; 
        margin:0;
    }

    .logout {
        background:#FF0059;
        padding:10px 15px;
        border-radius:10px;
        color:white;
        font-weight:bold;
        text-decoration:none;
    }
    .logout:hover { background:#c90046; }

    .alert {
        background:#FFB6D9;
        color:#5A0035;
        padding:10px;
        border-radius:10px;
        width:60%;
        margin:10px auto;
        font-weight:bold;
        text-align:center;
    }

    .tambah {
        background:#FF2F87;
        padding:10px 18px;
        border-radius:12px;
        text-decoration:none;
        color:white;
        font-weight:bold;
        display:inline-block;
        margin-bottom:15px;
    }
    .tambah:hover { background:#ff0a72; }

    table {
        width:100%;
        border-collapse:collapse;
        background:white;
        border-radius:15px;
        overflow:hidden;
        box-shadow:0 0 12px rgba(0,0,0,0.1);
    }

    th {
        background:#FF2F87;
        color:white;
        padding:12px;
        text-align:center;
    }

    td {
        padding:10px;
        border-bottom:1px solid #FFD3EC;
        text-align:center;
    }

    tr:hover {
        background:#FFE6F4;
    }

    .btn {
        padding:7px 10px;
        border-radius:8px;
        text-decoration:none;
        color:white;
        font-size:12px;
        font-weight:bold;
    }

    .edit { background:#FF7FBF; }
    .edit:hover { background:#ff56a8; }

    .hapus { background:#FF0040; }
    .hapus:hover { background:#cc0033; }
</style>

</head>
<body>

<?= $alert ?>

<div class="topbar">
    <h2>Data Transaksi Laundry</h2>
    <a class="logout" href="../login/logout.php">Logout</a>
</div>

<a class="tambah" href="tambah_transaksi.php">+ Tambah Transaksi</a>

<table>
<tr>
    <th>No</th>
    <th>Masuk</th>
    <th>Keluar</th>
    <th>Nama Konsumen</th>
    <th>Berat</th>
    <th>Kategori</th>
    <th>Status</th>
    <th>Total (Rp)</th>
    <th>Aksi</th>
</tr>

<?php 
$no = 1;
while ($row = mysqli_fetch_assoc($data)) { 
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $row['masuk']; ?></td>
    <td><?= $row['keluar']; ?></td>
    <td><?= $row['nama_konsumen']; ?></td>
    <td><?= $row['berat']; ?> Kg</td>
    <td><?= $row['kategori']; ?></td>
    <td><?= $row['status']; ?></td>
    <td><?= number_format($row['harga_total'],0,',','.'); ?></td>
    <td>
        <a class="btn edit" href="edit_transaksi.php?id=<?= $row['id']; ?>">Edit</a>
        <a class="btn hapus" href="hapus_transaksi.php?id=<?= $row['id']; ?>"
           onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>