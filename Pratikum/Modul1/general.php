<?php
$nama= "ronggo widjoyo";
$kapital= strtoupper($nama);
$besar= ucwords($nama);

echo "<h2>Manipulasi String</h2>";
echo "Nama : $nama <br>
	Nama Kapital : $kapital <br>
	Nama Besar : $besar<p>";


function kerucut($jari, $tinggi){
	return $v= 1/3 * 3.14 * pow($jari,2) * $tinggi;

	// echo "<p>Jari-jari kerucut (r): $jari cm<br>
	// Tinggi kerucut (t): $tinggi cm<br>
	// Volume kerucut: $v cm<sup>3</sup>";
}
echo "<p><img src='rumus_kerucut.png' alt='Rumus'>";
echo kerucut(7, 18); /* kerucutA */
echo "<br>";
// kerucut(21, 9); /* kerucutB */

echo "<p><h2>Hitung Jumlah Huruf dan Kata</h2><p>";
function berapa($kalimat){
	$jml_huruf = strlen($kalimat);
	$jml_kata = str_word_count($kalimat);
	$total= $jml_kata * $jml_huruf;
	echo "Hasil perkalian jumlah huruf dan jumlah kata: $total";
}
berapa("Teknik Informatika itu prodi paling santuy");