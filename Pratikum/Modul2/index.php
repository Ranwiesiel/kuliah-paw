<?php

$genap = 10;
$ganjilPrima = 37;
$ganjil = 25;

function prima($n) {
	$simpan = 0;
	$coba = false;
    if ($n <= 1) {
        return "$n bukan bilangan Ganjil Prima";
    }
    for ($i = 2; $i <= $n; $i++) {
    	if ($n % $i == 0){
    		$simpan++;
    	}
    }
    if ($simpan == 1){
    	$coba = true;
    }
	if ($n % 2 == 0){
		return "$n bilangan genap";

	} elseif ($n % 2 == 1 and !$coba) {
		return "$n bilangan Ganjil";

	} elseif ($n % 2 == 1 and $coba) {
		 return "$n bilangan Ganjil Prima";
	}
	
}

echo prima($genap)."<br>";
echo prima($ganjilPrima)."<br>";
echo prima($ganjil)."<br>";

// if ($genap % 2 == 0){
// 	echo "$genap adalah bilangan Genap<br>";
// } else {
// 	echo "$genap Bukan bilangan Genap<br>";
// }
// if ($ganjil % 2 == 1){
// 	echo "$ganjil adalah bilangan Ganjil<br>";
// } else {
// 	echo "$ganjil Bukan bilangan Ganjil<br>";
// }
// if ($ganjilPrima % 2 != 0 and prima($ganjilPrima)){
// 	echo "$ganjilPrima adalah bilangan Ganjil Prima<br>";
// } else {
// 	echo "$ganjilPrima Bukan bilangan Ganjil Prima<br>";
// }




$saldoRekA = '100000';
$saldoRekB = '15000';

function transaksi($saldo){
	$saldo = intval($saldo);
	$harga_melon = 5000; 
	$harga_jeruk = 10000; 
	$harga_semangka = 15000;

	if ($saldo >= $harga_melon){
		$saldo -= $harga_melon;
		echo "Saya membeli 1 melon dengan harga 5000 sisa saldo saya adalah = $saldo<p>";

		if ($saldo >= $harga_jeruk){
			$saldo -= $harga_jeruk;
			echo "Saya membeli 1 jeruk dengan harga 10000 sisa saldo saya adalah = $saldo<p>";

			if ($saldo >= $harga_semangka){
				$saldo -= $harga_semangka;
				echo "Saya membeli 1 semangka dengan harga 15000 sisa saldo saya adalah = $saldo<p>";
				echo "<h3>Jumlah total buah yang sudah terbeli yaitu = 30000 dan uang sisa adalah $saldo </h3>";
			}  else{
				echo "Saldo tidak cukup, saldo Anda adalah : $saldo";
				}

		}  else{
			echo "Saldo tidak cukup, saldo Anda adalah : $saldo";
			}

	} else{
		echo "Saldo tidak cukup, saldo Anda adalah : $saldo";
		}
}
echo "<h2>Total saldo saya adalah $saldoRekA</h2><p>";
transaksi($saldoRekA);
echo "<h2>Total saldo saya adalah $saldoRekB</h2><p>";
transaksi($saldoRekB);


echo "<p><table border=1>
	<th>No</th>
	<th>Nama Komputer</th>
	<th>Ram</th>
	<th>OS</th>
	<th>Processor</th>
	<th>Storage</th>
	<th>Kondisi</th>";

for ($i=1; $i <= 10; $i++){
	echo "<tr>
			<td>$i</td>";
	if ($i != 5){
		echo "<td>Client " . $i*2 . "</td>
			<td>8 GB</td>
			<td>Windows 10 home Single Language</td>
			<td>8th Generation Intel Core i5</td>";
			if ($i*2 == 4 or $i*2 == 8){
				echo "<td>Failure</td>
					<td>Tidak Aktif</td>";
			} else{
				echo "<td>HDD 1TB</td>
					<td>Aktif</td>";
			}
	}elseif ($i == 5){
		echo "<td>Client " . $i*2 . "</td>
			<td>4 GB</td>
			<td>Windows 7 Home Basic 64 Bit ISO</td>
			<td>Core 2 Duo</td>
			<td>HDD 256 GB</td>
			<td>Tidak Layak</td>";
		}
	echo "</tr>";
}
echo "</table>";