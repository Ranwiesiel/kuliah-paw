<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mencari Modus</title>
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
	$max = 0;
	$isi = $_POST['input'];
	$arr_isi = array_map('intval', explode(",", $isi));
	$grup_sama = array_count_values($arr_isi);

	foreach($grup_sama as $bil_bulat => $total){
		if ($total > $max){
			$max = $total;
		}
	}
	echo "Modus dari bilangan yang telah diinputkan adalah: " . array_search($max, $grup_sama);
}