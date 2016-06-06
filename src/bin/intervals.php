<?php

function amPmToDateTime($ampm)
{
	return DateTime::createFromFormat('Y-m-d h:i A', "1000-01-01 {$ampm}");
}

function timeToDateTime($time)
{
	return DateTime::createFromFormat('Y-m-d H:i:s', "1000-01-01 {$time}");
}

function formatAmPm(DateTime $dateTime)
{
	return $dateTime->format("h:i A");
}

function formatTime(DateTime $dateTime)
{
	return $dateTime->format("H:i:s");
}

function intervalsCollide($i1, $i2) {
	if( !(($i1[1] <= $i2[0] && $i1[1] < $i2[1]) || ($i1[0] > $i2[0] && $i1[0] >= $i2[1])) ) {
		return true;
	}
	return false;
}

function intervalMinusBreak($interval, $break)
{
	$intervalParts = [];

	if( intervalsCollide($interval, $break) )
	{
		if( $interval[0] < $break[0] && $interval[1] > $break[1] )
		{
			$intervalParts[] = [ $interval[0], $break[0] ];
			$intervalParts[] = [ $break[1], $interval[1] ];
		} 
		else if( $interval[0] < $break[0] && $interval[1] <= $break[1] )
		{
			$intervalParts[] = [ $interval[0], $break[0] ];
		}
		else if( $interval[0] >= $break[0] && $interval[1] > $break[1] )
		{
			$intervalParts[] = [ $break[1], $intervals[1] ];
		}
	}
	else
	{
		$intervalParts[] = $interval;
	}

	return $intervalParts;
}

function intervalMinusBreaks($interval, $breaks)
{
	$break = array_pop($breaks);
	$parts = intervalMinusBreak($interval, $break);

	if( count($breaks) < 1 )
	{
		return $parts;
	}

	$intervalParts = [];

	foreach($parts as $part)
	{
		$intervalParts = array_merge($intervalParts, intervalMinusBreaks($part, $breaks));
	}

	return $intervalParts;
}

$interval = [ "start" => "08:00:00", "end" => "20:00:00" ];
$interval = [ timeToDateTime($interval['start']), timeToDateTime($interval['end']) ];


$breaks = [
	["start" => "13:00:00", "end" => "14:00:00"], 
	["start" => "16:00:00", "end" => "16:30:00"],
	["start" => "18:35:00", "end" => "19:10:00"],
	["start" => "18:45:00", "end" => "19:15:00"],
];

$breaks = array_map(function($break) {
	return [ timeToDateTime($break['start']), timeToDateTime($break['end']) ];
}, $breaks);

$timeBlocks = intervalMinusBreaks($interval, $breaks);

$timeBlocks = array_map(function($timeBlock) {
	return [ 'start' => formatAmPm($timeBlock[0]), 'end' => formatAmPm($timeBlock[1]) ];
}, $timeBlocks);

echo "<pre>";
print_r($timeBlocks);
echo "</pre>";