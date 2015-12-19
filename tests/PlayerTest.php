<?php

use App\Player\Player;

class PlayerTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->player = new Player('Zenek');
	}

	public function testCanBeInstantiated()
	{
		$this->assertInstanceOf(
			Player::class,
			$this->player
		);
	}

	public function testCanRollOneDice()
	{
		$dice = Mockery::mock('App\Dice\DiceContract')
			->shouldReceive('roll')
			->andReturn(1)
			->mock();

		$result = $this->player->rollDice($dice);

		$this->assertInternalType(
			'int',
			$result
		);
	}

	public function testCanRollThreeDices()
	{
		$firstDice = Mockery::mock('App\Dice\DiceContract')
			->shouldReceive('roll')
			->andReturn(1)
			->mock();

		$secondDice = Mockery::mock('App\Dice\DiceContract')
			->shouldReceive('roll')
			->andReturn(3)
			->mock();

		$thirdDice = Mockery::mock('App\Dice\DiceContract')
			->shouldReceive('roll')
			->andReturn(6)
			->mock();

		$results = $this->player->rollDices(
			[
				$firstDice,
				$secondDice,
				$thirdDice
			]
		);

		$this->assertEquals(
			[1, 3, 6],
			$results
		);
	}

	public function testNameCanBeFetchedWithAGetter()
	{
		$player = new Player('Henryk');
		$this->assertEquals($player->getName(), 'Henryk');
	}
}
