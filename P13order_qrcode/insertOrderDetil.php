<?php
include "koneksi.inc";

$menu = mysqli_query($koneksi,"SELECT * FROM menu"); // mengambil semua data dalam tabel menu

if(isset($_GET['idorder'])){
    $idorder = $_GET['idorder'];
} else{
    $idorder = "";
    echo "<h1>order invalid</h1>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Order Detil</title>

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
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3 style="font-family: Cursive;">Tambah Order Detil<br>
                    ID Order <?= $idorder ?>
                </h3>
                <form method="post" action=''>
                    <input type='hidden' name='idorder' value='<?= $idorder ?>'>
                    <label for="makanan">Makanan :</label>
                    <select class="form-select" name="makanan">
                    <?php while($row = mysqli_fetch_assoc($menu)): ?>
                            <option value="<?= $row['id_makanan'] ?>"><?= $row['nama_makanan'] . " / " . $row['harga'] ?></option>
                    <?php endwhile; ?>
                    </select>
                    <label for="jumlah">Jumlah :</label>
                    <br>
                    <input class="form-control" type="number" name="jumlah">

                    <br>
                    <input class="btn btn-primary" type="submit" value="Tambah" name="proses"> <a class="btn btn-primary" href="order.php">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


<?php

if(isset($_POST["proses"])){
    $raw_harga = mysqli_query($koneksi, "SELECT harga FROM menu WHERE id_makanan = '$_POST[makanan]'");
    $harga = mysqli_fetch_assoc($raw_harga)['harga'];
    $subtotal = $harga * $_POST['jumlah'];
    
    mysqli_query($koneksi,"INSERT INTO order_detil(id_order, id_menu, jumlah, harga, subtotal) VALUES
        ($_POST[idorder], $_POST[makanan], $_POST[jumlah], $harga, $subtotal)");

    echo "Berhasil Order!";
    echo "<meta http-equiv=refresh content=1;URL='order.php>";
}
?>