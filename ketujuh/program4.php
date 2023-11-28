<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Menggabungkan 2 bilangan x dan y</title>
</head>
<body>
	<form method="post" action="">
		<label for="inputX">Masukkan bilangan bulat</label>
		<input type="text" name="inputX">
		<p>
		<label for="inputY">Masukkan bilangan bulat</label>
		<input type="text" name="inputY">
		<p>
		<input type="submit" name="submit">
	</form>
</body>
</html>

<?php

if(isset($_POST['submit'])){
	$isiX = $_POST['inputX'];
	$isiY = $_POST['inputY'];
	$arr_isiX = array_map('intval', explode(",", $isiX));
	$arr_isiy = array_map('intval', explode(",", $isiY));
	$arr_isi = array_merge($arr_isiX, $arr_isiy);
	rsort($arr_isi);
	echo "Data terurut dari besar ke kecil: ";
	foreach($arr_isi as $out){
		echo "$out, ";
	}
}