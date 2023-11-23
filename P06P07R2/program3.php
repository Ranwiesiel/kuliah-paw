<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mencari nilai tengah</title>
</head>
<body>
	<form method="post" action="">
		<label for="input">Masukkan bilangan bulat</label>
		<input type="text" name="input">
		<input type="submit" name="submit">
	</form>
</body>
</html>

<?php

if(isset($_POST['submit'])){
	$isi = $_POST['input'];
	$arr_isi = array_map('intval', explode(",", $isi));
	sort($arr_isi);

	if (count($arr_isi) % 2 == 0){
		$tengah = count($arr_isi) / 2;
	}
	$tengah = count($arr_isi) / 2;
	echo "Nilai tengah yaitu: $arr_isi[$tengah]";
}