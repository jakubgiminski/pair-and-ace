<?php

namespace App\Dice;

class Dice implements DiceContract
{
	/**
	 * Roll the dice!
	 * @return integer <1,6>
	 */
	public function roll()
	{
		return rand(1,6);
	}
}