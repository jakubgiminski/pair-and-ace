<?php

namespace App\Player;

use App\Dice\DiceContract;

class Player implements PlayerContract
{
    /** @var string */
	private $name;

    /**
     * @param string $name
     */
	public function __construct($name)
	{
		$this->name = $name;
	}

    /**
     * @param array $dices
     * @return array
     */
	public function rollDices(array $dices)
	{
		$results = [];

		foreach ($dices as $dice) {
			$results[] = $this->rollDice($dice);
		}

		return $results;
	}

    /**
     * @param DiceContract $dice
     * @return int
     */
	public function rollDice(DiceContract $dice)
	{
		return $dice->roll();
	}

    /**
     * @return string
     */
	public function getName()
	{
		return $this->name;
	}
}
