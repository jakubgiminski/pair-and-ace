<?php

namespace App\Dice;

class Dice implements DiceContract
{
	public function roll()
	{
		return mt_rand(1,6);
	}
}
