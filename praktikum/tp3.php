<?php

$fruits = array("Avocado", "Blueberry", "Cherry");
echo "I like $fruits[0] $fruits[1] and $fruits[2]<br>";

// No 1
array_push($fruits, "Banana", "Apple", "Dragon Fruit", "Mango", "Grape");
echo "Index tertinggi dari array fruits " . end($fruits) . "<br>";
echo "Index tertinggi dari array fruits yaitu " . key($fruits) . "<p>";

// No 2
unset($fruits[2]);
print_r($fruits);
echo "<br>Index tertinggi dari array fruits " . end($fruits) . "<br>";
echo "Index tertinggi dari array fruits yaitu " . key($fruits) . "<p>";

// No 3
$vegies = array("Bean", "Potato", "Tomato");
print_r($vegies);
echo "<p>";


$fruits = array("Avocado", "Blueberry", "Cherry");
$arrlength = count($fruits);

for ($i=0; $i < $arrlength; $i++){
	echo $fruits[$i];
	echo "<br>";
}
echo "<p>";

// No 4
$new_fruits = array("Strawberry", "Watermelon", "Orange", "Papaya", "Pineapple");
$panjang_array = count($new_fruits);

for($i=0; $i < $panjang_array; $i++){
	array_push($fruits, $new_fruits[$i]);
}
echo "panjang array fruits $panjang_array";
echo "<br>";

// No 5
$vegies = array("Bean", "Potato", "Tomato");
$arrlength = count($vegies);

for ($i=0; $i < $arrlength; $i++){
	echo $vegies[$i];
	echo "<br>";
}
echo "<p>";


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
array_splice($height, 1, 1);
echo "Key: $key, Value: $value <p>";

// No 8
$weight = array("Andy" => "60", "Charlie" => "70", "Ado" => "58");
$value = $weight["Charlie"];
$key = array_search($value, $weight);
echo "Data ke dua, Key: $key, Value: $value <p>";


$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

foreach($height as $x => $x_value) {
	echo "Key=" . $x . ", Value=" . $x_value;
	echo "<br>";
}

// No 9
$data_baru = array(["Ado" => "171"], ["Kelvin" => "173"], ["Noah" => "169"], ["Oliver" => "175"], ["Liam" => "177"]);
foreach($data_baru as $key => $value){
	array_push($height, [$key => $value]);
}

// No 10
$weight = array("Andy" => "60", "Charlie" => "70", "Ado" => "58");
foreach($weight as $x => $x_value) {
	echo "Key=" . $x . ", Value=" . $x_value;
	echo "<br>";
}


$students = array (
	array("Alex","220401","0812345678"),
	array("Bianca","220402","0812345687"),
	array("Candice","220403","0812345665"),
);

for ($row = 0; $row < 3; $row++) {
	echo "<p><b>Row number $row</b></p>";
	echo "<ul>";
	for ($col = 0; $col < 3; $col++) {
		echo "<li>".$students[$row][$col]."</li>";
	}
	echo "</ul>";
}

// No 11
$students_new=[
	array("Bambang", "220404", "0812345666"),
	array("Arul", "220405", "0812345667"),
	array("Aji", "220406", "0812345668"),
	array("Nurul", "220407", "0812345669"),
	array("Cipto", "220408", "0812345670")
];

$student = array_merge($students, $students_new);

// No 12
echo "<table border=1>
	<tr>
	<th>Name</th> <th>NIM</th> <th>Mobile</th>
	</tr>";
foreach($student as $key => $isi){
	echo "<tr>
			<td>$isi[0]</td> <td>$isi[1]</td> <td>$isi[2]</td>
		</tr>";
}
echo "</table>";