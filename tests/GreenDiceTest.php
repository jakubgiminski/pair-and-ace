<?php

use App\Dice\GreenDice;

class GreenDiceTest extends PHPUnit_Framework_TestCase
{
	use Tests\DiceTrait;

	public function setUp()
	{
		$this->dice = new GreenDice;
	}

	public function testCanBeInstantiated()
	{
		$this->assertInstanceOf(
			GreenDice::class,
			$this->dice
		);
	}
}
