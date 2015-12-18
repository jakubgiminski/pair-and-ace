<?php

namespace App;

use App\Dice\DiceContract;

class Player
{
	private $name;

	public function __construct($name)
	{
		$this->name = $name;
	}

	public function rollDices(array $dices)
	{
		$results = [];

		foreach ($dices as $dice) {
			$results[] = $this->rollDice($dice);
		}

		return $results;
	}

	public function rollDice(DiceContract $dice)
	{
		return $dice->roll();
	}

	public function getName()
	{
		return $this->name;
	}
}
