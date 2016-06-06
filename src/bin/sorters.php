<?php

function sortByString($a, $b)
{
	// Returns < 0 if str1 is less than str2; > 0 if str1 is greater than str2, and 0 if they are equal.
	$return = strcmp($a, $b);
	
	if( $return < 0 ) return -1;
	else if( $return > 0) return 1;
	else return 0;
}

function sortByStringCase($a, $b)
{
	// Returns < 0 if str1 is less than str2; > 0 if str1 is greater than str2, and 0 if they are equal.
	// Case insensitive
	return strcasecmp($a, $b);
}

function sortByDefault($a, $b)
{
	if( $a < $b ) {
		return -1;
	} else if( $a > $b ) {
		return 1;
	} else {
		return 0;
	}
}

function sortByNumber($a, $b)
{
	return sortByDefault($a, $b);
}

function sortByDate($a, $b)
{
	if( !is_object($a) ) $a = new DateTime($a);
	if( !is_object($b) ) $b = new DateTime($b);

	$a = datetimeToDate($a);
	$b = datetimeToDate($b);

	return sortByDefault($a, $b);
}

function sortByDateTime($a, $b)
{
	if( !is_object($a) ) $a = new DateTime($a);
	if( !is_object($b) ) $b = new DateTime($b);

	return sortByDefault($a, $b);
}

function sortByTime($a, $b)
{
	if( !is_object($a) ) $a = new DateTime($a);
	if( !is_object($b) ) $b = new DateTime($b);

	$a = datetimeToTime($a);
	$b = datetimeToTime($b);

	return sortByDefault($a, $b);
}