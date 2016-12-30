<?php

use App\GameLog\GameLog;
use PHPUnit\Framework\TestCase;

class GameLogTest extends TestCase
{
	public function testCanBeInstantiated()
	{
		self::assertInstanceOf(GameLog::class, new GameLog);
	}

	public function testCanAddEntryAndGetTheLastOne()
	{
	    $log = new GameLog;
        $logEntry = $this->mockEntry();

        $log->addEntry($logEntry);

		self::assertSame($logEntry, $log->getLastEntry());
	}

	public function testCanGetReportAsArray()
	{
	    $log = new GameLog;

        $log->addEntry($this->mockEntry());
        $log->addEntry($this->mockEntry());
		$log->addEntry($this->mockEntry());

		$report = $log->getReportAsArray();

        self::assertCount(3, $report);
	}

	public function testCanLogGameStarts()
	{
        $log = new GameLog;
		$log->gameStarts();

		self::assertSame('GAME BEGINS', $log->getLastEntry());
	}

	public function testCanLogNobodyWins()
	{
        $log = new GameLog;
		$log->nobodyWins();

		$this->assertStringEndsWith('MAXIMUM NUMBER OF ROUNDS EXCEEDED', $log->getLastEntry());
	}

	public function testCanLogNewRoundStarts()
	{
        $log = new GameLog;
        $roundCount = 5;
		$log->newRoundStarts($roundCount);

		self::assertSame("ROUND {$roundCount} BEGINS", $log->getLastEntry());
	}

	public function testCanLogPlayerWins()
	{
	    $log = new GameLog;
		$playerName = 'Zenek';
		$log->playerWins($playerName);

		self::assertSame("{$playerName} WINS", $log->getLastEntry());
	}

	public function testCanLogGameEnds()
	{
	    $log = new GameLog;
		$log->gameEnds();

		self::assertSame('END OF GAME', $log->getLastEntry());
	}

	public function testCanLogPlayerRollsDices()
	{
	    $log = new GameLog;
		$playerName = 'Gienek';
		$results = '1 1 6';
		$log->playerRollsDices($playerName, [1, 1, 6]);

        self::assertSame("$playerName rolls dices and the result is: $results", $log->getLastEntry());
	}

    private function mockEntry()
    {
        return uniqid('Something is happening!', true);
    }
}
