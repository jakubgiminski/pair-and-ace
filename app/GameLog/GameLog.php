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
		$this->log[] = time() . ': ' . $entry;
	}

	public function gameStarts()
	{
		$this->addEntry('Game starts.');
	}

	public function nobodyWins()
	{
		$this->addEntry('Maximum number of rounds exceeded. Nobody wins.');
	}

	public function newRoundStarts($roundCount)
	{
		$this->addEntry("Round {$roundCount} starts.");
	}

	public function playerWins($playerName)
	{
		$this->addEntry("Player {$playerName} wins.");
	}

	public function gameEnds()
	{
		$this->addEntry('Game ends.');
	}
}
