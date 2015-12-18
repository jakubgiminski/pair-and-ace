<?php

namespace App\View;

interface ViewContract
{
	public function displayStartGameMessage();
	public function displayNoLuckMessage();
	public function displayNewRoundMessage($roundCount);
	public function displayWinnerMessage($winnerName);
	public function displayGameFinishedMessage();
}