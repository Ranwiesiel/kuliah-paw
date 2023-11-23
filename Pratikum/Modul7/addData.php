<?php
require 'koneksi.inc';

$sql = mysqli_query($koneksi, "SELECT * FROM tb_rekammedis");

if(isset($_POST['proses'])){
	$idrm = "RM0001";
	
	if(mysqli_num_rows($sql)) {
		$raw_idrm = mysqli_query($koneksi, "SELECT id_rm FROM tb_rekammedis ORDER BY id_rm DESC LIMIT 1");
		$idrm = mysqli_fetch_assoc($raw_idrm)['id_rm'];
		$id = intval(substr($idrm, 2))+1;

		if(strlen($id) == 1){
			$idrm = substr($idrm,0, 5) . strval($id);
		} else if(strlen($id) == 2){
			$idrm = substr($idrm,0, 4) . strval($id);
		} else if(strlen($id) == 3){
			$idrm = substr($idrm,0, 3) . strval($id);
		} else {
			echo "Invalid";
		}
	}
	mysqli_query($koneksi, "INSERT INTO tb_rekammedis(id_rm, id_pasien, keluhan, id_dokter, diagnosa, id_poli, tgl_periksa) VALUES
		('$idrm', '$_POST[pasien]', '$_POST[keluhan]', '$_POST[dokter]', '$_POST[diagnosa]', '$_POST[poli]', '$_POST[tgl_periksa]')");

	header("Location: index.php");
}

$raw_pasien = mysqli_query($koneksi, "SELECT id_pasien, nama_pasien FROM tb_pasien");
$raw_dokter = mysqli_query($koneksi, "SELECT id_dokter, nama_dokter, spesialis FROM tb_dokter");
$raw_poli = mysqli_query($koneksi, "SELECT id_poli, nama_poli FROM tb_poliklinik");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tambah Data</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h2 class="mb-3 mt-3 s-block"><b>Tambah Rekam Medis</h2>
		<form method='post' action=''>
			<b>
			<label for="pasien" class='mt-3'>Pasien</label>
			<select class="form-select mb-3" name='pasien'>
				<?php while($row = mysqli_fetch_assoc($raw_pasien)): ?>
					<option value='<?= $row['id_pasien'] ?>'><?= $row['nama_pasien'] ?></option>	
				<?php endwhile; ?>
			</select>

			<label for="keluhan">Keluhan</label>
			<textarea name="keluhan" class="form-control mb-3" style="height: 100px;" required></textarea>

			<label for="dokter">Dokter</label>
			<select class="form-select mb-3" name='dokter'>
				<?php while($row = mysqli_fetch_assoc($raw_dokter)): ?>
					<option value='<?= $row['id_dokter'] ?>'><?= $row['nama_dokter'] ?> / <?= $row['spesialis'] ?></option>	
				<?php endwhile; ?>
			</select>

			<label for="diagnosa">Diagnosa</label>
			<textarea name="diagnosa" class="form-control mb-3" style="height: 100px;" required></textarea> 

			<label for="poli">Poli</label>
			<select class="form-select mb-3" name='poli'>
				<?php while($row = mysqli_fetch_assoc($raw_poli)): ?>
					<option value='<?= $row['id_poli'] ?>'><?= $row['nama_poli'] ?></option>	
				<?php endwhile; ?>
			</select>

			<label for='tgl_periksa'>Tanggal Periksa</label>
			<input type='date' class="form-control mb-3" name='tgl_periksa' required>
			</b>

			<a href="index.php" class="btn btn-primary" role="button">Kembali</a>
			<input type="submit" class="btn btn-success" name="proses">
		</form>
	</div>
</body>
</html>