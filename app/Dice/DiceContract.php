<?php

namespace App\Dice;

interface DiceContract
{
	/**
	 * Roll the dice!
	 * @return integer <1,6>
	 */
	public function roll();
}