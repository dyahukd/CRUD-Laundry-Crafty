<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit();
}
include "../koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM transaksi WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

$msg = "";

if (isset($_POST['update'])) {
    $masuk = $_POST['masuk'];
    $keluar = $_POST['keluar'];
    $nama = trim($_POST['nama_konsumen']);
    $berat = $_POST['berat'];
    $kategori = $_POST['kategori'];
    $harga_satuan = $_POST['harga_satuan'];
    $status = $_POST['status'];
    $total = $berat * $harga_satuan;

    if (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
        $msg = "Nama hanya boleh huruf saja!";
    } elseif ($berat < 1) {
        $msg = "Berat minimal 1 Kg!";
    } elseif ($keluar < $masuk) {
        $msg = "Tanggal keluar tidak boleh sebelum masuk!";
    } else {
        $update = mysqli_query($conn, 
            "UPDATE transaksi SET masuk='$masuk', keluar='$keluar', nama_konsumen='$nama',
            berat='$berat', kategori='$kategori', status='$status',
            harga_satuan='$harga_satuan', harga_total='$total' WHERE id='$id'"
        );

        if($update){
            header("Location: tampil_transaksi.php?msg=Berhasil diperbarui!");
            exit();
        } else {
            $msg = "Gagal memperbarui data!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Transaksi</title>

<style>
    body {
        font-family: Poppins, sans-serif;
        background:#FFE4F3;
        display:flex;
        justify-content:center;
        align-items:center;
        min-height:100vh;
        margin:0;
    }
    .card {
        width:450px;
        background:white;
        padding:30px;
        border-radius:18px;
        box-shadow:0 0 15px rgba(255, 105, 180, .25);
    }
    h2 {
        text-align:center;
        color:#FF2F87;
        margin-bottom:20px;
    }
    .alert {
        background:#FFB6D9;
        padding:10px;
        border-radius:8px;
        text-align:center;
        margin-bottom:10px;
        font-weight:600;
        color:#8A004C;
        border:1.5px solid #FF7ABF;
    }
    .form-group {
        margin-bottom:15px;
    }
    label {
        color:#FF2F87;
        font-weight:600;
        display:block;
        margin-bottom:6px;
    }
    input, select {
        width:100%;
        padding:10px;
        border-radius:10px;
        border:2px solid #FF8DC7;
        outline:none;
        font-size:15px;
    }
    input:focus, select:focus {
        border-color:#FF2F87;
    }
    button {
        width:100%;
        background:#FF2F87;
        color:white;
        border:none;
        padding:12px;
        border-radius:10px;
        font-size:16px;
        font-weight:bold;
        cursor:pointer;
        margin-top:8px;
        transition:.25s;
    }
    button:hover { background:#ff0a72; }

    .back {
        display:block;
        text-align:center;
        margin-top:12px;
        font-weight:bold;
        color:#FF2F87;
        text-decoration:none;
    }
    .back:hover { text-decoration:underline; }
</style>

</head>
<body>
<div class="card">

<h2>Edit Transaksi Laundry</h2>

<?php if($msg != ""): ?>
<div class="alert"><?= $msg ?></div>
<?php endif; ?>

<form method="POST">
    <div class="form-group">
        <label>Tanggal Masuk</label>
        <input type="date" name="masuk" value="<?= $row['masuk'] ?>" required>
    </div>

    <div class="form-group">
        <label>Tanggal Keluar</label>
        <input type="date" name="keluar" value="<?= $row['keluar'] ?>" required>
    </div>

    <div class="form-group">
        <label>Nama Konsumen</label>
        <input type="text" name="nama_konsumen" value="<?= $row['nama_konsumen'] ?>" required>
    </div>

    <div class="form-group">
        <label>Berat (Kg)</label>
        <input type="number" min="1" name="berat" value="<?= $row['berat'] ?>" required>
    </div>

    <div class="form-group">
        <label>Kategori</label>
        <select name="kategori" required>
            <option value="Normal" <?= ($row['kategori']=="Normal")?'selected':''; ?>>Normal</option>
            <option value="Expert" <?= ($row['kategori']=="Expert")?'selected':''; ?>>Expert</option>
        </select>
    </div>

    <div class="form-group">
        <label>Harga Satuan</label>
        <input type="number" min="1" name="harga_satuan" value="<?= $row['harga_satuan'] ?>" required>
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status" required>
            <option value="Proses" <?= ($row['status']=="Proses")?'selected':''; ?>>Proses</option>
            <option value="Selesai" <?= ($row['status']=="Selesai")?'selected':''; ?>>Selesai</option>
            <option value="Sudah Diambil" <?= ($row['status']=="Sudah Diambil")?'selected':''; ?>>Sudah Diambil</option>
        </select>
    </div>

    <button type="submit" name="update">UPDATE DATA</button>
</form>

<a href="tampil_transaksi.php" class="back">Kembali</a>

</div>
</body>
</html>