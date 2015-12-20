<?php

namespace App\Dice;

class Dice implements DiceContract
{
	public function roll()
	{
		return rand(1,6);
	}
}