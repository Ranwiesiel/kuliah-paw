<?php

// $nilai= $_POST["nilai"];
// if ($nilai > 80){
//     echo "nilai A";
// } else if ($nilai > 70){
//     echo "nilai B";
// } else if ($nilai > 60){
//     echo "nilai C";
// } else if ($nilai > 50){
//     echo "nilai D";
// } else if ($nilai < 50){
//     echo "nilai E"
// }

// $pertama= $_POST["pertama"];
// $kedua= $_POST["kedua"];

// for ($i= $pertama; $i <= $kedua; $i++){
//     echo "$i ";
// }

$kalimat= $_POST["kalimat"];
echo strtolower("$kalimat");
echo "<br>";
echo strtoupper("$kalimat");
echo "<br>";
echo ucfirst("$kalimat");
echo "<br>";
echo ucwords("$kalimat");
echo "<br>";
echo substr("$kalimat", 0, 4);
echo "<br>";
echo substr("$kalimat", -4);
echo "<br>";
echo strlen("$kalimat");


