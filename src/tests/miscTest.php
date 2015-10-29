<?php

require_once __DIR__ . "/../autoload.php";

use function pisc\upperscore\def;
use function pisc\upperscore\defDeep;

class MiscTest extends PHPUnit_Framework_TestCase {

	public function testDef() {
		$arr = [ 'a' => 'kiwi', 'b' => 'nut' ];

		$a = def($arr, 'a');
		$this->assertEquals($a, 'kiwi');

		$b = def($arr, 'b');
		$this->assertEquals($b, 'nut');

		$c = def($arr, 'c');
		$this->assertEquals($c, '');
	}

	public function testDefDeep() {
		$arr = [ 'banana' => [ 'kiwi' => 'strawberry' ], 'berry' => [] ];

		$value1 = defDeep($arr, 'banana.kiwi', 'cookie');
 		$this->assertEquals($value1, 'strawberry');

		$value2 = defDeep($arr, 'berry.kiwi', 'cookie');
		$this->assertEquals($value2, 'cookie');

		$value3 = defDeep($arr, 'banana.berry', 'cookie');
		$this->assertEquals($value3, 'cookie');
	}

}