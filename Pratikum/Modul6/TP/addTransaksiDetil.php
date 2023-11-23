<?php
require "koneksi.inc";

$barang = mysqli_query($koneksi, "SELECT id,nama_barang,harga FROM barang");

// ambil semua dari barang id transaksi
$idbr_transaksi = mysqli_query($koneksi, "SELECT barang.nama_barang FROM transaksi_detail INNER JOIN barang ON barang.id = transaksi_detail.barang_id");

$fetch_idbr = [];
while ($row = mysqli_fetch_assoc($idbr_transaksi)) {
	$fetch_idbr[] = $row['nama_barang'];
}


// Ambil semua pelanggan
$raw_pelanggan = mysqli_query($koneksi, "SELECT id, nama FROM pelanggan");


if(isset($_POST['proses'])){

	// Insert into transaksi
	mysqli_query($koneksi, "INSERT INTO transaksi(keterangan, total, pelanggan_id) VALUES
		('$_POST[keterangan]', $_POST[total_harga], $_POST[pelanggan])"
	);

	// Ambil id terakhir dari table transaksi
	$id_transaksi = mysqli_insert_id($koneksi);

	// mengurangi stok dalam barang
	mysqli_query($koneksi, "UPDATE barang SET
		stok = stok - $_POST[qty]
		WHERE id = $_POST[barang]");
	
	// Insert into transaksi_detail
	mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
		($id_transaksi, $_POST[barang], $_POST[harga], $_POST[qty])"
	);

	echo "<h4 style='margin-left: 9%; margin-top: 5%;'>Data Telah Ditambahkan</h4>";
	echo "<meta http-equiv=refresh content=1;URL='index.php'>";

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Master Detail</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
	<div class='container mt-5'>
		<div class="row justify-content-md-center">
			<div class="col">
				<h2 class=''>Master Detail</h2>
				<form method="post" action="">
					<div class="row form-group mb-3">
						<div class="col-2">
							<label for="pelanggan">Pelanggan</label>
						</div>
						<div class="col-10">
							<select class="form-select" name="pelanggan">
								<?php while($pelanggan = mysqli_fetch_assoc($raw_pelanggan)): ?>
									<option value="<?= $pelanggan['id'] ?>"><?= $pelanggan['nama'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
					</div>
					<div class="row form-group mb-3">
						<div class="col-2">
							<label for="barang">Nama Barang</label>
						</div>
						<div class="col-10">
							<select class="form-select" name="barang" id="barang" onchange="harga_barang(); total()">
								<?php while($isi_barang = mysqli_fetch_assoc($barang)): ?>
									<?php if(!in_array($isi_barang['nama_barang'], $fetch_idbr)): ?>
										<option value="<?= $isi_barang['id'] ?>" data-harga=<?= $isi_barang['harga'] ?>><?= $isi_barang['nama_barang']; ?></option>
									<?php endif; ?>
								<?php endwhile; ?>
							</select>
						</div>
					</div>
					<div class="row form-group mb-3">
						<div class="col-2">
							<label for="harga">Harga</label>
						</div>
						<div class="col-10">
							<input readonly class="form-control mb-3" type="number" name="harga" id="harga" placeholder="Harga Barang">
						</div>
					</div>
					<div class="row form-group mb-3">
						<div class="col-2">
							<label for="qty">Jumlah</label>
						</div>
						<div class="col-10">
							<input class="form-control mb-3" type="number" min=1 name="qty" id="qty" placeholder="Jumlah Barang"  onchange="total()">
						</div>
					</div>
					<div class="row form-group mb-3">
						<div class="col-2">
							<label for="total">Total Harga</label>
						</div>
						<div class="col-10">
							<input readonly class="form-control mb-3" placeholder="Total Harga" type="number" name="total_harga" id="total_harga">
						</div>
					</div>
					<div class="row form-group mb-3">
						<div class="col-2">
							<label for="keterangan">Keterangan</label>
						</div>
						<div class="col-10">
							<textarea class="form-control mb-3" rows="3" type="textarea" name="keterangan" id="keterangan" placeholder="Keterangan"></textarea>

							
							<button type="submit" name="proses" class="btn btn-success">Simpan</button>
							<a class="btn btn-danger" href="barang.php">Batal</a>
						</div>
					</div>
				</form>
				
				<?php
				$raw_isi = mysqli_query($koneksi,"SELECT pelanggan.nama, td.harga, td.qty, barang.kode_barang, barang.nama_barang, barang.stok, transaksi.waktu_transaksi, transaksi.keterangan, transaksi.total, supplier.nama sup_nama FROM transaksi_detail AS td
				INNER JOIN transaksi ON td.transaksi_id = transaksi.id
				INNER JOIN barang ON td.barang_id = barang.id
				INNER JOIN supplier ON barang.supplier_id = supplier.id
				INNER JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id");
				
				?>

				<table class="table table table-bordered">
					<tr>
						<th>No</th>
						<th>Tanggal Transaksi</th>
						<th>Nama</th>
						<th>Kode Barang</th>
						<th>Barang</th>
						<th>Supplier</th>
						<th>Keterangan</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Total</th>
					</tr>
					<?php $ind=1; while($row = mysqli_fetch_assoc($raw_isi)): ?>
						<tr>
							<td><?=$ind++?></td>
							<td><?=$row['waktu_transaksi']?></td>
							<td><?=$row['nama']?></td>
							<td><?=$row['kode_barang']?></td>
							<td><?=$row['nama_barang']?></td>
							<td><?=$row['sup_nama']?></td>
							<td><?=$row['keterangan']?></td>
							<td><?=$row['harga']?></td>
							<td><?=$row['qty']?></td>
							<td><?=$row['total']?></td>
						</tr>
					<?php endwhile; ?>
				</table>

			</div>
		</div>
	</div>
</body>
</html>

<script>
	function harga_barang(){
		let barang = document.getElementById("barang");
		let opsi = barang.options[barang.selectedIndex];
		let harga_bar = opsi.getAttribute('data-harga');
		let harga = document.getElementById("harga");

		harga.value = harga_bar;
	}

	function total(){
		let harga = document.querySelector("#harga");
		let qty = document.querySelector("#qty");
		let total = document.querySelector("#total_harga");

		total.value = harga.value * qty.value;
	}
</script>