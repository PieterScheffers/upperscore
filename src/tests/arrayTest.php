<?php

require_once __DIR__ . "/../autoload.php";

use function pisc\upperscore\indexArray;
use function pisc\upperscore\arrayFlatten;
use function pisc\upperscore\arrayDelete;
use function pisc\upperscore\arraySelect;
use function pisc\upperscore\arrayDetect;
use function pisc\upperscore\arrayType;

class ArrayTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        echo $this->getName() . "\n";
    }

    public function testIndexArray() {
    	$arrayOfObjects = [
    		(object)[ 'id' => 25, 'place' => 'Amsterdam' ],
    		(object)[ 'id' => 30, 'place' => 'London' ],
    		(object)[ 'id' => 32, 'place' => 'Berlin' ]
    	];

    	$indexedArray = indexArray($arrayOfObjects);

    	$shouldBe = [
    		25 => (object)[ 'id' => 25, 'place' => 'Amsterdam' ],
    		30 => (object)[ 'id' => 30, 'place' => 'London' ],
    		32 => (object)[ 'id' => 32, 'place' => 'Berlin' ]
    	];

    	$this->assertEquals($indexedArray, $shouldBe);
    }

	public function testArrayFlatten() {
		$flat = arrayFlatten([ 'cow', [ 'bear', ['bunny', 'santa' ], 'rabbit' ]]);
		$this->assertEquals( $flat, [ 'cow', 'bear', 'bunny', 'santa' , 'rabbit' ] );
	}

	public function testArrayDelete() {
		$arr = [ 'a' => 'cow', 'b' => 'bear', 'c' => 'bunny', 'd' => 'santa' , 'e' => 'rabbit' ];
		$item = arrayDelete($arr, 'd');

		// array should be without the element with key 3
		$this->assertEquals( $arr, [ 'a' => 'cow', 'b' => 'bear', 'c' => 'bunny', 'e' => 'rabbit' ] );

		// item should be 'santa'
		$this->assertEquals( $item, 'santa' );
	}

	public function testArraySelect() {
    	$arrayOfObjects = [
    		(object)[ 'id' => 25, 'place' => 'Amsterdam' ],
    		(object)[ 'id' => 30, 'place' => 'London' ],
    		(object)[ 'id' => 32, 'place' => 'Berlin' ],
    		(object)[ 'id' => 33, 'place' => 'London' ],
    		(object)[ 'id' => 34, 'place' => 'New York' ],
    		(object)[ 'id' => 36, 'place' => 'Amsterdam' ],
    		(object)[ 'id' => 40, 'place' => 'Berlin' ],
    		(object)[ 'id' => 41, 'place' => 'Paris' ],
    		(object)[ 'id' => 43, 'place' => 'Amsterdam' ]
    	];

    	$selectedArray = arraySelect($arrayOfObjects, function($v, $k, $arr) {
    		return $v->place === 'Amsterdam';
    	});

    	$shouldBe = [
    		0 => (object)[ 'id' => 25, 'place' => 'Amsterdam' ],
    		5 => (object)[ 'id' => 36, 'place' => 'Amsterdam' ],
    		8 => (object)[ 'id' => 43, 'place' => 'Amsterdam' ]
    	];

    	$this->assertEquals( $selectedArray, $shouldBe );
	}

	public function testArrayDetect() {
    	$arrayOfObjects = [
    		(object)[ 'id' => 25, 'place' => 'Amsterdam' ],
    		(object)[ 'id' => 30, 'place' => 'London' ],
    		(object)[ 'id' => 32, 'place' => 'Berlin' ],
    		(object)[ 'id' => 33, 'place' => 'London' ],
    		(object)[ 'id' => 34, 'place' => 'New York' ],
    		(object)[ 'id' => 36, 'place' => 'Amsterdam' ],
    		(object)[ 'id' => 40, 'place' => 'Berlin' ],
    		(object)[ 'id' => 41, 'place' => 'Paris' ],
    		(object)[ 'id' => 43, 'place' => 'Amsterdam' ]
    	];

    	$selectedItem = ArrayDetect($arrayOfObjects, function($v, $k, $arr) {
    		return $v->place === 'Amsterdam';
    	});

    	$shouldBe = (object)[ 'id' => 25, 'place' => 'Amsterdam' ];

    	$this->assertEquals( $selectedItem, $shouldBe );
	}

    public function testArrayType() {
        $indexed = [ 0 => 'rabbit', 1 => 'cow', 2 => 'horse', 3 => 'cat', 4 => 'dog', 5 => 'frog' ];
        $sparse  = [ 0 => 'rabbit',             2 => 'horse', 3 => 'cat',             5 => 'frog', 7 => 'cow', 10 => 'dog' ];
        $associative = [ 'a' => 'rabbit', 'b' => 'cow', 2 => 'horse', 3 => 'cat', 4 => 'dog', 5 => 'frog' ];

        $this->assertEquals( arrayType($indexed),     'index' );
        $this->assertEquals( arrayType($sparse),      'sparse' );
        $this->assertEquals( arrayType($associative), 'assoc' );

    }

}