<?php

namespace pisc\upperscore;


/**
 * path_combine
 *
 * Takes one or more paths as arguments and puts them together,
 * so there are no slash conflicts between path-parts
 *
 * @param  string/array  Variable number of arguments. Arguments must be a path string or an array of path strings
 * @return string        combined path  
 */
function pathCombine() {
	$paths = array_values( arrayFlatten(func_get_args()) );

	$newPaths = array();
	$nrOfPaths = count($paths);

	for ($i=0; $i < $nrOfPaths; $i++) {
		$path = $paths[$i];
		$path = str_replace("\\", "/", $path);

		if( $i > 0 ) {
			$path = ltrim($path, "/");
		} 
		if( $i < ($nrOfPaths - 1) ) {
			$path = rtrim($path, "/");
		}

		$newPaths[] = $path;
	}

	return implode("/", $newPaths);
}


/**
 * sanitizePath
 *
 * Sanitizes a path, so it is a valid path in Windows & Linux
 * 
 * @param  string  $path         string of a path
 * @param  string  $replacement  character to use for replacement of bad characters
 * @return string                sanitized path
 */
function sanitizePath($path, $replacement = "_") {
	if($path === '') return $path;

	// https://msdn.microsoft.com/en-us/library/aa365247
	
	$forbidden = array(
		"\0", // NULL
		"<",
		">",
		":",
		"\"",
		"/",
		"\\",
		"|",
		"?",
		"*"
	);

	$path = str_replace($forbidden, $replacement, $path); // replace forbidden characters

	$forbidden_filenames = array(
		"CON",
		"PRN",
		"AUX",
		"NUL",
		"COM1",
		"COM2",
		"COM3",
		"COM4",
		"COM5",
		"COM6",
		"COM7",
		"COM8",
		"COM9",
		"LPT1",
		"LPT2",
		"LPT3",
		"LPT4",
		"LPT5",
		"LPT6",
		"LPT7",
		"LPT8",
		"LPT9"
	);

	if( in_array(strtoupper(basename($path)), $forbidden_filenames) ) {
		$dirs = explode('/', $path);
		$lastdir = array_pop($dirs);
		$fileparts = explode('.', $lastdir);
		$base = array_shift($fileparts);

		$base = $base . randomString(20); // add random string to basename

		array_unshift($fileparts, $base);
		$lastdir = implode('.', $fileparts);
		array_push($dirs, $lastdir);
		$path = implode('/', $dirs);
	}

	$path = rtrim($path, '.');  // file not ending with a period
	$path = trim($path); 		// file not ending with a space

	return $path;
}