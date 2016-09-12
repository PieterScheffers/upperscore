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

function inst($instance, $exit = false)
{
	if( is_object($instance) )
	{
		$className = get_class($instance);

		$ref = new ReflectionClass($className);

		return [
			'class' => $className,
			'filename' => $ref->getFileName(),
			'methods' => [
				'public' => array_map(function($item) { return $item->name; }, $ref->getMethods(ReflectionMethod::IS_PUBLIC)),
				'protected' => array_map(function($item) { return $item->name; }, $ref->getMethods(ReflectionMethod::IS_PROTECTED)),
				'private' => array_map(function($item) { return $item->name; }, $ref->getMethods(ReflectionMethod::IS_PRIVATE))
			]
		];
	}

	return [ "inst - Is a " . gettype($instance) ];
}
