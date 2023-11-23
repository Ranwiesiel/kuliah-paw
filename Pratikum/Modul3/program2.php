<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
$arrlength = count($fruits);

for ($i=0; $i < $arrlength; $i++){
	echo $fruits[$i];
	echo "<br>";
}
echo "<p>";

// No 4
$new_fruits = array("Strawberry", "Watermelon", "Orange", "Papaya", "Pineapple");
$panjang_array = count($fruits);

for($i=0; $i < $panjang_array; $i++){
	array_push($fruits, $new_fruits[$i]);
}
$panjang_array = count($fruits);
echo "panjang array fruits $panjang_array";
echo "<br>";

// No 5
$vegies = array("Bean", "Potato", "Tomato");
$arrlength = count($vegies);

for ($i=0; $i < $arrlength; $i++){
	echo $vegies[$i];
	echo "<br>";
}