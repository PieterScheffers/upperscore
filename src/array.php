<?php

namespace pieterscheffers\upperscore;
 
/**
 * indexArray
 * indexes the array, make the keys like a prop of the objects
 * 
 * @param  array  $arr  Array of objects or keyed arrays
 * @param  string $prop Property key of object/array
 * @return array        Array with the property as keys
 */
function indexArray(array $arr, $prop="id") {
	$newArr = [];

	foreach ($arr as $obj) {
		$key = def($obj, $prop, '');
		
		if( $key !== '' ) {
			$newArr[$key] = $obj;
		} else {
			throw new Exception("Object doesn't have property " . $prop . ". Object: " . print_r($obj, true));
		}
	}

	return $newArr;
}

// select multiple key/values from array
function arraySelect(array $arr, callable $cb) {
	$newArr = [];
	foreach ($arr as $k => $v) {
		if( $cb($v, $k, $arr) ) {
			$newArr[$k] = $v;
		}
	}
	return $newArr;
}

// select first value from array
function arrayDetect(array $arr, callable $cb) {
	foreach ($arr as $k => $v) {
		if( $cb($v, $k, $arr) ) {
			return $v;
		}
	}
	return null;
}
