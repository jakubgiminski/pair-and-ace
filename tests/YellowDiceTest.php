<?php

use App\Dice\YellowDice;

class YellowDiceTest extends PHPUnit_Framework_TestCase
{
	use Tests\DiceTrait;

	public function setUp()
	{
		$this->dice = new YellowDice;
	}

	public function testCanBeInstantiated()
	{
		$this->assertInstanceOf(
			YellowDice::class,
			$this->dice
		);
	}
}
