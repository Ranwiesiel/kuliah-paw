<?php

function validateName(&$error, $list, $nama){
	$patt = "/^[a-zA-Z\s'-]+$/";
	if (empty($list[$nama])){
		$error[$nama] = 'Diperlukan';
	} elseif (!preg_match($patt, $list[$nama]) or preg_match("/^\s+/", $list[$nama])){
		$error[$nama] = 'Invalid';
	}
}

function validateEmail(&$error, $list, $email){
	if (empty($list[$email])){
		$error[$email] = "Diperlukan";
	} elseif (!filter_var($list[$email], FILTER_VALIDATE_EMAIL)) {
		$error[$email] = "Invalid";
	}
}

function validateAlamat(&$error, $list, $alamat){
	$patt = "/^[a-zA-Z0-9\s'-.]+$/";
	if (empty($list[$alamat])){
		$error[$alamat] = 'Diperlukan';
	}elseif (!preg_match($patt, $list[$alamat])){
		$error[$alamat] = 'Invalid';
	}
}

function validatepassword(&$error, $list, $password){
	if (empty($list[$password])){
		$error[$password] = "Diperlukan";
	} elseif (strlen($list[$password]) < 8) {
		$error[$password] = "Invalid password kurang dari 8 karakter";
	}
}
