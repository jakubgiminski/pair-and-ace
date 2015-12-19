<?php

use App\GameLog\GameLog;

class GameLogTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->log = new GameLog;
	}

	private function mockEntry()
	{
		return uniqid('Something is happening!');
	}

	// private function logEntries($numEntries = 3)
	// {
	// 	for ($i = 0; $numEntries > $i; $i++){
	// 		$this->log->addEntry($this->mockEntry());
	// 	}

	// 	return $this;
	// }

	public function testCanAddEntry()
	{
		$entry = $this->mockEntry();
		$this->log->addEntry($entry);

		$this->assertStringEndsWith(
			$entry,
			$this->log->getLastEntry()
		);
	}

	public function testCanGetLastEntry()
	{
		$entry = $this->mockEntry();
		$this->log->addEntry($entry);

		$this->assertStringEndsWith(
			$entry,
			$this->log->getLastEntry()
		);
	}

	public function testCanGetReportAsArray()
	{
		$entry = $this->mockEntry();
		$this->log->addEntry($entry);

		$report = $this->log->getReportAsArray();

		$this->assertStringEndsWith(
			$entry,
			end($report)
		);
	}

	public function testCanLogGameStarts()
	{
		$entry = 'Game starts.';
		$this->log->gameStarts($entry);

		$this->assertStringEndsWith(
			$entry,
			$this->log->getLastEntry()
		);
	}

	public function testCanLogNobodyWins()
	{
		$entry = 'Maximum number of rounds exceeded. Nobody wins.';
		$this->log->nobodyWins();

		$this->assertStringEndsWith(
			$entry,
			$this->log->getLastEntry()
		);
	}

	public function testCanLogNewRoundStarts()
	{
		$roundCount = 5;
		$entry = "Round {$roundCount} starts.";
		$this->log->newRoundStarts($roundCount);

		$this->assertStringEndsWith(
			$entry,
			$this->log->getLastEntry()
		);
	}

	public function testCanLogPlayerWins()
	{
		$playerName = 'Zenek';
		$entry = "Player {$playerName} wins.";
		$this->log->playerWins($playerName);

		$this->assertStringEndsWith(
			$entry,
			$this->log->getLastEntry()
		);
	}

	public function testCanLogGameEnds()
	{
		$entry = 'Game ends.';
		$this->log->gameEnds();

		$this->assertStringEndsWith(
			$entry,
			$this->log->getLastEntry()
		);
	}
}
