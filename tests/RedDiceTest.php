<?php

use App\Dice\RedDice;

class RedDiceTest extends PHPUnit_Framework_TestCase
{
	use Tests\DiceTrait;

	public function setUp()
	{
		$this->dice = new RedDice;
	}

	public function testCanBeInstantiated()
	{
		$this->assertInstanceOf(
			RedDice::class,
			$this->dice
		);
	}
}
