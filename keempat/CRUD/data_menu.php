<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Data Makanan</title>
</head>
<body>
    <h3>Menu Makanan</h3>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Kode Makanan</th>
            <th>Nama Makanan</th>
            <th>Harga Makanan</th>
            <th colspan=2>Edit</th>
        </tr>

        <?php

        include "koneksi.php";
        $no = 1;
        $data = mysqli_query($koneksi,"SELECT * FROM menu_makanan");
        while ($tampil = mysqli_fetch_array($data)){
            echo "
            <tr>
                <td>$no</td>
                <td>$tampil[id_makanan]</td>
                <td>$tampil[nama_makanan]</td>
                <td>$tampil[harga_makanan]</td>
                <td><a class='btn btn-light' href='?kode=$tampil[id_makanan]'>Hapus</a></td>
                <td><a class='btn btn-light' href='ubah_menu.php?kode=$tampil[id_makanan]'>Ubah</a></td>
            </tr>";

            $no++; /* increment */
        }

        ?>

    </table>
    <a class="btn btn-primary" href="general.php">Tambah Data</a>
</body>
</html>
<?php
if(isset($_GET['kode'])){
    mysqli_query($koneksi,"DELETE FROM menu_makanan WHERE id_makanan='$_GET[kode]'");

    echo "Data telah terhapus";
    echo "<meta http-equiv=refresh content=2;URL='data_menu.php'>";
}
?>