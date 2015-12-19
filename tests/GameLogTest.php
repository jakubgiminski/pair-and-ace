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

	public function testCanBeInstantiated()
	{
		$this->assertInstanceOf(
			GameLog::class,
			$this->log
		);
	}

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
		$entry = 'GAME BEGINS';
		$this->log->gameStarts($entry);

		$this->assertStringEndsWith(
			$entry,
			$this->log->getLastEntry()
		);
	}

	public function testCanLogNobodyWins()
	{
		$entry = 'MAXIMUM NUMBER OF ROUNDS EXCEEDED';
		$this->log->nobodyWins();

		$this->assertStringEndsWith(
			$entry,
			$this->log->getLastEntry()
		);
	}

	public function testCanLogNewRoundStarts()
	{
		$roundCount = 5;
		$entry = "ROUND {$roundCount} BEGINS";
		$this->log->newRoundStarts($roundCount);

		$this->assertStringEndsWith(
			$entry,
			$this->log->getLastEntry()
		);
	}

	public function testCanLogPlayerWins()
	{
		$playerName = 'Zenek';
		$entry = "{$playerName} WINS";
		$this->log->playerWins($playerName);

		$this->assertStringEndsWith(
			$entry,
			$this->log->getLastEntry()
		);
	}

	public function testCanLogGameEnds()
	{
		$entry = 'END OF GAME';
		$this->log->gameEnds();

		$this->assertStringEndsWith(
			$entry,
			$this->log->getLastEntry()
		);
	}

	public function testCanLogPlayerRollsDices()
	{
		$player = 'Gienek';
		$results = [1, 1, 6];
		$resultString = '';

		foreach ($results as $result) {
			$resultString .= " {$result}";
		}

		$entry = "{$player} rolls dices and the result is:{$resultString}";

		$this->log->playerRollsDices($player, $results);

		$this->assertStringEndsWith(
			$entry,
			$this->log->getLastEntry()
		);
	}
}
