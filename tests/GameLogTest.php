<?php

use App\Dice\Dice;

class DiceTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->dice = new Dice;
	}
}
