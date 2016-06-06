<?php
/**
 * datetimeToDate
 *
 * Takes a DateTime object/string and returns a DateTime object with time 00:00:00
 * 
 * @param  DateTime/string  $datetime  DateTime or string of a date with time
 * @return DateTime                    DateTime with time at midnight
 */
function datetimeToDate($datetime) {
	$datetime = is_string($datetime) ? new DateTime($datetime) : $datetime;
	return new DateTime($datetime->format("Y-m-d 00:00:00"));
}

function datetimeToTime($datetime)
{
	$datetime = is_string($datetime) ? new DateTime($datetime) : $datetime;
	return DateTime::createFromFormat("Y-m-d H:i:s", $datetime->format("1970-01-01 H:i:s"));
}
