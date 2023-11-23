<?php
require 'koneksi.inc';
$query_supp = mysqli_query($koneksi, 'SELECT * FROM supplier');

$ind = 1;
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Data Master Supplier</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
	<div class='container mt-5'>
		<h2 class='float-start'>Data Master Supplier</h2>
		<a href='addData.php'><button type='button' class='btn btn-success float-end mb-5'>Tambah Data</button></a>
		<table class="table table-bordered">
			<thead class='table-primary'>
				<th>No</th>
				<th>Nama</th>
				<th>Telp</th>
				<th>Alamat</th>
				<th>Tindakan</th>
			</thead>
			<tbody>
				<?php while($row = mysqli_fetch_assoc($query_supp)) : ?>
					<tr>
						<td><?= $ind ?></td>
						<td><?= $row['nama'] ?></td>
						<td><?= $row['telp'] ?></td>
						<td><?= $row['alamat'] ?></td>
						<td width="15%">
							<a href='editData.php?kode=<?= $row['id'] ?>'><button type='button' class='btn btn-warning'>Edit</button></a>
							<a href='index.php?id=<?= $row['id'] ?>'><button onclick= "return confirm('Anda yakin akan menghapus supplier ini?')" type='button' class='btn btn-danger' value='hapus'>Hapus</button></a>
						</td>
					</tr>
					<?php $ind++ ?>
				<?php endwhile; ?> 
			</tbody>
		</table>
	</div>
</body>
</html>

<?php

if(isset($_GET['id'])){
	$id = $_GET['id'];
	mysqli_query($koneksi, "DELETE FROM supplier WHERE id=$id");
	echo "<h4 style='margin-left: 9%;'>Data Telah Hapus</h4>";
	echo "<meta http-equiv=refresh content=1;URL='index.php'>";
}
?>