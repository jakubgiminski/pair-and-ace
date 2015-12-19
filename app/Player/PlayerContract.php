<?php

namespace App\Player;

use App\Dice\DiceContract;

interface PlayerContract
{
	public function rollDices(array $dices);
	public function rollDice(DiceContract $dice);

	public function getName();
}
