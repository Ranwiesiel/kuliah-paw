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

$batas = 2;
$filter_param = '?';
$search = '';

if (isset($_GET['view'])){
	$batas = $_GET['view'];
    $filter_param = "?view=$batas&";
}

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

    $search = (isset($_GET['search']) ? "WHERE
    id LIKE '%$search%' OR
    pelanggan_id LIKE '%$search%' OR
    waktu_transaksi LIKE '%$search%' OR
    keterangan LIKE '%$search%' OR
    total LIKE '%$search%'
    " : "");
}

// echo $_SERVER['QUERY_STRING'];
if (isset($_GET['sort'])){
    $sort = $_GET['sort'];
    $kolom = $_GET['s'];
    if ($sort == "desc"){
        $result = mysqli_query($koneksi, "SELECT * FROM transaksi $search ORDER BY $kolom DESC LIMIT $hal_awal, $batas");
    } else {
        $result = mysqli_query($koneksi, "SELECT * FROM transaksi $search ORDER BY $kolom LIMIT $hal_awal, $batas ");
    } 
}


if (isset($_GET['search'])){
	$cari = $_GET['search'];
	$filter_param = "?search=".$cari."&";
    if (isset($_GET['hal'])){
        $p = $_GET['hal'];
        $filter_param = "?search=".$cari."&";
    }
}

if (isset($_GET['tgl_awal'])){
    $tgl_awal = $_GET['tgl_awal'];
    $tgl_tujuan = $_GET['tgl_tujuan'];
    $data = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE waktu_transaksi BETWEEN '$tgl_awal' AND '$tgl_tujuan'");
    $result = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE waktu_transaksi BETWEEN '$tgl_awal' AND '$tgl_tujuan' LIMIT $hal_awal, $batas");
    $filter_param = "?tgl_awal=".$tgl_awal."&tgl_tujuan=".$tgl_tujuan."&view=".$batas."&";
}

$jumlah_data = mysqli_num_rows($data);
$total_hal = ceil($jumlah_data / $batas);

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
    <script src="https://kit.fontawesome.com/47a76e5697.js" crossorigin="anonymous"></script>
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
                            <div class="input-group">
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
    <div class="container mt-2">
        <div class="row">
            <div class="col-3">
                <form method="get" action="">
                    <div class="input-group input-group-sm mb-3">
                        <?php if (isset($_GET['tgl_awal'])): ?>
                            <input type="hidden" name="tgl_awal" value="<?=$tgl_awal?>">
                            <input type="hidden" name="tgl_tujuan" value="<?=$tgl_tujuan?>">
                        <?php endif ?>
                        <?php if (isset($_GET['s'])): ?>
                            <input type="hidden" name="s" value="<?=$_GET['s']?>">
                            <input type="hidden" name="sort" value="<?=$_GET['sort']?>">
                        <?php endif ?>
                        <span class="input-group-text">Menampilkan</span>
                            <select class="form-select" name="view" onchange="this.form.submit()">
                                <?php
                                    $val = [5, 10, 20, 25]; 
                                    foreach($val as $key): ?>
                                            <option <?= (isset($_GET["view"]) && $_GET["view"] == $key) ? "selected" : "" ?> value="<?=$key?>"><?=$key?></option>
                                    <?php endforeach; ?>
                            </select>
                        <span class="input-group-text">data</span>
                    </div>
                </form>
            </div>
            <div class="col-5">
                <form method="get" action=''>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Filter tanggal</span>
                            <input type="date" class="form-control" name="tgl_awal">
                        <span class="input-group-text">sampai</span>     
                            <input type="date" class="form-control" name="tgl_tujuan">
                        <?php if (isset($_GET['view'])): ?>
                            <input type="hidden" name="view" value="<?=$_GET['view']?>">
                        <?php endif ?>
                        <button class="btn btn-secondary" type="submit">Filter</button>
                    </div>
                </form>
            </div>
        <div class="row">
            <div class="col">
            <?php if(mysqli_num_rows($result) > 0){ ?>
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr class="table-secondary">
                            <th width=5%>
                                No 
                            </th>
                            <th width=6%>
                                Id 
                                <?php if (!isset($_GET['sort']) || $_GET['sort'] == 'desc' && $_GET['s'] == "id") : ?>
                                    <a href="<?= (!$_SERVER['QUERY_STRING']) ? "?" : $filter_param ?>s=id&sort=asc"><i class="fa-solid fa-sort-down"></i></a>
                                <?php else : ?>
                                    <a href="<?= (!$_SERVER['QUERY_STRING']) ? "?" : $filter_param ?>s=id&sort=desc"><i class="fa-solid fa-sort-up"></i></a>
                                <?php endif ?>
                            </th>
                            <th width=13%>
                                Tanggal 
                                <?php if (!isset($_GET['sort']) || $_GET['sort'] == 'desc' && $_GET['s'] == "waktu_transaksi") : ?>
                                    <a href="<?= (!$_SERVER['QUERY_STRING']) ? "?" : $filter_param ?>s=waktu_transaksi&sort=asc"><i class="fa-solid fa-sort-down"></i></a>
                                <?php else : ?>
                                    <a href="<?= (!$_SERVER['QUERY_STRING']) ? "?" : $filter_param ?>s=waktu_transaksi&sort=desc"><i class="fa-solid fa-sort-up"></i></a>
                                <?php endif ?>
                            </th>
                            <th width=13%>
                                Pelanggan Id 
                                <?php if (!isset($_GET['sort']) || $_GET['sort'] == 'desc' && $_GET['s'] == "pelanggan_id") : ?>
                                    <a href="<?= (!$_SERVER['QUERY_STRING']) ? "?" : $filter_param ?>s=pelanggan_id&sort=asc"><i class="fa-solid fa-sort-down"></i></a>
                                <?php else : ?>
                                    <a href="<?= (!$_SERVER['QUERY_STRING']) ? "?" : $filter_param ?>s=pelanggan_id&sort=desc"><i class="fa-solid fa-sort-up"></i></a>
                                <?php endif ?>
                            </th>
                            <th scope="col">
                                Keterangan 
                                <?php if (!isset($_GET['sort']) || $_GET['sort'] == 'desc' && $_GET['s'] == "keterangan") : ?>
                                    <a href="<?= (!$_SERVER['QUERY_STRING']) ? "?" : $filter_param ?>s=keterangan&sort=asc"><i class="fa-solid fa-sort-down"></i></a>
                                <?php else : ?>
                                    <a href="<?= (!$_SERVER['QUERY_STRING']) ? "?" : $filter_param ?>s=keterangan&sort=desc"><i class="fa-solid fa-sort-up"></i></a>
                                <?php endif ?>
                            </th>
                            <th width=14%>
                                Total 
                                <?php if (!isset($_GET['sort']) || $_GET['sort'] == 'desc' && $_GET['s'] == "total") : ?>
                                    <a href="<?= (!$_SERVER['QUERY_STRING']) ? "?" : $filter_param ?>s=total&sort=asc"><i class="fa-solid fa-sort-down"></i></a>
                                <?php else : ?>
                                    <a href="<?= (!$_SERVER['QUERY_STRING']) ? "?" : $filter_param ?>s=total&sort=desc"><i class="fa-solid fa-sort-up"></i></a>
                                <?php endif ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $row) : ?>
                            <tr>
                                <td><?= $no++ ?>.</td>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['waktu_transaksi'] ?></td>
                                <td><?= $row['pelanggan_id'] ?></td>
                                <td><?= $row['keterangan'] ?></td>
                                <td><?= rupiah($row['total']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php } else {echo "<h3>Data tidak ditemukan</h3>";}?>
        </div>
        <?php if(mysqli_num_rows($result) > 0){ ?>
            <nav class="text-center">

                <span>Menampilkan <?=$hal_awal+1 ."-". $no-1?> data dari <?=mysqli_num_rows($data)?> data</span>

                <ul class="pagination justify-content-center mt-3">
                    <li class="page-item <?= ($hal <= 1) ? "disabled" : ''; ?>">
                        <a class="page-link" href='<?=(!$_SERVER['QUERY_STRING'] ? "?" : $filter_param)?><?= (isset($_GET['sort'])) ? "s=".$kolom."&sort=".$sort."&" : "" ?>hal=<?= $prev ?>'>Previous</a>
                    </li>

                    <?php for ($x = 1; $x <= $total_hal; $x++) { ?>
                        <li class="page-item <?= ($hal == $x) ? "active" : ''; ?>">
                            <a class="page-link" href='<?=(!$_SERVER['QUERY_STRING'] ? "?" : $filter_param)?><?= (isset($_GET['sort'])) ? "s=".$kolom."&sort=".$sort."&" : "" ?>hal=<?= $x ?>'><?= $x ?></a>
                        </li>
                    <?php } ?>

                    <li class="page-item <?= ($hal >= $total_hal) ? "disabled" : ''; ?>">
                        <a class="page-link" href='<?=(!$_SERVER['QUERY_STRING'] ? "?" : $filter_param)?><?= (isset($_GET['sort'])) ? "s=".$kolom."&sort=".$sort."&" : "" ?>hal=<?= $next ?>'>Next</a>
                    </li>
                </ul>
            </nav>
        <?php } else {echo "<span>Menampilkan 0 hasil</span>";}?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
