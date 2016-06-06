<?php

use function pisc\upperscore\sutherlandHodgman;
use function pisc\upperscore\pr;

class ClippingTest extends PHPUnit_Framework_TestCase {
    
    public function setUp() {
        echo $this->getName() . "\n";
    }

	public function testSutherlandHodgman() {

		// $polygon  = [ [2,2], [4,4], [1,6] ];
		// $clipping = [ [5,1], [4,8], [2,4] ];

		// $polygon  = [ [2,2], [2,4], [4,4], [4,2] ];
		// $clipping = [ [3,1], [1,1], [1,3], [3,3] ];

		// // $result = [ [4,4], [2.5,5], [2,4], [3,3] ];
		// $result = [ [2,2], [2,4], [4,4], [4,2] ];

		// echo "result\n";
		// print_r($result);

		// echo "was\n";
		// print_r(sutherlandHodgman($polygon, $clipping));

		// $this->assertEquals(array_values( sutherlandHodgman($polygon, $clipping) ), array_values($result) );
	}


}