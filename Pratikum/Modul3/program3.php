<?php
$height = array(
	"Andy"=>"176",
	"Barry"=>"165",
	"Charlie"=>"170"
);
echo "Andy is " . $height['Andy'] . " cm tall.<br>";

// No 6
$height["Ado"] = "171";
$height_new = array(
	"Kelvin" => "173",
	"Noah" => "169",
	"Oliver" => "175",
	"Liam" => "177"
);
$height = array_merge($height, $height_new);
$value = end($height);
$key = key($height);

echo "Key: $key, Value: $value <br>";

// No 7
array_splice($height, 1,1);
echo "Key: $key, Value: $value <p>";

// No 8
$weight = array("Andy" => "60", "Charlie" => "70", "Ado" => "58");
$value = $weight["Charlie"];
$key = array_search($value, $weight);
echo "Data ke dua, Key: $key, Value: $value <p>";