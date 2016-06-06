<?php

require_once __DIR__ . "/../autoload.php";

use function pisc\upperscore\indexArray;
use function pisc\upperscore\arrayFlatten;
use function pisc\upperscore\arrayDelete;
use function pisc\upperscore\arraySelect;
use function pisc\upperscore\arrayDetect;
use function pisc\upperscore\arrayType;
use function pisc\upperscore\arraySortBy;
use function pisc\upperscore\arraySortBySingle;
use function pisc\upperscore\sortByNumber;
use function pisc\upperscore\sortByDate;

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

    public function testArraySortByNumber() {

        $array = [
            [ "a" => 1, "b" => 9, "c" => 5, "d" => 3 ],
            [ "a" => 2, "b" => 6, "c" => 9, "d" => 3 ],
            [ "a" => 1, "b" => 9, "c" => 5, "d" => 6 ],
            [ "a" => 1, "b" => 9, "c" => 2, "d" => 8 ],
            [ "a" => 4, "b" => 5, "c" => 7, "d" => 3 ],
            [ "a" => 1, "b" => 4, "c" => 3, "d" => 1 ],
            [ "a" => 1, "b" => 3, "c" => 8, "d" => 2 ],
        ];

        $sorted = arraySortBy($array, 'a.b.c.d', 'sortByNumber');

        $shouldBe = [
            6 => [ "a" => 1, "b" => 3, "c" => 8, "d" => 2 ],
            5 => [ "a" => 1, "b" => 4, "c" => 3, "d" => 1 ],
            3 => [ "a" => 1, "b" => 9, "c" => 2, "d" => 8 ],
            0 => [ "a" => 1, "b" => 9, "c" => 5, "d" => 3 ],
            2 => [ "a" => 1, "b" => 9, "c" => 5, "d" => 6 ],
            1 => [ "a" => 2, "b" => 6, "c" => 9, "d" => 3 ],
            4 => [ "a" => 4, "b" => 5, "c" => 7, "d" => 3 ],
        ];

        $this->assertEquals( $sorted, $shouldBe );

    }

    public function testArraySortByDate()
    {
        $array = [
            [ "a" => "2015-05-01 10:00:00", "b" => "2015-05-09 10:00:00", "c" => "2015-05-05 10:00:00", "d" => "2015-05-03 10:00:00" ],
            [ "a" => "2015-05-02 10:00:00", "b" => "2015-05-06 10:00:00", "c" => "2015-05-09 10:00:00", "d" => "2015-05-03 10:00:00" ],
            [ "a" => "2015-05-01 10:00:00", "b" => "2015-05-09 10:00:00", "c" => "2015-05-05 10:00:00", "d" => "2015-05-06 10:00:00" ],
            [ "a" => "2015-05-01 10:00:00", "b" => "2015-05-09 10:00:00", "c" => "2015-05-02 10:00:00", "d" => "2015-05-08 10:00:00" ],
            [ "a" => "2015-05-04 10:00:00", "b" => "2015-05-05 10:00:00", "c" => "2015-05-07 10:00:00", "d" => "2015-05-03 10:00:00" ],
            [ "a" => "2015-05-01 10:00:00", "b" => "2015-05-04 10:00:00", "c" => "2015-05-03 10:00:00", "d" => "2015-05-01 10:00:00" ],
            [ "a" => "2015-05-01 10:00:00", "b" => "2015-05-03 10:00:00", "c" => "2015-05-08 10:00:00", "d" => "2015-05-02 10:00:00" ],
        ];

        $sorted = arraySortBy($array, 'a.b.c.d', 'sortByDate');

        $shouldBe = [
            6 => [ "a" => "2015-05-01 10:00:00", "b" => "2015-05-03 10:00:00", "c" => "2015-05-08 10:00:00", "d" => "2015-05-02 10:00:00" ],
            5 => [ "a" => "2015-05-01 10:00:00", "b" => "2015-05-04 10:00:00", "c" => "2015-05-03 10:00:00", "d" => "2015-05-01 10:00:00" ],
            3 => [ "a" => "2015-05-01 10:00:00", "b" => "2015-05-09 10:00:00", "c" => "2015-05-02 10:00:00", "d" => "2015-05-08 10:00:00" ],
            0 => [ "a" => "2015-05-01 10:00:00", "b" => "2015-05-09 10:00:00", "c" => "2015-05-05 10:00:00", "d" => "2015-05-03 10:00:00" ],
            2 => [ "a" => "2015-05-01 10:00:00", "b" => "2015-05-09 10:00:00", "c" => "2015-05-05 10:00:00", "d" => "2015-05-06 10:00:00" ],
            1 => [ "a" => "2015-05-02 10:00:00", "b" => "2015-05-06 10:00:00", "c" => "2015-05-09 10:00:00", "d" => "2015-05-03 10:00:00" ],
            4 => [ "a" => "2015-05-04 10:00:00", "b" => "2015-05-05 10:00:00", "c" => "2015-05-07 10:00:00", "d" => "2015-05-03 10:00:00" ],
        ];

        $this->assertEquals( $sorted, $shouldBe );
    }

    public function testArraySortByString() {
        $array = [
            [ "key" => "GKkj3hjkdjghlshl" ],
            [ "key" => "dkgsjhljdlsjg" ],
            [ "key" => "dkdslghsdl" ],
            [ "key" => "Gkdlgslkdgj" ],
            [ "key" => "djgksdg" ],
            [ "key" => "Gdkjghsdjlg" ],
        ];

        arraySortBy($array, 'key', 'sortByString');

        $shouldBe = [
            0 => [ "key" => "GKkj3hjkdjghlshl" ],
            5 => [ "key" => "Gdkjghsdjlg" ],
            3 => [ "key" => "Gkdlgslkdgj" ],
            4 => [ "key" => "djgksdg" ],
            2 => [ "key" => "dkdslghsdl" ],
            1 => [ "key" => "dkgsjhljdlsjg" ],
        ];

        $this->assertEquals($array, $shouldBe);
    }

    public function testArraySortByStringMultiple()
    {
        $array = [
            0 => [ "key" => "GKkj3hjkdjghlshl", "d" => "dghkhlds"],
            1 => [ "key" => "dkgsjhljdlsjg",    "d" => "dghkhlds" ],
            2 => [ "key" => "dkdslghsdl",       "d" => "KHrtets" ],
            3 => [ "key" => "Gkdlgslkdgj",      "d" => "Gtadkg" ],
            4 => [ "key" => "djgksdg",          "d" => "dghkhlds" ],
            5 => [ "key" => "Gdkjghsdjlg",      "d" => "dghkhlds" ],
        ];

        arraySortBy($array, 'd.key', 'sortByString');

        $array = [
            3 => [ "key" => "Gkdlgslkdgj",      "d" => "Gtadkg" ],
            2 => [ "key" => "dkdslghsdl",       "d" => "KHrtets" ],
            0 => [ "key" => "GKkj3hjkdjghlshl", "d" => "dghkhlds"],
            5 => [ "key" => "Gdkjghsdjlg",      "d" => "dghkhlds" ],
            4 => [ "key" => "djgksdg",          "d" => "dghkhlds" ],
            1 => [ "key" => "dkgsjhljdlsjg",    "d" => "dghkhlds" ],
        ];
    }

}