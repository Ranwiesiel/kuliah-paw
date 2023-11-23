<?php
include "koneksi.inc";

$data = mysqli_query($koneksi,"SELECT * FROM menu"); // mengambil semua data dalam tabel menu
$tampil = mysqli_fetch_all($data, MYSQLI_ASSOC); // menjadikan data dalam tabel menu menjadi array assoc
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Order</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="index.php" style="margin-left: 10px; font-family: cursive; color: blue;">DaiRW</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="menu.php">Menu</a>
                <a class="nav-item nav-link" href="order.php">Order</a>
                <a class="nav-item nav-link" href="orderDetil.php">Order Detil</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3 style="font-family: Cursive;">Tambah Order</h3>
                <form method="post" action=''>
                    <label for="pelayan">Pelayan :</label>
                    <select class="form-select" name="pelayan">
                        <option value="Sabil">Sabil</option>
                        <option value="Fais">Fais</option>
                        <option value="Adi">Adi</option>
                    </select>

                    <label for="no_meja">No. Meja :</label>
                    <br>
                    <input class="form-control" type="number" name="no_meja">

                    <br>
                    <input class="btn btn-primary" type="submit" value="Order" name="proses"> <a class="btn btn-primary" href="order.php">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


<?php
date_default_timezone_set("Asia/Jakarta");
$jam = date("H:i:s");
$tanggal = date("Y-m-d");

if(isset($_POST["proses"])){

    // menambah field dari tabel pesan
    mysqli_query($koneksi,"INSERT INTO orderr SET
        tanggal = '$tanggal',
        jam = '$jam',
        pelayan = '$_POST[pelayan]',
        no_meja = '$_POST[no_meja]'");

    echo "Berhasil Order!";
    echo "<meta http-equiv=refresh content=1;URL='order.php'>";
}
?>