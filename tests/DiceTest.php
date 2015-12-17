<?php

use App\Dice\Dice;

class DiceTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->dice = new Dice;
	}

	public function testCanBeInstantiated()
	{
		$this->assertInstanceOf(
			Dice::class,
			$this->dice
		);
	}

	public function testCanBeRolled()
	{
		$this->assertNotEmpty($this->dice->roll());
	}

	public function testResultOfRollingIsAnInteger()
	{
		$this->assertInternalType(
			'int',
			$this->dice->roll()
		);
	}

	public function testResultOfRollingIsGreaterThanZero()
	{
		$this->assertGreaterThan(
			0,
			$this->dice->roll()
		);
	}

	public function testResultOfRollingIsLessThanSeven()
	{
		$this->assertLessThan(
			7,
			$this->dice->roll()
		);
	}
}
