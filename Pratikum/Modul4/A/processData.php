<?php
include 'validate.inc';

$error = array();

validateName($error, $_POST, 'nama');
if ($error){
	echo "Error: <br>";
	foreach ($error as $data => $isi){
		echo "$data $isi<br>";
	}
} else {
	echo "ntap";
}
