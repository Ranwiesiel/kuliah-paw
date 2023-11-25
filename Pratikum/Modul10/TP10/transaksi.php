<?php
require 'koneksi.inc';
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header("location: login.php");
}

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

$batas = 10;
$hal = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
$hal_awal = ($hal > 1) ? ($hal * $batas) - $batas : 0;

$prev = $hal - 1;
$next = $hal + 1;

$data = mysqli_query($koneksi, "SELECT * FROM transaksi");
$no = $hal_awal + 1;

$result = mysqli_query($koneksi, "SELECT * FROM transaksi LIMIT $hal_awal, $batas");

if (isset($_GET["search"])){
    $search = $_GET["search"];

    $data = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE
    id LIKE '%$search%' OR
    pelanggan_id LIKE '%$search%' OR
    waktu_transaksi LIKE '%$search%' OR
    keterangan LIKE '%$search%' OR
    total LIKE '%$search%'
    ");

    $result = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE
    id LIKE '%$search%' OR
    pelanggan_id LIKE '%$search%' OR
    waktu_transaksi LIKE '%$search%' OR
    keterangan LIKE '%$search%' OR
    total LIKE '%$search%'
    LIMIT $hal_awal, $batas
    ");
}

$jumlah_data = mysqli_num_rows($data);
$total_hal = ceil($jumlah_data / $batas);

$filter_param = '?';
if (isset($_GET['search'])){
	$cari = $_GET['search'];
	$filter_param = "?search=".$cari."&";
}
if (isset($_GET['sort'])){
    $sort = $_GET['sort'];
    $filter_param = "?search=".$cari."&sort=".$sort."&";
}



function rupiah($angka){
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup" aria-expanded="false">
                <ul class="nav navbar-nav me-auto">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    <?php if($_SESSION["level"] == "1") { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Data Master
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                    <a class="nav-link active" href="transaksi.php">Transaksi</a>
                    <a class="nav-link" href="#">Laporan</a>
                </ul>
                <ul class="nav navbar-nav d-flex">
                    <li class="me-4">
                        <form method="get" action="">
                            <div class="input-group ">
                                <input type="text" name="search" class="form-control" placeholder="Search..." autocomplete="off">
                                <button class="btn btn-secondary" type="submit"><i class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                            <i class="bi bi-person-fill"></i>
                            <?= $_SESSION["username"] ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="?logout" class="ms-4">
                                    <i class="bi bi-box-arrow-left"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr class="table-secondary">
                            <th scope="col">No</th>
                            <th scope="col">Id</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Pelanggan Id</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($result as $row) : ?>
                            <tr>
                                <td width=4%><?= $no++ ?>.</td>
                                <td width=6%><?= $row['id'] ?></td>
                                <td width=13%><?= $row['waktu_transaksi'] ?></td>
                                <td width=13%><?= $row['pelanggan_id'] ?></td>
                                <td><?= $row['keterangan'] ?></td>
                                <td width=14%><?= rupiah($row['total']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if(mysqli_num_rows($result) > 1){ ?>
            <nav class="text-center">

                <span>Menampilkan <?=$hal_awal+1 ."-". $no-1?> data dari <?=mysqli_num_rows($data)?> data</span>

                <ul class="pagination justify-content-center mt-3">
                    <li class="page-item <?= ($hal <= 1) ? "disabled" : ''; ?>">
                        <a class="page-link" href='<?=(!$_SERVER['QUERY_STRING'] ? "?" : $filter_param)?>hal=<?= $prev ?>'>Previous</a>
                    </li>

                    <?php for ($x = 1; $x <= $total_hal; $x++) { ?>
                        <li class="page-item <?= ($hal == $x) ? "active" : ''; ?>">
                            <a class="page-link" href='<?=(!$_SERVER['QUERY_STRING'] ? "?" : $filter_param)?>hal=<?= $x ?>'><?= $x ?></a>
                        </li>
                    <?php } ?>

                    <li class="page-item <?= ($hal >= $total_hal) ? "disabled" : ''; ?>">
                        <a class="page-link" href='<?=(!$_SERVER['QUERY_STRING'] ? "?" : $filter_param)?>hal=<?= $next ?>'>Next</a>
                    </li>
                </ul>
            </nav>
        <?php } else {echo "<span>Menampilkan 0 hasil</span>";}?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
