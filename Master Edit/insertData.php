<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu</title>

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
            <div class="col-md-auto">
                <h3 style="font-family: Cursive;">Tambah Menu Makanan</h3>

                <form action="" method="post">
                    <table class="table table-borderless">
                        <tr>
                            <td>Menu Baru</td>
                            <td><input type="text" name="nama_makanan"></td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td><input type="number" min=0 name="harga_makanan"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input class="btn btn-primary" type="submit" value="simpan" name="proses"> <a class="btn btn-primary" href="menu.php">Kembali</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
include "koneksi.inc";

if(isset($_POST["proses"])){
    mysqli_query($koneksi,"INSERT INTO menu SET
    nama_makanan = '$_POST[nama_makanan]',
    harga = '$_POST[harga_makanan]'");

    echo "Menu Berhasil Ditambahkan!";
    echo "<meta http-equiv=refresh content=1;URL='insertData.php'>";
}

?>