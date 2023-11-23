<?php
require 'koneksi.inc';

$table = mysqli_query($koneksi, "SELECT tb_rm.id_rm, tb_pasien.nama_pasien, tb_rm.keluhan, tb_dokter.nama_dokter, tb_rm.diagnosa, tb_poliklinik.nama_poli, tb_rm.tgl_periksa FROM tb_rekammedis AS tb_rm
	INNER JOIN tb_pasien ON tb_rm.id_pasien = tb_pasien.id_pasien
	INNER JOIN tb_dokter ON tb_rm.id_dokter = tb_dokter.id_dokter
	INNER JOIN tb_poliklinik ON tb_rm.id_poli = tb_poliklinik.id_poli
	");

if(isset($_GET['id'])){
	$id = $_GET['id'];
	mysqli_query($koneksi, "DELETE FROM tb_rekammedis WHERE id_rm = '$id'");
	header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CRUD</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
	<div class="container-fluid">
		<h2 class="mb-3 mt-3 float-start">Rekam Medis</h2>
		<a href="addData.php" class="btn btn-success mb-3 mt-3 float-end" role="button">Tambah Rekam Medis</a>
		<table class="table table-bordered">
			<tr class="table-secondary">
				<th>ID Rekam Medis</th>
				<th>Nama Pasien</th>
				<th>Keluhan</th>
				<th>Nama Dokter</th>
				<th>Diagnosa</th>
				<th>Nama Poli</th>
				<th>Tanggal Periksa</th>
				<th>Aksi</th>
			</tr>
				<?php while($row = mysqli_fetch_assoc($table)): ?>
					<tr>
						<td width=11%><?= $row['id_rm']; ?></td>
						<td><?= $row['nama_pasien']; ?></td>
						<td><?= $row['keluhan']; ?></td>
						<td><?= $row['nama_dokter']; ?></td>
						<td><?= $row['diagnosa']; ?></td>
						<td><?= $row['nama_poli']; ?></td>
						<td width=11%><?= $row['tgl_periksa']; ?></td>
						<td width=11%>
							<a href="editData.php?id=<?= $row['id_rm']; ?>" class="btn btn-primary" role="button">Edit</a>
							<a href="?id=<?= $row['id_rm']; ?>" class="btn btn-danger" role="button">Hapus</a>
						</td>
					</tr>
				<?php endwhile; ?>
		</table>
	</div>
</body>
</html>