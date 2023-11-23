<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mengurutkan terkecil hingga terbesar</title>
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
	$simpan= 0;
	$isi = $_POST['input'];
	$arr_isi = array_map('intval', explode(",", $isi));
	$arr_len = count($arr_isi);

	for($i=0; $i < $arr_len - 1; $i++){
		for($j=0; $j < $arr_len - $i - 1; $j++){
			if ($arr_isi[$j] > $arr_isi[$j+1]){
				$simpan = $arr_isi[$j];
				$arr_isi[$j] = $arr_isi[$j+1];
				$arr_isi[$j+1] = $simpan;
			}
		}
	}
	echo "Urutan dari terkecil hingga terbesar: ";
	foreach($arr_isi as $out){
		echo "$out, ";
	}
}