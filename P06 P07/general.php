<?php

$data_kota = [

	"Jakarta" => ['lat' => -6.175032, 'long' => 106.827222],
	"Bandung" => ['lat' => -6.917222, 'long' => 107.616944],
	"Semarang" => ['lat' => -6.944444, 'long' => 110.416667],
	"Yogyakarta" => ['lat' => -7.783333, 'long' => 110.35],
	"Surabaya" => ['lat' => -7.25, 'long' => 112.75],
	"Serang" => ['lat' => -6.066667, 'long' => 106.066667],
	"Tangerang" => ['lat' => -6.2, 'long' => 106.6],
	"Bekasi" => ['lat' => -6.25, 'long' => 106.8],
	"Depok" => ['lat' => -6.366667, 'long' => 106.8],
	"Bogor" => ['lat' => -6.6, 'long' => 106.8],
	"Solo" => ['lat' => -7.566667, 'long' => 110.8],
	"Malang" => ['lat' => -7.966667, 'long' => 112.6],
	"Jember" => ['lat' => -8.1, 'long' => 113.5],

];


// Membuat array asosiatif untuk menghubungkan kota-kota
$connections = array(
    'Jakarta' => ['Bandung', 'Semarang', 'Bekasi', 'Depok', 'Tangerang', 'Bogor'],
    'Bandung' => ['Jakarta', 'Semarang', 'Yogyakarta', 'Surabaya'],
    'Semarang' => ['Jakarta', 'Bandung', 'Yogyakarta', 'Surabaya'],
    'Yogyakarta' => ['Bandung', 'Semarang', 'Surabaya', 'Solo'],
    'Surabaya' => ['Bandung', 'Semarang', 'Yogyakarta', 'Solo'],
    'Serang' => ['Tangerang'],
    'Tangerang' => ['Serang', 'Jakarta', 'Bekasi'],
    'Bekasi' => ['Tangerang', 'Jakarta', 'Depok'],
    'Depok' => ['Bekasi', 'Jakarta', 'Bogor'],
    'Bogor' => ['Jakarta', 'Depok'],
    'Solo' => ['Yogyakarta', 'Surabaya']
);

// Contoh cara mengakses data dalam array
// echo "Kota-kota yang terhubung dengan Jakarta: " . implode(", ", $connections['Jakarta']);

echo "<form method='post' action=''>";
echo "<label for='kota-awal'>Kota awal</label>
<select name='kota-awal'>";
	foreach($data_kota as $kota => $value){
		echo "<option value='$kota'>$kota</option>";
	}
echo "</select>";

echo "<label for='kota-awal'>Kota awal</label>
<select name='kota-akhir'>";
	foreach($data_kota as $kota => $value){
		echo "<option value='$kota'>$kota</option>";
	}
echo "</select>
<input type='submit' value='Lihat'>
</form>";

function hitungJarak($lat1, $lon1, $lat2, $lon2){
	$theta = $lon1 - $lon2;
	$miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
	$miles = acos($miles);
    $miles = rad2deg($miles);
    $miles = $miles * 60 * 1.1515;
	$kilometers = $miles * 1.609344;
	return $kilometers;
}


if(isset($_POST['kota-awal'])){
	$kotaAwal= $_POST['kota-awal'];
	$kotaAkhir= $_POST['kota-akhir'];
	$jarakKota= 0;

	if($kotaAwal == $kotaAkhir){
		echo "Anda sudah ditempat tujuan";

	} elseif(!in_array($kotaAkhir, $connections[$kotaAwal])){
		echo "Kota $kotaAkhir tidak ada dalam jalur $kotaAwal";

	} elseif(in_array($kotaAkhir, $connections[$kotaAwal])){
		foreach ($data_kota as $kota => $koordinat) {
	        if ($kota != $kotaAwal && in_array($kota, $connections[$kotaAwal])) {
	            $jarakKota += hitungJarak($data_kota[$kotaAwal]['lat'], $data_kota[$kotaAwal]['long'], $koordinat['lat'], $koordinat['long']);
	            echo "$jarakKota km" . $kota . "<br>";
	        }
		}
		echo $jarakKota;
	}
}
