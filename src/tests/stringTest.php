<?php

require_once __DIR__ . "/../autoload.php";

use function pisc\upperscore\randomString;

class StringTest extends PHPUnit_Framework_TestCase {

	public function testRandomString() {
		$string = randomString(22);

		$this->assertEquals(strlen($string), 22);
	}

}