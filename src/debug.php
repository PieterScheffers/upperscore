<?php

namespace pisc\upperscore;


/**
 * pr
 *
 * Debug function to output a variable formatted
 * 
 * @param  mixed    $var   Variable to output
 * @param  boolean  $exit  exit script?
 */
function pr($var, $exit=false) {
	echo "<pre>";
	print_r($var);
	echo "</pre>";
	if($exit) exit();
}