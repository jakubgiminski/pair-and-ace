<?php

use App\Player\Player;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
	public function setUp()
	{
		$this->player = new Player('Zenek');
	}

	public function testCanBeInstantiated()
	{
		self::assertInstanceOf(Player::class, $this->player);
	}

	public function testCanRollOneDice()
	{
		$dice = Mockery::mock(App\Dice\DiceContract::class)
			->shouldReceive('roll')
			->andReturn(1)
			->mock();

		$result = $this->player->rollDice($dice);

		self::assertInternalType(
			'int',
			$result
		);
	}

	public function testCanRollThreeDices()
	{
		$firstDice = Mockery::mock(App\Dice\DiceContract::class)
			->shouldReceive('roll')
			->andReturn(1)
			->mock();

		$secondDice = Mockery::mock(App\Dice\DiceContract::class)
			->shouldReceive('roll')
			->andReturn(3)
			->mock();

		$thirdDice = Mockery::mock(App\Dice\DiceContract::class)
			->shouldReceive('roll')
			->andReturn(6)
			->mock();

		$results = $this->player->rollDices([
            $firstDice,
            $secondDice,
            $thirdDice
        ]);

		self::assertEquals([1, 3, 6], $results);
	}

	public function testNameCanBeFetchedWithAGetter()
	{
		$player = new Player('Henryk');
		self::assertSame($player->getName(), 'Henryk');
	}
}
