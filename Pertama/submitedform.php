<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama= $_POST["nama"];
    $hobi= $_POST["hobi"];

    if (empty($nama) || empty($hobi)){
        header("Location: formphp.php");
        exit();
    }

    echo "Nama kamu $nama";
    echo "<br>";
    echo "Hobi kamu $nama";

}