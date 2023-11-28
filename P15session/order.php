<?php
include "koneksi.inc";
session_start();

function rupiah($angka)
{
	$hasil = 'Rp ' . number_format($angka, 2, ",", ".");
	return $hasil;
}

$batas = 10;
$hal = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
$hal_awal = ($hal > 1) ? ($hal * $batas) - $batas : 0;

$prev = $hal - 1;
$next = $hal + 1;

$data = mysqli_query($koneksi, "SELECT * FROM orderr");
$jumlah_data = mysqli_num_rows($data);
$total_hal = ceil($jumlah_data / $batas);

$result = mysqli_query($koneksi, "SELECT * FROM orderr LIMIT $hal_awal, $batas");
$no = $hal_awal + 1;

$sort_desc = mysqli_query($koneksi, "SELECT * FROM orderr ORDER BY tanggal DESC, jam DESC LIMIT $hal_awal, $batas");
$sort_asc = mysqli_query($koneksi, "SELECT * FROM orderr ORDER BY tanggal, jam LIMIT $hal_awal, $batas");

if (isset($_GET['search'])) {
	$search = $_GET['search'];

	$data = mysqli_query($koneksi, "SELECT * FROM orderr WHERE
		tanggal LIKE '%$search%' OR
		no_meja LIKE '%$search%' OR
		jam LIKE '%$search%' OR
		no_meja LIKE '%$search%' OR
		pelayan LIKE '%$search%' OR
		id_order LIKE '%$search%'
	");

	$result = mysqli_query($koneksi, "SELECT * FROM orderr WHERE
		tanggal LIKE '%$search%' OR
		no_meja LIKE '%$search%' OR
		jam LIKE '%$search%' OR
		no_meja LIKE '%$search%' OR
		pelayan LIKE '%$search%' OR
		id_order LIKE '%$search%'
		LIMIT $hal_awal, $batas
	");

	$jumlah_data = mysqli_num_rows($data);
	$total_hal = ceil($jumlah_data / $batas);

	$sort_desc = mysqli_query($koneksi, "SELECT * FROM orderr WHERE
		tanggal LIKE '%$search%' OR
		no_meja LIKE '%$search%' OR
		jam LIKE '%$search%' OR
		no_meja LIKE '%$search%' OR
		pelayan LIKE '%$search%' OR
		id_order LIKE '%$search%'
		ORDER BY tanggal DESC, jam DESC LIMIT $hal_awal, $batas
	");

	$sort_asc = mysqli_query($koneksi, "SELECT * FROM orderr WHERE
		tanggal LIKE '%$search%' OR
		no_meja LIKE '%$search%' OR
		jam LIKE '%$search%' OR
		no_meja LIKE '%$search%' OR
		pelayan LIKE '%$search%' OR
		id_order LIKE '%$search%'
		ORDER BY tanggal, jam LIMIT $hal_awal, $batas
	");
}


$filter_param = "?";

if (isset($_GET['sort'])) {
	$data_sort = $_GET;

	if ($data_sort['sort'] == 'ascT') {
		$result = $sort_asc;
	} elseif ($data_sort['sort'] == 'descT') {
		$result = $sort_desc;
	}
} else {
	$result = $result;
}

if (isset($_GET['search'])) {
	$cari = $_GET['search'];
	$filter_param = "?search=" . $cari . "&";
	if (isset($_GET['sort'])) {
		$sort = $_GET['sort'];
		$filter_param = "?search=" . $cari . "&sort=" . $sort . "&";
	}
} else if (isset($_GET['sort'])) {
	$sort = $_GET['sort'];
	$filter_param = "?sort=" . $sort . "&";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Order</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
		<div class="container">
			<a class="navbar-brand" href="index.php" style="font-family: cursive; color: blue;">DaiRW</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav">
						<a class="nav-item nav-link" href="menu.php">Menu</a>
						<a class="nav-item nav-link active" href="order.php">Order</a>
					</ul>
				<ul class="nav navbar-nav me-auto">
					<li class="nav-item dropdown">
						<a class="dropdown-toggle nav-link" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
							<i class="bi bi-person-fill"></i>
							<?= $_SESSION["nama"] ?>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li>
								<a class="dropdown-item" href="logout.php" class="ms-4">
									<i class="bi bi-box-arrow-left"></i>
									Logout
								</a>
							</li>
						</ul>
					</li>
				</ul>
				<form method="get" action="">
					<div class="input-group">
						<span class="input-group-text">Search All</span>
						<input class="form-control" type="search" placeholder="Search..." aria-label="Search" name="search" autocomplete="off">
						<button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
					</div>
				</form>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="d-flex justify-content-between mb-3 mt-3">
					<h3 style="font-family: Cursive;">Order</h3>
					<a class="btn btn-primary" href="insertOrder.php">Tambah Orderan</a>
				</div>
				<?php if (mysqli_num_rows($result) > 1) { ?>
					<div class="table-responsive">
						<table class="table table-bordered table-hover ">
							<tr class="table-light">
								<th class="text-center">No</th>
								<th>Kode Order</th>
								<th>Tanggal
									<?php if (!isset($data_sort['sort']) || $data_sort['sort'] == 'ascT') : ?>
										<a href='<?= ((isset($_GET['hal']) || count($_GET) == 0 || isset($_GET['sort'])) && !isset($_GET['search'])) ? '?' : "$filter_param" ?>sort=descT'><i class="fa fa-sort-asc"></i></a>

									<?php else : ?>
										<a href='<?= ((isset($_GET['hal']) || isset($_GET['sort'])) && !isset($_GET['search'])) ? '?' : "$filter_param" ?>sort=ascT'><i class="fa fa-sort-desc"></i></a>
									<?php endif; ?>
								</th>
								<th>Jam</th>
								<th>Pelayan</th>
								<th>No Meja</th>
								<th>Total Harga</th>
								<th>Edit</th>
							</tr>

							<?php
							while ($row = mysqli_fetch_assoc($result)) {
								$raw_total = mysqli_query($koneksi, "SELECT SUM(subtotal) total FROM order_detil WHERE id_order = '$row[id_order]'");
								$total = mysqli_fetch_array($raw_total)['total'];
								$total = ($total > 0) ? $total : '0';
							?>
								<tr>
									<td align='center'><?= $no ?></td>
									<td><?= $row['id_order'] ?></td>
									<td><?= $row['tanggal'] ?></td>
									<td><?= $row['jam'] ?></td>
									<td><?= $row['pelayan'] ?></td>
									<td><?= $row['no_meja'] ?></td>
									<td><?= rupiah($total) ?></td>
									<td><a class='btn btn-light' href='orderDetil.php?idorder=<?= $row['id_order'] ?>'>Lihat Pesanan</a></td>
								</tr>
							<?php $no++;
							} ?>
						</table>
					</div>
				<?php } else {
					echo "<h4>Data tidak ditemukan!</h4>";
				} ?>
			</div>
		</div>
		<?php if (mysqli_num_rows($result) > 1) { ?>
			<nav class="text-center">



				<span>Menampilkan <?= intval($hal_awal + 1) . "-" . intval($no - 1) ?> data dari <?= intval(mysqli_num_rows($data)) ?> total data</span>
				<ul class="pagination justify-content-center mt-3">
					<li class="page-item <?= ($hal <= 1) ? "disabled" : ''; ?>">
						<a class="page-link" href='<?= (!$_SERVER['QUERY_STRING'] ? "?" : $filter_param) ?>hal=<?= $prev ?>'>Previous</a>
					</li>
					<?php for ($x = 1; $x <= $total_hal; $x++) { ?>
						<li class="page-item <?= ($hal == $x) ? "active" : ''; ?>">
							<a class="page-link" href='<?= (!$_SERVER['QUERY_STRING'] ? "?" : $filter_param) ?>hal=<?= $x ?>'><?= $x ?></a>
						</li>
					<?php } ?>
					<li class="page-item <?= ($hal >= $total_hal) ? "disabled" : ''; ?>">
						<a class="page-link" href='<?= (!$_SERVER['QUERY_STRING'] ? "?" : $filter_param) ?>hal=<?= $next ?>'>Next</a>
					</li>
				</ul>

			</nav>
		<?php } else {
			echo "<span>Menampilkan 0 hasil</span>";
		} ?>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>