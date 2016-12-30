<?php

use App\Game\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
	public function setUp()
	{
		$gameLog = Mockery::mock(App\GameLog\GameLogContract::class)
			->shouldReceive('gameStarts')->andReturn(Mockery::self())
			->shouldReceive('newRoundStarts')->andReturn(Mockery::self())
			->shouldReceive('playerRollsDices')->andReturn(Mockery::self())
			->shouldReceive('playerWins')->andReturn(Mockery::self())
			->shouldReceive('gameEnds')->andReturn(Mockery::self())
			->shouldReceive('getReportAsArray')->andReturn(['mocked report'])
			->mock();

		$this->game = new Game($gameLog);
	}

	public function testCanBeInstantiated()
	{
		self::assertInstanceOf(Game::class, $this->game);
	}

	public function testCanAddThreeDices()
	{
		$dices = [
			$this->mockDiceContract(),
			$this->mockDiceContract(),
			$this->mockDiceContract()
		];

		$this->game->addDices($dices);

		self::assertSame($dices, $this->game->getDices());
	}

	/**
	 * @expectedException \InvalidArgumentException
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
	 * @expectedException \InvalidArgumentException
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
		$playerName = uniqid('Zenek', true);
		$player = $this->mockPlayer($playerName);
		$this->game->addPlayer($player);

		$players = $this->game->getPlayers();
		$lastPlayer = end($players);

		self::assertSame($player->getName(), $lastPlayer->getName());
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

		self::assertSame($players, $lastThreePlayers);
	}

	public function testCanAddTenPlayers()
	{
		$players = [];
		for ($i = 0; $i < 10; $i++) {
			$players[] = $this->mockPlayer(uniqid('Szczepan', true));
		}

		$this->game->addPlayers($players);

		$players = $this->game->getPlayers();
		$lastTenPlayers = array_slice($players, -10, 10, true);

		self::assertSame($players, $lastTenPlayers);
	}

	public function testCanSetAndGetWinner()
	{
		$winner = $this->mockPlayer('Karol');
		$this->game->setWinner($winner);

		self::assertSame($winner, $this->game->getWinner());
	}

	public function testCanTellIfThereIsAWinner()
	{
		$winner = $this->mockPlayer('Rysiek');
		$this->game->setWinner($winner);

		self::assertFalse($this->game->thereIsNoWinner());
	}

	public function testCanTellIfThereIsNoWinner()
	{
		$this->assertTrue($this->game->thereIsNoWinner());
	}

	public function testCanTellIfResultIsWinning()
	{
		$winningResult = [1, 2, 2];
		self::assertTrue($this->game->isResultWinnig($winningResult));
	}

	public function testCanTellThatResultIsNotWinnigIfThereIsNoPair()
	{
		$result = [1, 2, 6];
		self::assertFalse($this->game->isResultWinnig($result));
	}

	public function testCanTellThatResultIsNotWinnigIfThereIsNoOne()
	{
		$result = [3, 4, 5];
		self::assertFalse($this->game->isResultWinnig($result));
	}

	public function testCanTellThatResultIsNotWinnigIfThereIsNoOneBesidesThePair()
	{
		$result = [1, 1, 5];
		self::assertFalse($this->game->isResultWinnig($result));
	}
	/**
	 * @expectedException Exception
	 */
	public function testCannotRunWithoutDices()
	{
		$this->game->addPlayers([
			$this->mockPlayer('Ziuta'),
			$this->mockPlayer('Mariolka')
		]);

		$this->game->run();
	}

	/**
	 * @expectedException Exception
	 */
	public function testCannotRunWithoutPlayers()
	{
		$this->game->addDices([
			$this->mockDiceContract(),
			$this->mockDiceContract(),
			$this->mockDiceContract()
		]);

		$this->game->run();
	}

	/**
	 * @expectedException Exception
	 */
	public function testCanNotRunTwice()
	{
		$this->addThreeDicesAndTwoPlayers();

		$this->game->run();
		$this->game->run();
	}

	public function testCanGenerateReportAsArray()
	{
		$this->addThreeDicesAndTwoPlayers();
		$this->game->run();

		self::assertEquals($this->game->getGameReportAsArray(), ['mocked report']);
	}

	/**
	 * @expectedException Exception
	 */
	public function testCannotGenerateReportIfTheGameDidntRunYet()
	{
		$this->addThreeDicesAndTwoPlayers();
		$this->game->getGameReportAsArray();
	}

    private function mockDiceContract()
    {
        return Mockery::mock(App\Dice\DiceContract::class);
    }

    private function mockPlayer($playerName = 'Zygmunt')
    {
        return Mockery::mock(App\Player\Player::class)
            ->shouldReceive('getName')
            ->andReturn($playerName)
            ->shouldReceive('rollDices')
            ->andReturn([1,1,1])
            ->mock();
    }

    private function addThreeDicesAndTwoPlayers()
    {
        $this->game->addDices([
            $this->mockDiceContract(),
            $this->mockDiceContract(),
            $this->mockDiceContract()
        ]);

        $this->game->addPlayers([
            $this->mockPlayer(),
            $this->mockPlayer()
        ]);
    }
}
