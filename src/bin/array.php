<?php

namespace pisc\upperscore;
 
/**
 * indexArray
 * 
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

/**
 * arrayFlatten
 * @param  array $arr multidimenional array
 * @return array      flat array
 */

function arrayFlatten(array $arr) {

    $arr = array_reduce($arr, function($a, $item) {
        if( is_array($item) ) $item = arrayFlatten($item);

        return array_merge($a, (array)$item);
    }, []);

    return $arr;
}

/**
 * arrayDelete
 * 
 * Removes an item from the array and returns its value.
 *
 * @param array $arr The input array
 * @param $key The key pointing to the desired value
 * @return The value mapped to $key or null if none
 */
function arrayDelete(array &$arr, $key) {
    if (array_key_exists($key, $arr)) {
        $val = $arr[$key];
        unset($arr[$key]);

        return $val;
    }

    return null;
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


/**
 * arrayType
 * 
 * Find whether the array is indexed or an associative array
 * If it is indexed, find if its sparse or not
 * 
 * @param  array   $arr array
 * @return string       type of array (index, assoc, sparse)
 */
function arrayType( array $arr=[] ){
    $last_key = -1;
    $type = 'index';

    foreach( $arr as $key => $val ){

        if( !is_int( $key ) || $key < 0 ){
            return 'assoc';
        }

        if( $type !== 'sparse' ) {

	        if( $key !== $last_key + 1 ){
	            $type = 'sparse';
	        }
	        $last_key = $key;

	    }
    }

    return $type;
}
