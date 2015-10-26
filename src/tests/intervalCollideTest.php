<?php

require_once __DIR__ . "/../autoload.php";

use function pisc\upperscore\intervalsCollide;

class IntervalsCollideTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        echo $this->getName() . "\n";
    }

	public function testLeftCollide() {
		$result = intervalsCollide( [5, 10], [3, 7] );
		$this->assertTrue($result);
	}

	public function testRightCollide() {
		$result = intervalsCollide( [3, 7], [5, 10] );
		$this->assertTrue($result);
	}

	public function testLeftOnBorder() {
		$result = intervalsCollide( [3, 7], [1, 3] );
		$this->assertFalse($result);
	}

	public function testRightOnBorder() {
		$result = intervalsCollide( [3, 7], [7, 10] );
		$this->assertFalse($result);
	}

	public function testIsGreaterOne() {
		$result = intervalsCollide( [3, 7], [1, 10] );
		$this->assertTrue($result);
	}

	public function testIsGreaterTwo() {
		$result = intervalsCollide( [1, 10], [3, 7] );
		$this->assertTrue($result);
	}

	public function testIsTheSame() {
		$result = intervalsCollide( [3, 7], [3, 7] );
		$this->assertTrue($result);
	}

	public function testLeftOutside() {
		$result = intervalsCollide( [5, 9], [2, 4] );
		$this->assertFalse($result);
	}

	public function testRightOutside() {
		$result = intervalsCollide( [2, 4], [5, 9] );
		$this->assertFalse($result);
	}

	/////////////////////////////////////////////////////////////////////////
	
	public function testDateLeftCollide() {
		$result = intervalsCollide( [new DateTime('2015-05-01'), new DateTime('2015-10-01')], [new DateTime('2015-03-01'), new DateTime('2015-07-01')] );
		$this->assertTrue($result);
	}

	public function testDateRightCollide() {
		$result = intervalsCollide( [new DateTime('2015-03-01'), new DateTime('2015-07-01')], [new DateTime('2015-05-01'), new DateTime('2015-10-01')] );
		$this->assertTrue($result);
	}

	public function testDateLeftOnBorder() {
		$result = intervalsCollide( [new DateTime('2015-03-01'), new DateTime('2015-07-01')], [new DateTime('2015-01-01'), new DateTime('2015-03-01')] );
		$this->assertFalse($result);
	}

	public function testDateRightOnBorder() {
		$result = intervalsCollide( [new DateTime('2015-03-01'), new DateTime('2015-07-01')], [new DateTime('2015-07-01'), new DateTime('2015-10-01')] );
		$this->assertFalse($result);
	}

	public function testDateIsGreaterOne() {
		$result = intervalsCollide( [new DateTime('2015-03-01'), new DateTime('2015-07-01')], [new DateTime('2015-01-01'), new DateTime('2015-10-01')] );
		$this->assertTrue($result);
	}

	public function testDateIsGreaterTwo() {
		$result = intervalsCollide( [new DateTime('2015-01-01'), new DateTime('2015-10-01')], [new DateTime('2015-03-01'), new DateTime('2015-07-01')] );
		$this->assertTrue($result);
	}

	public function testDateIsTheSame() {
		$result = intervalsCollide( [new DateTime('2015-03-01'), new DateTime('2015-07-01')], [new DateTime('2015-03-01'), new DateTime('2015-07-01')] );
		$this->assertTrue($result);
	}

	public function testDateLeftOutside() {
		$result = intervalsCollide( [new DateTime('2015-05-01'), new DateTime('2015-09-01')], [new DateTime('2015-02-01'), new DateTime('2015-04-01')] );
		$this->assertFalse($result);
	}

	public function testDateRightOutside() {
		$result = intervalsCollide( [new DateTime('2015-02-01'), new DateTime('2015-04-01')], [new DateTime('2015-05-01'), new DateTime('2015-09-01')] );
		$this->assertFalse($result);
	}
}