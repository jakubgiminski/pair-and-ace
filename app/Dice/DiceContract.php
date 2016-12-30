<?php

namespace App\Dice;

interface DiceContract
{
    /**
     * @return int
     */
	public function roll();
}
