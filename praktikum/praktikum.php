<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<form action='' method='post'>
		Nama
		<input type='text' name='nama'>
		<p>
		email
		<input type='text' name='email'>
		<p>
		<input type='submit'>
	</form>
</body>
</html>

<?php

$patt= "/\s+|^$/";
$patt2= "/^[a-z]/i";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$nama = $_POST['nama'];
	if (preg_match(!$patt2, $nama)){
		echo "jangan bang<br>";
	}
	
	if (empty($nama)){
		echo "nama kosong";
	} else{
		echo $nama;
	}
}

