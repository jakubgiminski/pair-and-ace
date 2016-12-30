<?php

namespace App\Dice;

class Dice implements DiceContract
{
    /**
     * @return int
     */
	public function roll()
	{
		return mt_rand(1,6);
	}
}
