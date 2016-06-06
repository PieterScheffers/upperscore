<?php

namespace pisc\upperscore;

/**
 * [SutherlandHodgman description]
 * @param [type] $polygon [description]
 * @param [type] $clipper [description]
 * @return array          array of points of clipping area
 */

// function sutherlandHodgman($polygon, $clipper) {
// 	$result = $polygon;
// 	$k = 0;
// 	$l = 0;

// 	$clipperLength = count($clipper);

// 	for ($i=0; $i < $clipperLength; $i++) { 
// 		$resultLength = count($result);

// 		$input = $result; // copy array
// 		$result = [];
		
// 		$pointA = $clipper[( $i + $clipperLength - 1 ) % $clipperLength];
// 		$pointB = $clipper[$i];

// 		for ($j=0; $j < 4; $j++) { 
			
// 			$pointP = $input[ ( $j + 4 - 1 ) % 4 ];
// 			$pointQ = $input[$j];

// 			if( isInside($pointA, $pointB, $pointQ) ) {

// 				if( !isInside($pointA, $pointB, $pointP) ) {

// 					$result[] = intersection($pointA, $pointB, $pointP, $pointQ);

// 				}
// 				$result[] = $pointQ;

// 			} else if( isInside($pointA, $pointB, $pointP) ) {

// 				$result[] = intersection($pointA, $pointB, $pointP, $pointQ);

// 			}

// 		}

// 	}

// 	return $result;
// }

// function isInSide($pointA, $pointB, $pointC) {
// 	return ($pointA[0] - $pointC[0]) * ($pointB[1] - $pointC[1]) > ($pointA[1] - $pointC[1]) * ($pointB[0] - $pointC[0]);
// }

// function intersection($pointA, $pointB, $pointP, $pointQ) {
// 	echo "intersection\n";
// 	print_r($pointA);
// 	print_r($pointB);
// 	print_r($pointP);
// 	print_r($pointQ);

// 	$a1 = $pointB[1] - $pointA[1];
// 	$b1 = $pointA[0] - $pointB[0];
// 	$c1 = $a1 * $pointA[0] + $b1 * $pointA[1];

// 	$a2 = $pointQ[1] - $pointP[1];
// 	$b2 = $pointP[0] - $pointQ[0];
// 	$c2 = $a2 * $pointP[0] + $b2 * $pointP[1];

// 	$det = $a1 * $b2 - $a2 * $b1;
// 	$x = ( $b2 * $c1 - $b1 * $c2 ) / $det;
// 	$y = ( $a1 * $c2 - $a2 * $c1 ) / $det;

// 	return [ $x, $y ];
// }


function sutherlandHodgman($polygon, $clipper) {
	$outputList = $polygon;
	$cp1 = end($clipper);

	foreach ($clipper as $clipVertex) {
		echo "foreach clipper\n";

		$cp2 = $clipVertex;
		$inputList = $outputList;
		$outputList = [];

		$s = end($inputList);

		foreach ($inputList as $subjectVertex) {
			echo "foreach inputlist\n";
			$e = $subjectVertex;
			if( isInside($cp1, $cp2, $e) ) {

				if( !isInside($cp1, $cp2, $s) ) {
					$outputList[] = intersection($cp1, $cp2, $s, $e);
				}

				$outputList[] = $e;
			} else if( isInside($cp1, $cp2, $s) ) {

				$outputList[] = intersection($cp1, $cp2, $s, $e);

			}
			$s = $e;
			$cp1 = $cp2;
		}

	}

	echo "outputlist: " . print_r($outputList, true) . "\n";

	return $outputList;
}

function intersection($cp1, $cp2, $s, $e) {
	$dc = [ $cp1[0] - $cp2[0], $cp1[1] - $cp2[1] ];
	$dp = [ $s[0] - $e[0], $s[1] - $e[1] ];
	$n1 = $cp1[0] * $cp2[1] - $cp1[1] * $cp2[0];
	$n2 = $s[0] * $e[1] - $s[1] * $e[0];
	$n3 = 1.0 / ($dc[0] * $dp[1] - $dc[1] * $dp[0]);

	return [ ($n1 * $dp[0] - $n2 * $dc[0]) * $n3, ($n1 * $dp[1] - $n2 * $dc[1]) * $n3 ];
}

function isInside($cp1, $cp2, $p) {
	return ( $cp2[0] - $cp1[0] ) * ( $p[1] - $cp1[1] ) > ( $cp2[1] - $cp1[1] ) * ( $p[0] - $cp1[0] );
}


// def clip(subjectPolygon, clipPolygon):

//    def inside(p):
//       return(cp2[0]-cp1[0])*(p[1]-cp1[1]) > (cp2[1]-cp1[1])*(p[0]-cp1[0])
 
//    def computeIntersection():
//       dc = [ cp1[0] - cp2[0], cp1[1] - cp2[1] ]
//       dp = [ s[0] - e[0], s[1] - e[1] ]
//       n1 = cp1[0] * cp2[1] - cp1[1] * cp2[0]
//       n2 = s[0] * e[1] - s[1] * e[0] 
//       n3 = 1.0 / (dc[0] * dp[1] - dc[1] * dp[0])
//       return [(n1*dp[0] - n2*dc[0]) * n3, (n1*dp[1] - n2*dc[1]) * n3]
//    outputList = subjectPolygon
//    cp1 = clipPolygon[-1]
 
//    for clipVertex in clipPolygon:
//       cp2 = clipVertex
//       inputList = outputList
//       outputList = []
//       s = inputList[-1]
 
//       for subjectVertex in inputList:
//          e = subjectVertex
//          if inside(e):
//             if not inside(s):
//                outputList.append(computeIntersection())
//             outputList.append(e)
//          elif inside(s):
//             outputList.append(computeIntersection())
//          s = e
//       cp1 = cp2
//    return(outputList)

