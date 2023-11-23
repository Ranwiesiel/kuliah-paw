<?php
include "koneksi.inc";
$data = mysqli_query($koneksi,"SELECT * FROM orderr");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Order</title>

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
		      <a class="nav-item nav-link" href="menu.php">Menu</a>
		      <a class="nav-item nav-link active" href="order.php">Order</a>
		      <a class="nav-item nav-link" href="orderDetil.php">Order Detil</a>
    		</div>
		</div>
	</nav>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-auto">
				<h3 style="font-family: Cursive;">Order</h3>

				<table class="table table-bordered">
				    <tr>
				        <th>No</th>
				        <th>Kode Order</th>
				        <th>Tanggal</th>
				        <th>Jam</th>
				        <th>Pelayan</th>
				        <th>No Meja</th>
				        <th colspan=2>Edit</th>
				    </tr>

				    <?php
				    $no = 1;
				    
				    while ($tampil = mysqli_fetch_array($data)){
				        echo "
				        <tr>
				            <td align='center'>$no</td>
				            <td>$tampil[id_order]</td>
				            <td>$tampil[tanggal]</td>
				            <td>$tampil[jam]</td>
				            <td>$tampil[pelayan]</td>
				            <td>$tampil[no_meja]</td>
				            <td><a class='btn btn-light' href='?kode=$tampil[id_order]'>Hapus</a></td>
				            <td><a class='btn btn-light' href='editOrder.php?kode=$tampil[id_order]'>Ubah</a></td>
				        </tr>";

				        $no++; /* increment */
				    }

				    ?>

				</table>
				<a class="btn btn-primary" href="insertOrder.php">Tambah Orderan</a>
			</div>
		</div>
	</div>
</body>
</html>

<?php
include "koneksi.inc";

if(isset($_GET['kode'])){
    mysqli_query($koneksi,"DELETE FROM order WHERE id_order='$_GET[kode]'");

    echo "Data telah terhapus";
    echo "<meta http-equiv=refresh content=2;URL='menu.php'>";
}

?>