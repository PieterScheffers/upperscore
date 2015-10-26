<?php

namespace pisc\upperscore;


function randomString($length = 10) {
	$lowerCase = "abcdefghijklmnopqrstuvwxyz";
	$allChars = str_split($lowerCase . strtoupper($lowerCase) . "0123456789");

	$string = "";
	for ($j=0; $j < $length; $j++) { 
		$string .= $allChars[rand(0, count($allChars)-1)];
	}
	return $string;
}