<?php

namespace App\View;

class View
{
	private function display($message)
	{
		echo $message . '<br>';
	}

	public function displayStartGameMessage()
	{
		$this->display('This is PAIR&ACE. Let\'s begin!');
		return $this;
	}

	public function displayNoLuckMessage()
	{
		$this->display('No luck this time. There is no winner.');
		return $this;
	}

	public function displayNewRoundMessage($roundCount)
	{
		$this->display("ROUND {$roundCount}");
		return $this;
	}

	public function displayWinnerMessage($winnerName)
	{
		$this->display("We have a winner! Congrats, {$winnerName}.");
		return $this;
	}

	public function displayGameFinishedMessage()
	{
		$this->display('Game is finished.');
		return $this;
	}
}
