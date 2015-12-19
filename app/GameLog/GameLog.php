<?php

namespace App\GameLog;

class GameLog implements GameLogContract
{
	private $log = [];

	public function getReportAsArray()
	{
		return $this->log;
	}

	public function getLastEntry()
	{
		return end($this->log);
	}

	public function addEntry($entry)
	{
		$this->log[] = $entry;
	}

	public function gameStarts()
	{
		$this->addEntry('GAME BEGINS');
	}

	public function nobodyWins()
	{
		$this->addEntry('MAXIMUM NUMBER OF ROUNDS EXCEEDED');
	}

	public function newRoundStarts($roundCount)
	{
		$this->addEntry("ROUND {$roundCount} BEGINS");
	}

	public function playerWins($playerName)
	{
		$this->addEntry("{$playerName} WINS");
	}

	public function gameEnds()
	{
		$this->addEntry('END OF GAME');
	}

	public function playerRollsDices($player, array $results)
	{
		$resultString = '';

		foreach ($results as $result) {
			$resultString .= " {$result}";
		}

		$this->addEntry("{$player} rolls dices and the result is:{$resultString}");
	}
}
