<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tambah Data</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
	<div class='container mt-5'>
		<div class="row justify-content-md-center">
			<div class="col-md-6">
				<h2 class=''>Tambah Data Master Supplier Baru</h2>
				<form method="post" action="">
					<div class="row form-group mb-3">
						<div class="col-2">
							<label for="nama">Nama</label>
						</div>
						<div class="col-10">
							<input type="text" class="form-control" name="nama" placeholder="nama">
						</div>
					</div>
					<div class="row form-group mb-3">
						<div class="col-2">
							<label for="telp">Telp</label>
						</div>
						<div class="col-10">
							<input type="number" class="form-control" name="telp" placeholder="telp">
						</div>
					</div>
					<div class="row form-group mb-3">
						<div class="col-2">
							<label for="alamat">Alamat</label>
						</div>
						<div class="col-10">
							<input type="text" class="form-control mb-3" name="alamat" placeholder="alamat">
							<button type="submit" name="tambah" class="btn btn-success">Simpan</button>
							<a class="btn btn-danger" href="index.php">Batal</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>

<?php 
include "koneksi.inc";
if(isset($_POST['tambah'])){
    mysqli_query($koneksi,"INSERT INTO supplier (nama, telp, alamat) VALUES 
    ('$_POST[nama]', 
    '$_POST[telp]', 
    '$_POST[alamat]')");

    header("Location: index.php");
}
?>