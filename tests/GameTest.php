<?php

use App\Game\Game;

class GameTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$view = Mockery::mock('App\View\ViewContract');
		$this->game = new Game($view);
	}

	private function mockDiceContract()
	{
		return Mockery::mock('App\Dice\DiceContract');
	}

	public function testCanBeInstantiated()
	{
		$this->assertInstanceOf(
			Game::class,
			$this->game
		);
	}

	public function testCanAddThreeDices()
	{
		$dices = [
			$this->mockDiceContract(),
			$this->mockDiceContract(),
			$this->mockDiceContract()
		];

		$this->game->addDices($dices);

		$this->assertEquals(
			$dices,
			$this->game->getDices()
		);
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testCannotAddLessThanThreeDices()
	{
		$dices = [
			$this->mockDiceContract(),
			$this->mockDiceContract()
		];

		$this->game->addDices($dices);
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testCannotAddMoreThanThreeDices()
	{
		$dices = [
			$this->mockDiceContract(),
			$this->mockDiceContract(),
			$this->mockDiceContract(),
			$this->mockDiceContract()
		];

		$this->game->addDices($dices);
	}

	// public function testCanAddOnePlayer()
	// {
	// 	$this->
	// }
}
