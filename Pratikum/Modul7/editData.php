<?php
require 'koneksi.inc';
$id_rm = $_GET['id'];

$table = mysqli_query($koneksi, "SELECT tb_rm.id_rm, tb_pasien.id_pasien, tb_pasien.nama_pasien, tb_rm.keluhan, tb_dokter.id_dokter, tb_dokter.nama_dokter, tb_rm.diagnosa, tb_poliklinik.id_poli, tb_poliklinik.nama_poli, tb_rm.tgl_periksa FROM tb_rekammedis AS tb_rm
	INNER JOIN tb_pasien ON tb_rm.id_pasien = tb_pasien.id_pasien
	INNER JOIN tb_dokter ON tb_rm.id_dokter = tb_dokter.id_dokter
	INNER JOIN tb_poliklinik ON tb_rm.id_poli = tb_poliklinik.id_poli
	WHERE tb_rm.id_rm = '$id_rm'
	");
$row_isi = mysqli_fetch_assoc($table);

if(isset($_POST['proses'])){
    mysqli_query($koneksi, "UPDATE tb_rekammedis SET 
    id_pasien = '$_POST[pasien]',
    keluhan = '$_POST[keluhan]',
    id_dokter = '$_POST[dokter]',
    diagnosa = '$_POST[diagnosa]',
    id_poli = '$_POST[poli]',
    tgl_periksa = '$_POST[tgl_periksa]'
    WHERE id_rm = '$id_rm'");

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
		<h2 class="mb-3 mt-3 d-block">Edit Rekam Medis</h2>
		<form method='post' action=''>
			<b>
			<label for="pasien" class='mt-3'>Pasien</label>
			<select class="form-select mb-3" name='pasien'>
				<?php while($row = mysqli_fetch_assoc($raw_pasien)): ?>
					<?php $selected = ($row_isi['id_pasien'] == $row['id_pasien']) ? "selected" : ""; ?>
						<option value='<?= $row['id_pasien'] ?>' <?= $selected; ?>><?= $row['nama_pasien'] ?></option>	
				<?php endwhile; ?>
			</select>

			<label for="keluhan">Keluhan</label>
			<textarea name="keluhan" class="form-control mb-3" style="height: 100px;" required><?= $row_isi['keluhan'] ?></textarea>

			<label for="dokter">Dokter</label>
			<select class="form-select mb-3" name='dokter'>
				<?php while($row = mysqli_fetch_assoc($raw_dokter)): ?>
					<?php $selected = ($row_isi['id_dokter'] == $row['id_dokter']) ? "selected" : ""; ?>
					<option value='<?= $row['id_dokter'] ?>' <?= $selected; ?>><?= $row['nama_dokter'] ?> / <?= $row['spesialis'] ?></option>	
				<?php endwhile; ?>
			</select>

			<label for="diagnosa">Diagnosa</label>
			<textarea name="diagnosa" class="form-control mb-3" style="height: 100px;" required><?= $row_isi['diagnosa'] ?></textarea> 

			<label for="poli">Poli</label>
			<select class="form-select mb-3" name='poli'>
				<?php while($row = mysqli_fetch_assoc($raw_poli)): ?>
					<?php $selected = ($row_isi['id_poli'] == $row['id_poli']) ? "selected" : ""; ?>
					<option value='<?= $row['id_poli'] ?>' <?= $selected; ?>><?= $row['nama_poli'] ?></option>	
				<?php endwhile; ?>
			</select>

			<label for='tgl_periksa'>Tanggal Periksa</label>
			<input type='date' class="form-control mb-3" name='tgl_periksa' value="<?= $row_isi['tgl_periksa'] ?>" required>
			</b>

			<a href="index.php" class="btn btn-primary" role="button">Kembali</a>
			<input type="submit" class="btn btn-success" name="proses">
		</form>
	</div>
</body>
</html>