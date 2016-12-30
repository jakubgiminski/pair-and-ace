<?php

namespace App\Player;

use App\Dice\DiceContract;

interface PlayerContract
{
    /**
     * @param array $dices
     */
	public function rollDices(array $dices);

    /**
     * @param DiceContract $dice
     */
	public function rollDice(DiceContract $dice);

    /**
     * @return string
     */
	public function getName();
}
