<?php

// foreach($height as $x => $x_value) {
// 	echo "Key=" . $x . ", Value=" . $x_value;
// 	echo "<br>";
// }

// No 9
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

$data_baru = array("Ado" => "171", "Kelvin" => "173", "Noah" => "169", "Oliver" => "175", "Liam" => "177");
foreach($data_baru as $key => $value){
	$height [$key] = $value;
}
// // No 10
// $weight = array("Andy" => "60", "Charlie" => "70", "Ado" => "58");
// foreach($weight as $x => $x_value) {
// 	echo "Key=" . $x . ", Value=" . $x_value;
// 	echo "<br>";
// }
print_r($height);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<table border=1>
		<tr>
			<td>No</td>
			<td>Nama</td>
			<td>Tinggi</td>
		</tr>
		<?php $ind= 1; foreach($height as $key => $tinggi){ ?>
			<tr>
			<td><?= $ind++ ?></td>
			<td><?= $key ?></td>
			<td><?= $tinggi ?></td>
			</tr>
		<?php }; ?>
	</table>
</body>
</html>