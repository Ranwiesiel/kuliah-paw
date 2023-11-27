<?php
include "koneksi.inc";
if (isset($_GET['noMeja'])) {
    $noMeja = $_GET['noMeja'];

} else {
    $noMeja = '';
}

date_default_timezone_set("Asia/Jakarta");
$timeNow = date("H:i:s");
$dateNow = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Order QR Code</title>

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
                <h3 style="font-family: Cursive;">Tambah Order QR Code</h3>
                <form method="post" action=''>
                    <label for="waktu">Waktu :</label>
                    <br>
                    <input class="form-control" type="text" name="no_meja" readonly value='<?=$dateNow .' '. $timeNow;?>'>

                    <label for="pelayan">Pelayan :</label>
                    <select class="form-select" name="pelayan">
                        <option value="Sabil">Sabil</option>
                        <option value="Fais">Fais</option>
                        <option value="Adi">Adi</option>
                    </select>

                    <label for="no_meja">No. Meja :</label>
                    <br>
                    <input class="form-control" type="number" required name="no_meja" <?= ($noMeja == '') ? '' : "value='$noMeja' readonly" ?>>

                    <br>
                    <input class="btn btn-primary" type="submit" value="Order" name="proses"> <a class="btn btn-primary" href="order.php">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


<?php

if(isset($_POST["proses"])){
    $no_meja = $_POST['no_meja'];
    $raw_meja = "SELECT tanggal, jam, no_meja FROM orderr WHERE no_meja = '$no_meja' ORDER BY id_order DESC LIMIT 1";
    $raw_meja = mysqli_query($koneksi, $raw_meja);
    $meja = mysqli_fetch_assoc($raw_meja);
    
    if (mysqli_num_rows($raw_meja)){ // Untuk mengecek apakah no meja sudah ada dalam database
        $jam = $meja['jam'];
        $tanggal = $meja['tanggal'];
        $lastDate = strtotime($tanggal);
        $lastDate = date("Y-m-d", $lastDate);
        $endTime = strtotime("+10 minutes", strtotime($jam));
        $endTime = date('H:i:s', $endTime);
        // mengambil waktu sekarang untuk kemudian dibandingkan

        if ($timeNow < $endTime && $dateNow <= $lastDate) { // mengecek, apakah tanggal dan jam sebelum batas waktu
            echo "<script>alert('Meja no $no_meja masih dalam proses pemesanan! Tunggu sampai waktu $endTime')</script>";
            die;
        }
    }

    // menambah field dari tabel pesan
    if (mysqli_query($koneksi,"INSERT INTO orderr(tanggal, jam, pelayan, no_meja) VALUES
        ('$dateNow','$timeNow', '$_POST[pelayan]' , '$_POST[no_meja]')"))
        {
            $id_order = mysqli_insert_id($koneksi);
            echo "Berhasil Order!";
            echo "<meta http-equiv=refresh content=1;URL='insertOrderDetil.php?idorder=$id_order'>";
        }

}
?>