<?php
include "koneksi.inc";
if(isset($_GET['idorder'])){
	$idorder = $_GET['idorder'];
	$raw_sql = mysqli_query($koneksi, "SELECT menu.nama_makanan, menu.harga, order_detil.jumlah, order_detil.subtotal, order_detil.id FROM menu INNER JOIN order_detil ON (order_detil.id_menu = menu.id_makanan) WHERE order_detil.id_order = '$idorder'");
	$total = mysqli_query($koneksi, "SELECT SUM(subtotal) total, SUM(jumlah) jumlah FROM order_detil WHERE id_order = '$idorder'") -> fetch_all(MYSQLI_ASSOC);
	$total_harga = ($total[0]["total"] > 0) ? $total[0]["total"] : '0';	
	$total_qty = ($total[0]["jumlah"] > 0) ? $total[0]["jumlah"] : '0';	
} else{
	$idorder = "Invalid";
}

function rupiah ($angka) {
    $hasil = 'Rp ' . number_format($angka, 2, ",", ".");
    return $hasil;
}

$ind = 0;

?>

<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Order Detil</title>

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
			<div class="col-md-auto">
				<h3 style="font-family: Cursive;">Order Detil<br>
					ID Order <?= $idorder ?>
				</h3>

				<table class="table table-bordered">
				    <tr class="table-light">
				        <th>No</th>
				        <th>Makanan</th>
				        <th>Harga</th>
				        <th>Jumlah</th>
				        <th>Subtotal</th>
				        <th>Aksi</th>
				    </tr>
				    <?php $ind=1; while($row = mysqli_fetch_assoc($raw_sql)): ?>
				    	<tr>
				    		<td><?= $ind++ ?></td>
				    		<td><?= $row['nama_makanan'] ?></td>
				    		<td><?= rupiah($row['harga']) ?></td>
				    		<td align="center"><?= $row['jumlah'] ?></td>
				    		<td><?= rupiah($row['subtotal']) ?></td>
				    		<td><a class='btn btn-light' onclick="return confirm('Apakah anda yakin ingin menghapus item ini?')" href='?idorder=<?= $idorder ?>&kode=<?= $row['id']; ?>'>Hapus</a></td>
				    	</tr>
				    <?php endwhile; ?>
					<tr class="table-light">
						<th colspan="3">Total:</th>
						<td  align="center"><?=$total_qty?></td>
						<td colspan="2"><?=rupiah($total_harga)?></td>
					</tr>
				</table>
				<a class="btn btn-primary" href="order.php">Kembali</a>
				<a class="btn btn-primary" href="insertOrderDetil.php?idorder=<?= $idorder ?>">Tambah Menu</a>
			</div>
		</div>
	</div>
</body>
</html>

<?php
if(isset($_GET['kode'])){
    mysqli_query($koneksi,"DELETE FROM order_detil WHERE id='$_GET[kode]'");

    echo "Data telah terhapus";
    echo "<meta http-equiv=refresh content=2;URL='orderDetil.php?idorder=$idorder'>";
}
?>