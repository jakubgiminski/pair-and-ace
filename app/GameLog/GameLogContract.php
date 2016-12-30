<?php

namespace App\GameLog;

interface GameLogContract
{
    /**
     * @return array
     */
	public function getReportAsArray();

    /**
     * @return string
     */
	public function getLastEntry();

    /**
     * @param string $entry
     */
	public function addEntry($entry);

	public function gameStarts();

	public function nobodyWins();

    /**
     * @param int $roundCount
     */
	public function newRoundStarts($roundCount);

    /**
     * @param string $playerName
     */
	public function playerWins($playerName);

	public function gameEnds();

    /**
     * @param string $playerName
     * @param array $result
     */
	public function playerRollsDices($playerName, array $result);
}
