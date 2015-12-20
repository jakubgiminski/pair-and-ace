<?php

namespace App\GameLog;

interface GameLogContract
{
	public function getReportAsArray();
	public function getLastEntry();
	public function addEntry($entry);

	public function gameStarts();
	public function nobodyWins();
	public function newRoundStarts($roundCount);
	public function playerWins($playerName);
	public function gameEnds();
	public function playerRollsDices($playerName, array $result);
}
