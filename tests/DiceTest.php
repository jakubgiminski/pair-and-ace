<?php

use App\Dice\Dice;
use PHPUnit\Framework\TestCase;

class DiceTest extends TestCase
{
	public function testCanBeInstantiated()
	{
		self::assertInstanceOf(Dice::class, new Dice);
	}

	public function testResultOfRollingIsAnInteger()
	{
		self::assertInternalType('int', (new Dice)->roll());
	}

	public function testResultOfRollingIsGreaterThanZero()
	{
		self::assertGreaterThan(0, (new Dice)->roll());
	}

	public function testResultOfRollingIsLessThanSeven()
	{
		self::assertLessThan(7, (new Dice)->roll());
	}
}
