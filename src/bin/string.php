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


/**
 * bytesToHuman
 *
 * Takes a int of bytes and turns it into a human readable string
 * 
 * @param  int     $bytes   Number of bytes
 * @param  string  $system  The system to use (binary or si)
 * @return string           Human readable string
 */
function bytesToHuman($bytes, $system='binary') {
	$binary = array(
		'B',
		'KiB',
		'MiB',
		'GiB',
		'TiB',
		'PiB',
		'EiB',
		'ZiB',
		'YiB'
	);

	$si = array(
		'B',
		'kB',
		'MB',
		'GB',
		'TB',
		'PB',
		'EB',
		'ZB',
		'YB'
	);

	$suffixes   = ( ($system !== 'si') ? $binary : $si);
	$multiplier = ( ($system !== 'si') ? 1024 : 1000);

	foreach ($suffixes as $m) {
		if($bytes >= $multiplier) {
			$bytes /= $multiplier;
		} else {
			$bytes = round($bytes, 3) . ' ' . $m;
			break;
		}
	}

	return $bytes;
}


/**
 * xmlEscape
 *
 * Sanitizes a string for use in a xml
 * 
 * @param  string  $str  dirty string
 * @return string        sanitized string
 */
function xmlEscape($str) {
	$forbidden = [
		'"',
		"&",
		"'",
		"<",
		">"
	];
	$replaceWith = [
		"&quot;",
		"&amp;",
		"&apos;",
		"&lt;",
		"&gt;"
	];

	return str_replace($forbidden, $replaceWith, $str);
}


// Source: http://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php

function strStartsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
}

function strEndsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
}