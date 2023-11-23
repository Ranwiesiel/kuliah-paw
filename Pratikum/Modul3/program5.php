<?php
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