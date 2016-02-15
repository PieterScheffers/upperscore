<?php

namespace pisc\upperscore;


/**
 * defOne
 * 
 * Check if key isset, otherwise return default value
 * 
 * @param  object/array  $arr  object or array collection
 * @param  string        $key  key of collection
 * @param  mixed         $def  default value
 * @return mixed               return object/array value or default
 */
function defOne($arr, $key, $def="") {
	if( $arr ) {

		// Check for function
		if( strEndsWith($key, '()') && is_object($arr) ) {
			$key = substr($key, 0, strlen($key) - 2 );
			$result = $arr->$key();

			if( $result ) {
				return $result;
			}
		}

		// Check for array of ArrayAccessable object
		if( 
			(is_array($arr) && isset($arr[$key])) || 
			(is_object($arr) && $arr instanceof ArrayAccess) 
		) {

			return $arr[$key];

		// Check for object
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
 * input:  'these.are.all.keys'
 * output: [ 'these', 'are', 'all', 'keys' ]
 * 
 * @param  string  $key  dot-seperated keys
 * @return array         array of keys
 */
function keyToArray($key) {
	return explode('.', $key);
}

/**
 * def
 *
 * example: 
 * arr = [ 'banana' => [ 'kiwi' => 'strawberry' ], 'berry' => [] ]
 *
 * keys exist:
 * value = def(arr, 'banana.kiwi', 'cookie')  
 *      => 'strawberry'
 *
 * key doesn't exist:
 * value = def(arr, 'berry.kiwi', 'cookie')  
 *      => 'cookie'
 * 
 * @param  array/object  $var  array or object
 * @param  string        $key  string or dot-seperated-keys string
 * @param  mixed         $def  default value
 * @return mixed               value of key in array or default value
 */
function def($var, $key, $def='') {
	$keys = keyToArray($key);

	foreach ($keys as $k) {
		$var = defOne($var, $k);
	}

	return $var ?: $def;
}

// alias: old name of def
function defDeep($var, $key, $def='') { 
	return def($var, $key, $def);
}


// function set($obj, $key, $val) {
// 	if( is_object($obj) && !isset($obj->key) ) {

// 		$obj->$key = $val;

// 	} else if( is_array($obj) && !isset($obj[$key]) ) {

// 		$obj[$key] = $val;

// 	}

// 	return $obj;
// }

// function setDeep($obj, $key, $val, $type="array") {
// 	$def = $type === 'array' ? [] : (object)[];
// 	$object = $obj;
// 	$keys = keyToArray($key);
// 	$lastKey = array_pop($keys);

// 	foreach ($keys as $k) {
// 		echo "obj\n";
// 		print_r($object);
// 		$obj = def( set($obj, $k, $def), $k);
// 		print_r($obj);
// 		echo "\n";
// 	}
// 	set($obj, $lastKey, $val);

// 	return $object;
// }

function access($obj, $key) {
	$keys = keyToArray($key);
}


/**
 * intervalsCollide
 * 
 * @param  array  $i1  Array with 2 values
 * @param  array  $i2  Array with 2 values
 * @return bool        Whether the intervals collide or not
 */
function intervalsCollide($i1, $i2) {

	if( !(($i1[1] <= $i2[0] && $i1[1] < $i2[1]) || ($i1[0] > $i2[0] && $i1[0] >= $i2[1])) ) {
		return true;
	}
	return false;
}
