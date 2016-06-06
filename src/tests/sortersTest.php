<?php

require_once __DIR__ . "/../autoload.php";

use function pisc\upperscore\sortByString;
use function pisc\upperscore\sortByStringCase;
use function pisc\upperscore\sortByNumber;
use function pisc\upperscore\sortByDate;
use function pisc\upperscore\sortByDateTime;
use function pisc\upperscore\sortByTime;
use function pisc\upperscore\arraySortBy;

class SortersTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        echo $this->getName() . "\n";
    }

	public function testSortByString() {
		$array = [
			"GKkj3hjkdjghlshl",
			"dkgsjhljdlsjg",
			"dkdslghsdl",
			"Gkdlgslkdgj",
			"djgksdg",
			"Gdkjghsdjlg",
		];
		
		uasort($array, 'sortByString');

		$shouldBe = [
			0 => "GKkj3hjkdjghlshl",
			5 => "Gdkjghsdjlg",
			3 => "Gkdlgslkdgj",
			4 => "djgksdg",
			2 => "dkdslghsdl",
			1 => "dkgsjhljdlsjg",
		];

		$this->assertEquals($array, $shouldBe);
	}



}