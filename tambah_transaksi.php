<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit();
}

include "../koneksi.php";

$message = "";

if (isset($_POST['simpan'])) {
    $masuk = $_POST['masuk'];
    $keluar = $_POST['keluar'];
    $nama = trim($_POST['nama_konsumen']);
    $berat = (float) $_POST['berat'];
    $kategori = $_POST['kategori'];
    $harga_satuan = (float) $_POST['harga_satuan'];
    $total = $berat * $harga_satuan;
    $status = "Belum Diambil";

    if ($berat > 0 && $harga_satuan > 0) {
        $query = "INSERT INTO transaksi (masuk, keluar, nama_konsumen, berat, kategori, status, harga_satuan, harga_total)
                  VALUES ('$masuk', '$keluar', '$nama', '$berat', '$kategori', '$status', '$harga_satuan', '$total')";
        mysqli_query($conn, $query);

        $message = "Berhasil ditambahkan!";
    } else {
        $message = "Berat & harga harus lebih dari 0!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Transaksi</title>

<style>
    body {
        font-family: Poppins, sans-serif;
        background:#FFE4F3;
        padding:20px;
        display:flex;
        justify-content:center;
        align-items:center;
        min-height:100vh;
    }

    .card {
        background:white;
        width:450px;
        padding:30px;
        border-radius:18px;
        box-shadow:0 0 15px rgba(255, 105, 180, 0.25);
    }

    h2 {
        text-align:center;
        margin-bottom:20px;
        color:#FF2F87;
    }

    .alert {
        background:#FFB6D9;
        color:#A30050;
        padding:10px;
        margin-bottom:15px;
        border-radius:8px;
        font-weight:600;
        text-align:center;
        border:1.5px solid #ff7bbf;
    }

    .form-group { margin-bottom:15px; }

    label {
        font-weight:600;
        color:#FF2F87;
        display:block;
        margin-bottom:6px;
    }

    input, select {
        width:100%;
        padding:10px;
        border-radius:10px;
        border:2px solid #FF8DC7;
        font-size:15px;
        outline:none;
    }

    input:focus, select:focus {
        border-color:#FF2F87;
    }

    button {
        background:#FF2F87;
        border:none;
        color:white;
        padding:12px;
        border-radius:10px;
        font-size:16px;
        font-weight:bold;
        width:100%;
        cursor:pointer;
        transition:.2s;
        margin-top:8px;
    }

    button:hover { background:#ff0a72; }

    .back {
        display:block;
        text-align:center;
        margin-top:12px;
        color:#FF2F87;
        font-weight:bold;
        text-decoration:none;
    }
    .back:hover { text-decoration:underline; }
</style>

</head>
<body>
<div class="card">
<h2>Tambah Transaksi</h2>

<?php if ($message != ""): ?>
    <div class="alert"><?= $message ?></div>
<?php endif; ?>

<form method="POST">
    <div class="form-group">
        <label>Tanggal Masuk</label>
        <input type="date" name="masuk" required>
    </div>

    <div class="form-group">
        <label>Tanggal Keluar</label>
        <input type="date" name="keluar" required>
    </div>

    <div class="form-group">
        <label>Nama Konsumen</label>
        <input type="text" name="nama_konsumen" placeholder="Nama pelanggan" required>
    </div>

    <div class="form-group">
        <label>Berat (Kg)</label>
        <input type="number" name="berat" min="1" placeholder="Masukkan berat cucian" required>
    </div>

    <div class="form-group">
        <label>Kategori</label>
        <select name="kategori" required>
            <option value="">Pilih</option>
            <option value="Normal">Normal</option>
            <option value="Expert">Expert</option>
        </select>
    </div>

    <div class="form-group">
        <label>Harga Satuan</label>
        <input type="number" name="harga_satuan" min="1" value="4000" required>
    </div>

    <button type="submit" name="simpan">SIMPAN</button>
</form>

<a href="tampil_transaksi.php" class="back">Kembali</a>
</div>
</body>
</html>