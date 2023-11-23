<?php
include "koneksi.inc";

$pelayan_isi = ["Sabil", "Fais", "Adi"];
$sql = mysqli_query($koneksi,"SELECT * FROM orderr WHERE id_order='$_GET[kode]'");
$data = mysqli_fetch_array($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
            <div class="col-md-auto">
                <h3 style="font-family: Cursive;">Edit Orderan</h3>
                <form action="" method="post">
                    <table class="table">
                        <tr>
                            <td>Id Order</td>
                            <td><input class="form-control" type="text" name="id_order" value="<?= $data['id_order']; ?>" disabled></td>
                        </tr>
                        <tr>
                            <td>Pelayan</td>
                            <td>
                                <select class="form-select" name="pelayan">
                                <?php foreach($pelayan_isi as $pelayan): ?>
                                    <?php if($pelayan == $data['pelayan']): ?>
                                        <option value="<?= $pelayan ?>" selected><?= $pelayan ?></option>
                                        <?php else: ?>
                                            <option value="<?= $pelayan ?>"><?= $pelayan ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>No Meja</td>
                            <td><input class="form-control" type="number" min=0 name="no_meja" value="<?= $data['no_meja']; ?>"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input class="btn btn-primary" type="submit" value="simpan" name="proses"> <a class="btn btn-primary" href="order.php">Kembali</a></td>
                        </tr>
                    </table>
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

    mysqli_query($koneksi,"UPDATE orderr SET
    tanggal = '$tanggal',
    jam = '$jam',
    pelayan = '$_POST[pelayan]',
    no_meja = '$_POST[no_meja]'
    WHERE id_order = '$_GET[kode]'");

    echo "Data Menu Berhasil Diubah!";
    echo "<meta http-equiv=refresh content=1;URL='order.php'>";
}

?>