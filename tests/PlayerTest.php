<?php

use App\Player;

class PlayerTest extends PHPUnit_Framework_TestCase
{
	public function testCanBeInstantiated()
	{
		$player = new Player;
		$this->assertInstanceOf(Player::class, $player);
	}
}
