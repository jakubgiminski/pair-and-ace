<?php

namespace App\GameLog;

interface GameLogContract
{
	public function getAll();
	public function addEntry();
}