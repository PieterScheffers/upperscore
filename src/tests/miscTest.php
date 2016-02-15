<?php

require_once __DIR__ . "/../autoload.php";

use function pisc\upperscore\defOne;
use function pisc\upperscore\def;
use function pisc\upperscore\defDeep;
use function pisc\upperscore\set;
use function pisc\upperscore\setDeep;

class TestClass {
	public $someAttribute = "Wookie";

	public function returnsString() {
		return "hasresult";
	}

	public function returnsSomeArray() {
		return [ "banana" => "monkey", "strawberry" => [ "stick" => "stones", "foo" => "bar" ], "raspberry" => "pi" ];
	}
}

class MiscTest extends PHPUnit_Framework_TestCase {
    
    public function setUp() {
        echo $this->getName() . "\n";
    }

	public function testDefOne() {
		$arr = [ 'a' => 'kiwi', 'b' => 'nut' ];

		$a = defOne($arr, 'a');
		$this->assertEquals($a, 'kiwi');

		$b = defOne($arr, 'b');
		$this->assertEquals($b, 'nut');

		$c = defOne($arr, 'c');
		$this->assertEquals($c, '');


		$obj = new TestClass();

		$d = defOne($obj, 'someAttribute');
		$this->assertEquals($d, 'Wookie');

		$e = defOne($obj, 'returnsString()');
		$this->assertEquals($e, 'hasresult');

	}

	public function testDef() {
		$arr = [ 'banana' => [ 'kiwi' => 'strawberry' ], 'berry' => [] ];

		$value1 = def($arr, 'banana.kiwi', 'cookie');
 		$this->assertEquals($value1, 'strawberry');

		$value2 = def($arr, 'berry.kiwi', 'cookie');
		$this->assertEquals($value2, 'cookie');

		$value3 = def($arr, 'banana.berry', 'cookie');
		$this->assertEquals($value3, 'cookie');

		$obj = new TestClass();

		$value4 = def($obj, 'returnsSomeArray().strawberry.stick');
		$this->assertEquals($value4, 'stones');

		$a = [ "Mickey" => "Mouse", "testObject" => $obj ];

		$value5 = def($a, 'testObject.someAttribute');
		$this->assertEquals($value5, 'Wookie');

		$value6 = def($a, 'testObject.returnsSomeArray().strawberry.foo');
		$this->assertEquals($value6, 'bar');
	}

	public function testDefDeep() {
		$arr = [ 'banana' => [ 'kiwi' => 'strawberry' ], 'berry' => [] ];

		$value1 = defDeep($arr, 'banana.kiwi', 'cookie');
 		$this->assertEquals($value1, 'strawberry');

		$value2 = defDeep($arr, 'berry.kiwi', 'cookie');
		$this->assertEquals($value2, 'cookie');

		$value3 = defDeep($arr, 'banana.berry', 'cookie');
		$this->assertEquals($value3, 'cookie');

		$obj = new TestClass();

		$value4 = defDeep($obj, 'returnsSomeArray().strawberry.stick');
		$this->assertEquals($value4, 'stones');

		$a = [ "Mickey" => "Mouse", "testObject" => $obj ];

		$value5 = defDeep($a, 'testObject.someAttribute');
		$this->assertEquals($value5, 'Wookie');

		$value6 = defDeep($a, 'testObject.returnsSomeArray().strawberry.foo');
		$this->assertEquals($value6, 'bar');
	}

	// public function testSet() {
	// 	$object = (object)[];

	// 	$object = set($object, 'banana', 'somevalue');

	// 	$this->assertEquals( (object)['banana' => 'somevalue'] , $object);
	// }

	// public function testSetDeepArray() {
	// 	$object = (object)[];

	// 	$object = setDeep($object, 'kiwi.strawberry.cucumber.berry', 'somevalue');

	// 	$shouldBe = (object)[
	// 		'kiwi' => [
	// 			'strawberry' => [
	// 				'cucumber' => [
	// 					[ 'berry' => 'somevalue']
	// 				]
	// 			]
	// 		]
	// 	];

	// 	echo "lkklklklkjlkljljljl\n";
	// 	print_r($object);

	// 	$this->assertEquals( $shouldBe, $object );
	// }

	// public function testSetDeepObject() {
	// 	$object = (object)[];

	// 	$object = setDeep($object, 'kiwi.strawberry.cucumber.berry', 'somevalue', 'object');

	// 	$shouldBe = (object)[
	// 		'kiwi' => (object)[
	// 			'strawberry' => (object)[
	// 				'cucumber' => (object)[
	// 					[ 'berry' => 'somevalue']
	// 				]
	// 			]
	// 		]
	// 	];

	// 	echo "dmlgnskjghksjdg\n";
	// 	print_r($object);

	// 	$this->assertEquals( $shouldBe, $object );
	// }

}