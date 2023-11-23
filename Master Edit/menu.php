<?php
include "koneksi.inc";
$data = mysqli_query($koneksi,"SELECT * FROM menu");
$sort_by_desc = mysqli_query($koneksi, "SELECT * FROM menu ORDER BY nama_makanan DESC");
$sort_by_asc = mysqli_query($koneksi, "SELECT * FROM menu ORDER BY nama_makanan");

$sort_harga_asc = mysqli_query($koneksi, "SELECT * FROM menu ORDER BY harga");
$sort_harga_desc = mysqli_query($koneksi, "SELECT * FROM menu ORDER BY harga DESC");


if(isset($_GET['sort'])){
	$data_sort = $_GET;
	if($data_sort['sort'] == 'ascM'){
		$sort = $sort_by_asc;
	} elseif($data_sort['sort'] == 'descM'){
		$sort = $sort_by_desc;

	} elseif($data_sort['sort'] == 'ascH'){
		$sort = $sort_harga_asc;
	} elseif($data_sort['sort'] == 'descH'){
		$sort = $sort_harga_desc;
	}
} else{
	$sort = $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Menu</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
		      <a class="nav-item nav-link active" href="#">Menu</a>
		      <a class="nav-item nav-link" href="order.php">Order</a>
		      <a class="nav-item nav-link" href="orderDetil.php">Order Detil</a>
    		</div>
		</div>
	</nav>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-auto">
				<h3 style="font-family: Cursive;">Menu Makanan</h3>

				<table class="table table-bordered">
				    <tr>
				        <th>No</th>
				        <th>Kode Makanan</th>
				        <th>Nama Makanan 
							<?php if(!isset($data_sort['sort']) || $data_sort['sort'] == 'ascM'): ?>
								<a href='menu.php?sort=descM'><i class="fa fa-sort-asc"></i></a>
							<?php else: ?>
								<a href='menu.php?sort=ascM'><i class="fa fa-sort-desc"></i></a>
							<?php endif; ?>
						</th>
				        <th>Harga Makanan
				        	<?php if(!isset($data_sort['sort']) || $data_sort['sort'] == 'ascH'): ?>
								<a href='menu.php?sort=descH'><i class="fa fa-sort-asc"></i></a>
							<?php else: ?>
								<a href='menu.php?sort=ascH'><i class="fa fa-sort-desc"></i></a>
							<?php endif; ?>
				        </th>
				        <th colspan=2>Edit</th>
				    </tr>

				    <?php
				    $no = 1;
				    
				    while ($tampil = mysqli_fetch_array($sort)){
				        echo "
				        <tr>
				            <td align='center'>$no</td>
				            <td>$tampil[id_makanan]</td>
				            <td>$tampil[nama_makanan]</td>
				            <td>$tampil[harga]</td>
				            <td><a class='btn btn-light' href='?kode=$tampil[id_makanan]'>Hapus</a></td>
				            <td><a class='btn btn-light' href='editData.php?kode=$tampil[id_makanan]'>Ubah</a></td>
				        </tr>";

				        $no++; /* increment */
				    }

				    ?>

				</table>
				<a class="btn btn-primary" href="insertData.php">Tambah Data</a>
			</div>
		</div>
	</div>
</body>
</html>

<?php
include "koneksi.inc";

if(isset($_GET['kode'])){
    mysqli_query($koneksi,"DELETE FROM menu WHERE id_makanan='$_GET[kode]'");

    echo "Data telah terhapus";
    echo "<meta http-equiv=refresh content=2;URL='menu.php'>";
}

?>