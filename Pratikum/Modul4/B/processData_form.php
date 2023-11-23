<?php

$error = array();
if (isset($_POST['submit'])){
	include 'validate.inc';

	validateName($error, $_POST, 'nama');
	validateEmail($error, $_POST, 'email');
	validateAlamat($error, $_POST, 'alamat');
	validatepassword($error, $_POST, 'password');

	if ($error){
		include 'form.inc';
		echo "<h1>Invalid, terjadi error:</h1>";
		foreach ($error as $isi => $err){
			echo "$isi $err<br>";
		}
	}
	else {
		echo "Form pengisian sudah benar";
	}
} else { 
	include 'form.inc';
}