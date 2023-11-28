<?php include "koneksi.inc"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Order Detil</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
		<a class="navbar-brand" href="index.php" style="margin-left: 10px; font-family: cursive; color: blue;">DaiRW</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>
  		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    		<div class="navbar-nav">
		      <a class="nav-item nav-link" href="menu.php">Menu</a>
		      <a class="nav-item nav-link" href="insertData.php">Tambah Menu</a>
		      <a class="nav-item nav-link" href="order.php">Order</a>
		      <a class="nav-item nav-link active" href="orderDetil.php">Order Detil</a>
    		</div>
		</div>
	</nav>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-auto">
				<h3 style="font-family: Cursive;">Detil Pesanan</h3>

				<table class="table table-bordered">
				    <tr>
				        <th>No</th>
				        <th>Kode Detil Order</th>
				        <th>Makanan</th>
				        <th>Tanggal & Jam Order</th>
				        <th>Pelayan</th>
				        <th>No Meja</th>
				    </tr>

				    <?php
				    $no = 1;
				    $data = mysqli_query($koneksi,"SELECT * FROM detil_pesan");

				    while ($order_list = mysqli_fetch_array($data)) {
				    	$query_makanan = mysqli_query($koneksi, "SELECT nama_makanan FROM menu WHERE id_makanan = $order_list[id_makanan]");
				    	$nama_makanan = mysqli_fetch_array($query_makanan)[0];

				    	$query_order = mysqli_query($koneksi, "SELECT * FROM pesan WHERE
				    		id_order = $order_list[id_order]");
				    	$isi_pesan = mysqli_fetch_array($query_order);

				        echo "
				        <tr>
				            <td align='center'>$no</td>
				            <td>$order_list[id_riwayat]</td>
				            <td>$nama_makanan</td>
				            <td>$isi_pesan[1] $isi_pesan[2]</td>
				            <td>$isi_pesan[3]</td>
				            <td>$isi_pesan[4]</td>
				        </tr>";

				        $no++; /* increment */
				    }

				    ?>

				</table>
				<a class="btn btn-primary" href="order.php">Kembali</a>
			</div>
		</div>
	</div>
</body>
</html>