<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,900&display=swap" rel="stylesheet">
	<title>Homepage</title>

	<style>
	body {
  		background-image: url('bg1.jpg');
  		background-repeat: no-repeat;
  		background-attachment: fixed;  
  		background-size: cover;
	}
	</style>
</head>
<body>
	<?php
		session_start();
		if (isset($_SESSION['isLogin'])){

		} else {
			header('location: login.php');
		}
	?>
	<div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
		<div class='row'>
			<div class='col'>
				<h1 style="font-family: 'Playfair Display', serif; color: coral; text-shadow: 3px 3px 0 #000;"><b>DAIRW</b></h1>
				<a class="btn btn-dark" href="menu.php" role="button">Menu</a>
				<a class="btn btn-secondary" href="order.php" role="button">Order</a>
				<a class="btn btn-dark" href="logout.php" role="button">Logout</a>
				<h3 class="text-white" style="text-shadow: 3px 3px 0 #000;"><b>Selamat datang <?=$_SESSION['nama']?></b></h3>
				<h3 class="text-white" style="text-shadow: 3px 3px 0 #000;"><b>Level: <?=$_SESSION['level']?></b></h3>
			</div>
		</div>
	</div>
</body>
</html>