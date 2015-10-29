<?php

require_once __DIR__ . "/../autoload.php";

use function pisc\upperscore\pathCombine;

class PathTest extends PHPUnit_Framework_TestCase {

	public function testPathCombine() {
		$path = pathCombine('/usr/local', [ 'etc/apache24/', [ '/Includes/various/' ], 'some' ], '/other/path/file.html');
		$this->assertEquals($path, '/usr/local/etc/apache24/Includes/various/some/other/path/file.html');
	}

}