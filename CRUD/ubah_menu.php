<?php
include "koneksi.php";

$sql = mysqli_query($koneksi,"SELECT * FROM menu_makanan WHERE id_makanan='$_GET[kode]'");
$data = mysqli_fetch_array($sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Edit Menu</title>
</head>
<body>
    <h3>Tambah Menu Makanan</h3>
    <form action="" method="post">
        <table class="table">
            <tr>
                <td>Id Makanan</td>
                <td><input type="text" name="id_makanan" value="<?php echo $data['id_makanan']; ?>" disabled></td>
            </tr>
            <tr>
                <td>Menu Baru</td>
                <td><input type="text" name="nama_makanan" value="<?php echo $data['nama_makanan']; ?>"></td>
            </tr>
            <tr>
                <td>Harga Menu</td>
                <td><input type="number" min=0 name="harga_makanan" value="<?php echo $data['harga_makanan']; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn btn-primary" type="submit" value="simpan" name="proses"> <a class="btn btn-primary" href="data_menu.php">Kembali</a></td>
            </tr>
        </table>
    </form>
    
</body>
</html>
<?php

if(isset($_POST["proses"])){
    mysqli_query($koneksi,"UPDATE menu_makanan SET
    nama_makanan = '$_POST[nama_makanan]',
    harga_makanan = '$_POST[harga_makanan]'
    WHERE id_makanan = '$_GET[kode]'");

    echo "Data Menu Berhasil Diubah!";
    echo "<meta http-equiv=refresh content=1;URL='data_menu.php'>";
}

?>