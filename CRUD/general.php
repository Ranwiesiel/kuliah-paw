<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Pengisian Menu</title>
</head>
<body>

<h3>Tambah Menu Makanan</h3>

<form action="" method="post">
    <table class="table table-borderless">
        <tr>
            <td>Menu Baru</td>
            <td><input type="text" name="nama_makanan"></td>
        </tr>
        <tr>
            <td>Harga Menu</td>
            <td><input type="number" min=0 name="harga_makanan"></td>
        </tr>
        <tr>
            <td></td>
            <td><input class="btn btn-primary" type="submit" value="simpan" name="proses"> <a class="btn btn-primary" href="data_menu.php">Lihat Data</a></td>
        </tr>
    </table>
</form>

    
</body>
</html>
<?php
include "koneksi.php";

if(isset($_POST["proses"])){
    mysqli_query($koneksi,"INSERT INTO menu_makanan SET
    nama_makanan = '$_POST[nama_makanan]',
    harga_makanan = '$_POST[harga_makanan]'");

    echo "Menu Berhasil Ditambahkan!";
    echo "<meta http-equiv=refresh content=1;URL='general.php'>";
}

?>