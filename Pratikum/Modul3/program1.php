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