<?php
if (isset($_GET['msg'])) {
    echo "<div class='alert'>".$_GET['msg']."</div>";
}

session_start();
include '../koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'");
    $data = mysqli_fetch_assoc($query);

    if ($data['username'] == $username && $data['password'] == $password) {
        session_start();
        $_SESSION['username'] = $username;
        header("Location: ../view/tampil_transaksi.php");
        exit();
    } else {
        echo "<script>alert('Login gagal!'); window.location='../login/login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login CRUD Laundry</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom right, #FFC4E1, #FF87B2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .card {
            background: #fff;
            width: 350px;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0px 0px 18px rgba(0,0,0,0.15);
            text-align: center;
        }

        h2 {
            color: #FF3E8A;
            font-weight: 700;
            margin-bottom: 20px;
        }

        input {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 10px;
            border: 2px solid #FFC4E1;
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: #FF3E8A;
        }

        button {
            background: #FF3E8A;
            border: none;
            color: white;
            padding: 12px 25px;
            width: 70%;
            border-radius: 25px;
            cursor: pointer;
            transition: 0.3s;
            font-size: 15px;
        }

        button:hover {
            background: #ff1f75;
            transform: scale(1.05);
        }

        .footer {
            font-size: 12px;
            color: #555;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="card">
        <h2>Dyah's Laundry Crafty</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="login">LOGIN</button>
        </form>
        <p class="footer">© <?= date("Y") ?> Laundry System</p>
    </div>

</body>
</html>