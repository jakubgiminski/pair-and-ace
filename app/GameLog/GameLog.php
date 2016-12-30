<?php

namespace App\GameLog;

class GameLog implements GameLogContract
{
    /** @var array */
	private $log = [];

    /**
     * @return array
     */
	public function getReportAsArray()
	{
		return $this->log;
	}

    /**
     * @return string
     */
	public function getLastEntry()
	{
		return end($this->log);
	}

    /**
     * @param string $entry
     */
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

    /**
     * @param int $roundCount
     */
	public function newRoundStarts($roundCount)
	{
		$this->addEntry("ROUND {$roundCount} BEGINS");
	}

    /**
     * @param string $playerName
     */
	public function playerWins($playerName)
	{
		$this->addEntry("{$playerName} WINS");
	}

	public function gameEnds()
	{
		$this->addEntry('END OF GAME');
	}

    /**
     * @param string $playerName
     * @param array $results
     */
	public function playerRollsDices($playerName, array $results)
	{
		$resultString = '';

		foreach ($results as $result) {
			$resultString .= " {$result}";
		}

		$this->addEntry("{$playerName} rolls dices and the result is:{$resultString}");
	}
}
