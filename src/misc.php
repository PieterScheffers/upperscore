<?php

namespace pisc\upperscore;


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
 * keyToArray 
 *
 * dot-seperated-keys string to keys array
 * input:  'this.are.all.keys'
 * output: [ 'this', 'are', 'all', 'keys' ]
 * 
 * @param  string  $key  dot-seperated keys
 * @return array         array of keys
 */
function keyToArray($key) {
	return explode('.', $key);
}

/**
 * defdeep
 *
 * example: 
 * arr = [ 'banana' => [ 'kiwi': 'strawberry' ], 'berry' => [] ]
 *
 * keys exist:
 * value = defDeep(arr, 'banana.kiwi', 'cookie')  
 *      => 'strawberry'
 *
 * key doesn't exist:
 * value = defDeep(arr, 'berry.kiwi', 'cookie')  
 *      => 'cookie'
 * 
 * @param  array/object  $var  array or object
 * @param  string        $key  string or dot-seperated-keys string
 * @param  mixed         $def  default value
 * @return mixed               value of key in array or default value
 */
function defdeep($var, $key, $def='') {
	$keys = keyToArray($key);

	foreach ($keys as $k) {
		$var = def($var, $k);
	}

	return $var ?: $def;
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