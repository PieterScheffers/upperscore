<?php

namespace pieterscheffers\upperscore;


/**
 * def
 * 
 * Check if key isset, otherwise return default value
 * 
 * @param  object/array  $arr  object or array collection
 * @param  string        $key  key of collection
 * @param  mixed         $def  default value
 * @return mixed               return object/array value or default
 */
function def($arr, $key, $def="") {
	if( $arr ) {

		if( is_array($arr) && isset($arr[$key]) ) {

			return $arr[$key];

		} else if( is_object($arr) && isset($arr->$key) ) {

			return $arr->$key;

		}

	}

	return $def;
}


/**
 * intervalsCollision
 * 
 * @param  array  $i1  Array with 2 values
 * @param  array  $i2  Array with 2 values
 * @return bool        Whether the intervals collide or not
 */
function intervalsCollision($i1, $i2) {

	if( !(($i1[1] <= $i2[0] && $i1[1] < $i2[1]) || ($i1[0] > $i2[0] && $i1[0] >= $i2[1])) ) {
		return true;
	}
	return false;
}