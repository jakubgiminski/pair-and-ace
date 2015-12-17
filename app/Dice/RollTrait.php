<?php

namespace App\Dice;

trait RollTrait
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