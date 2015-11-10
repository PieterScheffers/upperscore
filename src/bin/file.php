<?php

namespace pisc\upperscore;

function fileReduce($file, closure $cb, $start = []) {
	$handle = fopen($file, "r");

	while( !feof($handle) ) {

	  $line = fgets($handle);
	  $start = $cb($start, $line);

	}

	fclose($handle);

	return $start;
}


function lineCount($file) {

	return fileReduce($file, function($start, $line) {
		return ++$start;
	}, 0);

}

function getRandomLine($file) {

	$max = lineCount($file);

	$lineNumber = rand(1, $max);

	$file = new SplFileObject($file);
	$file->seek($lineNumber - 1);     
	return $file->current();
}