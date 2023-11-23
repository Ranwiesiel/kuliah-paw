<?php

function validateName(&$error, $list, $nama){
	$patt = "/^[a-zA-Z\s'-]+$/";
	if (!isset($list[$nama]) || empty($list[$nama])){
		$error[$nama] = 'Diperlukan';
	}elseif (!preg_match($patt, $list[$nama])){
		$error[$nama] = 'Invalid';
	}
}