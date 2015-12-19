<?php

use App\Game\Game;

class GameTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$gameLog = Mockery::mock('App\GameLog\GameLogContract');
		$this->game = new Game($gameLog);
	}

	private function mockDiceContract()
	{
		return Mockery::mock('App\Dice\DiceContract');
	}

	private function mockPlayerContract()
	{
		return Mockery::mock('App\Player\PlayerContract');
	}

	private function mockPlayer($playerName = 'Zygmunt')
	{
		return Mockery::mock('App\Player\Player')
			->shouldReceive('getName')
			->andReturn($playerName)
			->mock();
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
	public function testCannotAddTwoDices()
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
	public function testCannotAddFourDices()
	{
		$dices = [
			$this->mockDiceContract(),
			$this->mockDiceContract(),
			$this->mockDiceContract(),
			$this->mockDiceContract()
		];

		$this->game->addDices($dices);
	}

	public function testCanAddOnePlayer()
	{
		$playerName = uniqid('Zenek');
		$player = $this->mockPlayer($playerName);
		$this->game->addPlayer($player);

		$players = $this->game->getPlayers();
		$lastPlayer = end($players);

		$this->assertEquals(
			$player->getName(),
			$lastPlayer->getName()
		);
	}

	public function testCanAddThreePlayers()
	{
		$players = [
			$this->mockPlayer('Szczepan'),
			$this->mockPlayer('Mariusz'),
			$this->mockPlayer('Barnaba')
		];

		$this->game->addPlayers($players);

		$players = $this->game->getPlayers();
		$lastThreePlayers = array_slice($players, -3, 3, true);

		$this->assertEquals(
			$players,
			$lastThreePlayers
		);
	}

	public function testCanAddTenPlayers()
	{
		$players = [];
		for ($i = 0; $i < 10; $i++) {
			$players[] = $this->mockPlayer(uniqid('Szczepan'));
		}

		$this->game->addPlayers($players);

		$players = $this->game->getPlayers();
		$lastTenPlayers = array_slice($players, -10, 10, true);

		$this->assertEquals(
			$players,
			$lastTenPlayers
		);
	}

	public function testCanSetWinner()
	{
		$winner = $this->mockPlayer('Karol');
		$this->game->setWinner($winner);

		$this->assertEquals(
			$winner,
			$this->game->getWinner()
		);
	}

	public function testCanTellIfThereIsAWinner()
	{
		$winner = $this->mockPlayer('Rysiek');
		$this->game->setWinner($winner);

		$this->assertFalse($this->game->thereIsNoWinner());
	}

	public function testCanTellIfThereIsNoWinner()
	{
		$this->assertTrue($this->game->thereIsNoWinner());
	}

	public function testCanTellIfResultIsWinning()
	{
		$winningResult = [1, 2, 2];
		$this->assertTrue($this->game->isResultWinnig($winningResult));
	}

	public function testCanTellThatResultIsNotWinnigIfThereIsNoPair()
	{
		$result = [1, 2, 6];
		$this->assertFalse(
			$this->game->isResultWinnig($result)
		);
	}

	public function testCanTellThatResultIsNotWinnigIfThereIsNoSixOrOne()
	{
		$result = [3, 3, 3];
		$this->assertFalse(
			$this->game->isResultWinnig($result)
		);
	}
}
